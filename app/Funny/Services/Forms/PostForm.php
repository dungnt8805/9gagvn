<?php
/**
 * @author dungnt13
 * @date 9/10/2015
 */

namespace App\Funny\Services\Forms;


class PostForm extends AbstractForm
{
    protected $rules = ['title' => 'required|min:5', 'content' => 'required'];
}