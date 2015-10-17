<?php

/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/8/15
 * Time: 10:40 PM
 */
use Illuminate\Support\Str;

class RolesTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $roles = [
            ['title' => 'Member', 'slug' => Str::slug('Member')],
            ['title' => 'Senior Member', 'slug' => Str::slug('Senior Member')],
            ['title' => 'Vip', 'slug' => Str::slug('Vip')],
            ['title' => 'Moderator', 'slug' => Str::slug('Moderator')],
            ['title' => 'Super Moderator', 'slug' => Str::slug('Super Moderator')],
            ['title' => 'Administrator', 'slug' => Str::slug('Administrator')],
            ['title' => 'Root', 'slug' => Str::slug('Root')],
        ];
        \DB::table('roles')->insert($roles);
    }
}