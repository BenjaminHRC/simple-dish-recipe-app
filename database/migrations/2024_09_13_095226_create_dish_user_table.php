<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //@TODO: renommer la table ?
        // @TODO: table1_action_table2 exemple: user_likes_posts
        Schema::create('dish_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('dish_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_user');
    }
};
