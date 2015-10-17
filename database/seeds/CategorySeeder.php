<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/20/15
 * Time: 10:11 AM
 */
class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['title' => 'Gái xinh', 'slug' => 'gai-xinh'],
            ['title' => 'TV-how', 'slug' => 'tv-show'],
        ];
        DB::table('categories')->insert();
    }
}