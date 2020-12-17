<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            
            // $table->unsignedBigInteger('user_id')->foreign();
            // $table->foreign('user_id')->references('id')->on('users');

            $table->foreignId('user_id')->constrained();    // Foreign Key fix
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            // $table->dropForeign(['user_id']);   // you have to drop Foreign Key status BEFORE dropping the actual Column!
            // the [ ] array notation points laravel to foreign key on user_id column instead of naming the key by it's
            // precise name, which is likely to be something like "blog_post_user_id_index" - see table Structure

            // $table->dropColumn('user_id');
        });
    }
}

// IMPORTANT - this won't work in basic format as we're tryig to create a Foreign Key on Blog Posts table - but IF data already exists in Blog Posts then existing records will NOT contain a Foreign key value, so it will create the column, values all zero and NO Foreign Key Index

// Solution 1: $table->unsignedBigInteger('user_id')->nullable();
// this will create column and FK index - but then we're left with a load of Null Vlues in existing data - to be manually updated - not very practial

// Soluton 2: use php artisan migrate:refresh
// will recreate DB entirely from scratch with brand new structure but NO DATA - all ERASED!