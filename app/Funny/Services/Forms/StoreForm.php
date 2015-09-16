<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/2/2015
 * Time: 10:36 AM
 */

namespace App\Funny\Services\Forms;


class StoreForm extends AbstractForm
{
    protected $rules = [
        'title' => 'required'
    ];
}