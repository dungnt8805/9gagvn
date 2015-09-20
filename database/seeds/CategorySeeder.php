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
        DB::table('categories')->insert();
    }
}