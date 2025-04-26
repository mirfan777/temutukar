<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <--- Tambahkan ini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->geometry('positions', subtype: 'point', srid: 4326);
            $table->unsignedBigInteger('user_id');
            $table->string('category');
            $table->string('title');
            $table->text('description');
            $table->boolean('terms_required');
            $table->text('terms_description');
            $table->string('image');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
