<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Funny\Services\Forms;


class CategoryForm extends AbstractForm
{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'title'        => 'required',
        'description' => 'required|min:4'
    ];
}