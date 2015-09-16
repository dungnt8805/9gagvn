<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/9/2015
 * Time: 9:00 AM
 */

namespace App\Funny\Services\Forms;


class MediaForm extends AbstractForm
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'title' => 'image|max:20000|mimes:jpg,jpeg,png'
    ];
}