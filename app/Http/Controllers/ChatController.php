<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    /**
     * Display the chat interface with dummy data.
     */
    public function index(): View
    {
        // Generate dummy messages if none exist
        if (Message::count() === 0) {
            $this->generateDummyMessages();
        }
        
        $messages = Message::with('user')->latest()->take(50)->get()->reverse();
        
        return view('pages.chat.chat', compact('messages'));
    }

    /**
     * Fetch messages for HTMX updates.
     * For a single file setup, we'll return a fragment of the page rather than a separate view.
     */
    public function fetchMessages(): string
    {
        $messages = Message::with('user')->latest()->take(50)->get()->reverse();
        
        $output = '';
        foreach ($messages as $message) {
            $output .= $this->renderMessageHtml($message);
        }
        
        return $output;
    }

    /**
     * Send a new message.
     * For a single file setup, we'll render the message HTML directly.
     */
    public function sendMessage(Request $request): string
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = auth()->user()->messages()->create([
            'content' => $request->content,
        ]);

        // Load the user relationship
        $message->load('user');

        return $this->renderMessageHtml($message);
    }

    /**
     * Delete a message.
     */
    public function deleteMessage(Message $message): Response
    {
        if ($message->user_id !== auth()->id()) {
            abort(403);
        }

        $message->delete();
        
        return response()->noContent();
    }

    /**
     * Handle typing indicator.
     */
    public function typing(): Response
    {
        // In a real app, you might want to use a cache or websocket for this
        // For demonstration purposes, this is a simple endpoint
        return response()->noContent();
    }

    /**
     * Render a single message as HTML.
     * This replaces the need for a separate message view file.
     */
    private function renderMessageHtml(Message $message): string
    {
        $isOwnMessage = auth()->id() === $message->user_id;
        $chatAlignment = $isOwnMessage ? 'chat-end' : 'chat-start';
        $bubbleClass = $isOwnMessage ? 'chat-bubble-primary' : '';
        $timestamp = $message->created_at->format('H:i');
        $avatar = "https://ui-avatars.com/api/?name=" . urlencode($message->user->name) . "&background=random";
        
        $deleteButton = '';
        if ($isOwnMessage) {
            $deleteUrl = route('chat.delete', $message->id);
            $deleteButton = <<<HTML
            <div class="chat-footer opacity-50 text-xs flex gap-1 items-center">
                <button 
                    class="btn btn-ghost btn-xs"
                    hx-delete="{$deleteUrl}"
                    hx-target="#message-{$message->id}"
                    hx-swap="outerHTML"
                    hx-confirm="Delete this message?"
                >
                    Delete
                </button>
            </div>
            HTML;
        }
        
        return <<<HTML
        <div class="chat {$chatAlignment}" id="message-{$message->id}">
            <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                    <img src="{$avatar}" />
                </div>
            </div>
            <div class="chat-header">
                {$message->user->name}
                <time class="text-xs opacity-50">{$timestamp}</time>
            </div>
            <div class="chat-bubble {$bubbleClass}">
                {$message->content}
            </div>
            {$deleteButton}
        </div>
        HTML;
    }

    /**
     * Generate dummy messages for demonstration.
     */
    private function generateDummyMessages(): void
    {
        // Get current user and create a dummy user if needed
        $currentUser = auth()->user();
        
        $dummyUser = User::where('email', 'dummy@example.com')->first();
        if (!$dummyUser) {
            $dummyUser = User::create([
                'name' => 'Demo User',
                'email' => 'dummy@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }
        
        // Sample conversation
        $conversation = [
            ['user' => $dummyUser->id, 'content' => 'Hello! Welcome to the chat demo.'],
            ['user' => $currentUser->id, 'content' => 'Hi there! Thanks for the welcome.'],
            ['user' => $dummyUser->id, 'content' => 'How are you today?'],
            ['user' => $currentUser->id, 'content' => 'I\'m doing well, thanks for asking!'],
            ['user' => $dummyUser->id, 'content' => 'This is a demonstration of the chat feature using HTMX and Laravel.'],
            ['user' => $currentUser->id, 'content' => 'It looks very clean and simple to use.'],
            ['user' => $dummyUser->id, 'content' => 'Yes, HTMX makes it very easy to create interactive features without complex JavaScript.'],
            ['user' => $dummyUser->id, 'content' => 'You can try typing a message below and sending it.'],
            ['user' => $currentUser->id, 'content' => 'Let me try that out!'],
            ['user' => $dummyUser->id, 'content' => 'You can also delete your own messages by clicking the delete button.'],
        ];
        
        // Create messages with timestamps spread over the last hour
        $time = now()->subHour();
        $timeIncrement = 60 / count($conversation); // minutes between messages
        
        foreach ($conversation as $msg) {
            $time = $time->addMinutes($timeIncrement);
            
            Message::create([
                'user_id' => $msg['user'],
                'content' => $msg['content'],
                'created_at' => $time,
                'updated_at' => $time,
            ]);
        }
    }
}