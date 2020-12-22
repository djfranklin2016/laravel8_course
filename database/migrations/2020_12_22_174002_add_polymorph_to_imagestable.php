<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPolymorphToImagestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
        $table->dropColumn('blog_post_id');     // get rid of blog_post_id and replace with morphs below

        // $table->unsignedBigInteger('imageable_id');
        // $table->string('imageable_type');

        $table->morphs('imageable');    // creates BOTH of the above as well as a Composite key considting of both fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagestable', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_post_id')->nullable();     // reinstate Images Table blog_post_id
            $table->dropMorphs('imageable');                            // drop morphs and composite key
        });
    }
}
