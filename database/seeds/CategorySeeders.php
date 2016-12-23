<?php

use Illuminate\Database\Seeder;

class CategorySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
        	[
        		'title' => 'Sport',
        		'slug'	=> 'sport'
    		],
    		[
        		'title' => 'Muslim',
        		'slug'	=> 'muslim'
    		],
    		[
        		'title' => 'Technology',
        		'slug'	=> 'technology'
    		],
    		[
        		'title' => 'Politics',
        		'slug'	=> 'politics'
    		],
    		[
        		'title' => 'Programming',
        		'slug'	=> 'programming'
    		],
        ]);

    }
}
