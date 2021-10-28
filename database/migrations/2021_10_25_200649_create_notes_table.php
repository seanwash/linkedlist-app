<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->text('content')->nullable();
            $table->boolean('is_daily')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->foreignId('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['title', 'user_id']);
        });

        DB::statement('ALTER TABLE notes ADD FULLTEXT search(title, content)');
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
