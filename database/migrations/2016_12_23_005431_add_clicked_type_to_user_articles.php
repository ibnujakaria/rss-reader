<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClickedTypeToUserArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `user_articles`
CHANGE `type` `type` enum('favorited','saved_to_read_later','clicked') COLLATE 'utf8_unicode_ci' NOT NULL AFTER `article_id`;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("ALTER TABLE `user_articles`
CHANGE `type` `type` enum('favorited','saved_to_read_later') COLLATE 'utf8_unicode_ci' NOT NULL AFTER `article_id`;");
    }
}
