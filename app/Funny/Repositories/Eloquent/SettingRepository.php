<?php
/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 10/1/15
 * Time: 11:03 PM
 */

namespace App\Funny\Repositories\Eloquent;


use App\Funny\Models\Setting;
use App\Funny\Repositories\Contracts\BaseRepository;
use App\Funny\Repositories\Contracts\SettingRepositoryInterface;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * @var Singleton The references to *Singleton* instance of this class
     */

    private static $instance;

    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    /**
     * load setting by name
     *
     * @param string $name
     * @return \App\Funny\Models\Setting;
     */
    public function load($name)
    {
        $setting = $this->model->whereName($name)->first();
        if (is_null($setting))
            $setting = $this->getNew(['name' => $name, 'value' => '', 'autoload' => false]);
        return $setting;
    }

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            $setting = new Setting();
            static::$instance = new static($setting);
        }

        return static::$instance;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }


    public function loadAllSettings()
    {
        return $this->model->lists('value', 'name');
    }

    public function loadAllSettingsByType($type = 1)
    {
        return $this->model->whereType($type)->lists('value', 'name');
    }

}