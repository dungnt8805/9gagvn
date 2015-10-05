<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 11:02 PM
 */

namespace App\Funny\Repositories\Contracts;


interface SettingRepositoryInterface
{
    /**
     * load setting by name
     *
     * @param string $name
     * @return \App\Funny\Models\Setting;
     */
    public function load($name);

    /**
     * Save Setting to database
     *
     * @param $value
     * @param $autoload
     * @param $name
     * @param null $id
     * @return mixed
     */
//    public function update($value, $autoload, $name, $id = null);
}