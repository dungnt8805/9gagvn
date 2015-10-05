<?php

/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 10:44 PM
 */
class SettingsTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'website_title', 'value' => 'Website Title', 'autoload' => false],
            ['name' => 'website_description', 'value' => 'Website Description', 'autoload' => false],
            ['name' => 'logo', 'value' => 'logo.png', 'autoload' => false],
            ['name' => 'favicon', 'value' => 'favicon.png', 'autoload' => false],
            ['name' => 'themes', 'value' => 'default', 'autoload' => false],
            ['name' => 'fb_key', 'value' => '950088648395990', 'autoload' => false],
            ['name' => 'fb_secret_key', 'value' => '34176eef8b7375dfbc1a329cd7057279', 'autoload' => false],
            ['name' => 'fb_page_id', 'value' => '34176eef8b7375dfbc1a329cd7057279', 'autoload' => false],
            ['name' => 'post_title_length', 'value' => '0', 'autoload' => false],
            ['name' => 'custom_css', 'value' => '', 'autoload' => false],
            ['name' => 'like_icon', 'value' => 'fa-thumbs-o-up', 'autoload' => false],
            ['name' => 'secondary_color', 'value' => '#12c3ee', 'autoload' => false],
            ['name' => 'primary_color', 'value' => '#ee222e', 'autoload' => false],
            ['name' => 'analytics', 'value' => '', 'autoload' => false],
            ['name' => 'infinite-scroll', 'value' => '1', 'autoload' => false],
            ['name' => 'enable_watermark', 'value' => '0', 'autoload' => false],
            ['name' => 'watermark_image', 'value' => 'watermark.png', 'autoload' => false],
            ['name' => 'watermark_position', 'value' => 'bottom-right', 'autoload' => false],
            ['name' => 'watermark_offset_x', 'value' => '0', 'autoload' => false],
            ['name' => 'watermark_offset_y', 'value' => '0', 'autoload' => false],
            ['name' => 'pages_in_menu', 'value' => '1', 'autoload' => false],
            ['name' => 'pages_in_menu_text', 'value' => 'More', 'autoload' => false],
            ['name' => 'infinite_load_btn', 'value' => '0', 'autoload' => false],
            ['name' => 'captcha', 'value' => '0', 'autoload' => false],
            ['name' => 'captcha_public_key', 'value' => '', 'autoload' => false],
            ['name' => 'captcha_private_key', 'value' => '', 'autoload' => false],
            ['name' => 'custom_js', 'value' => '', 'autoload' => false],
            ['name' => 'system_email', 'value' => 'system@shareiz.com', 'autoload' => false],
        ];
        DB::table('settings')->insert($data);
    }
}