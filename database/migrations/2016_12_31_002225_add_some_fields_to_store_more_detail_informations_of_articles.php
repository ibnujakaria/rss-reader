<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeFieldsToStoreMoreDetailInformationsOfArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function ($table) {
            $table->string('picture', 900)->nullable()->after('link');
            $table->longtext('body')->nullable()->after('description');
            $table->boolean('grabbed')->default(0)->after('author');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function ($table) {
            $table->dropColumn('picture');
            $table->dropColumn('body');
            $table->dropColumn('grabbed');
        });
    }
}
