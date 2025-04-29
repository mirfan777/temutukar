<!-- resources/views/pages/chat/chat.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-base-100 shadow-xl rounded-box">
                <!-- Chat interface container -->
                <div class="flex flex-col h-[70vh]">
                    <!-- Chat header -->
                    <div class="bg-base-200 p-4 rounded-t-box flex items-center gap-3 border-b border-base-300">
                        <div class="avatar online">
                            <div class="w-10 rounded-full">
                                <img src="https://ui-avatars.com/api/?name=Chat&background=random" alt="Chat avatar" />
                            </div>
                        </div>
                        <div>
                            <h3 class="font-medium">Chat Room</h3>
                            <div class="text-xs text-base-content/70">{{ auth()->user()->name }} and others</div>
                        </div>
                        <div class="ml-auto">
                            <button class="btn btn-sm btn-ghost btn-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Messages area -->
                    <div 
                        id="messages-container" 
                        class="flex-1 overflow-y-auto p-4 space-y-4"
                        hx-get="{{ route('chat.fetch') }}"
                        hx-trigger="load, every 3s"
                    >
                        @if(isset($messages) && count($messages) > 0)
                            @foreach($messages as $message)
                                <div class="chat {{ auth()->id() === $message->user_id ? 'chat-end' : 'chat-start' }}" id="message-{{ $message->id }}">
                                    <div class="chat-image avatar">
                                        <div class="w-10 rounded-full">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($message->user->name) }}&background=random" />
                                        </div>
                                    </div>
                                    <div class="chat-header">
                                        {{ $message->user->name }}
                                        <time class="text-xs opacity-50">{{ $message->created_at->format('H:i') }}</time>
                                    </div>
                                    <div class="chat-bubble {{ auth()->id() === $message->user_id ? 'chat-bubble-primary' : '' }}">
                                        {{ $message->content }}
                                    </div>
                                    @if(auth()->id() === $message->user_id)
                                        <div class="chat-footer opacity-50 text-xs flex gap-1 items-center">
                                            <button 
                                                class="btn btn-ghost btn-xs"
                                                hx-delete="{{ route('chat.delete', $message->id) }}"
                                                hx-target="#message-{{ $message->id }}"
                                                hx-swap="outerHTML"
                                                hx-confirm="Delete this message?"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <script>
                                document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;
                            </script>
                        @else
                            <div class="text-center text-gray-500 py-8">
                                No messages yet. Start the conversation!
                            </div>
                        @endif
                    </div>

                    <!-- Typing indicator -->
                    <div id="typing-indicator" class="px-4 py-2 text-sm text-base-content/70 hidden">
                        Someone is typing...
                    </div>

                    <!-- Message input -->
                    <div class="p-4 border-t border-base-300">
                        <form 
                            hx-post="{{ route('chat.send') }}"
                            hx-target="#messages-container"
                            hx-swap="beforeend"
                            class="flex items-center gap-2"
                            hx-on::after-request="this.reset(); document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;"
                        >
                            @csrf
                            <button type="button" class="btn btn-circle btn-ghost btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <input 
                                type="text" 
                                name="content" 
                                class="input input-bordered flex-1"
                                placeholder="Type your message..."
                                required
                                hx-post="{{ route('chat.typing') }}"
                                hx-trigger="keyup changed delay:500ms"
                                hx-swap="none"
                            >
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>