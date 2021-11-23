<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueTitleUserIdIndexFromNotes extends Migration
{
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropUnique(['title', 'user_id']);
        });
    }

    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->unique(['title', 'user_id']);
        });
    }
}
