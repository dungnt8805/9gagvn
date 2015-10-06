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
use Cache;


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
        $key = $this->model->KEY_GENERAL_SETTINGS.'ALL';
        if(Cache::has($key)){
            return Cache::get($key);
        }
        return Cache::rememberForever($key,function(){
            return $this->model->lists('value', 'name');
        });
    }

    public function loadAllSettingsByType($type = 1)
    {
        $key = $this->model->KEY_GENERAL_SETTINGS.$type;
        if(Cache::has($key)){
            return Cache::get($key);
        }
        return Cache::rememberForever($key,function() use($type){
            return $this->model->whereType($type)->lists('value', 'name');
        });

    }
    
    public function updateGeneralSettings($input){
        // Website_title
        $this->updateSetting('website_title',$input['website_title']);
        // website_description
        $this->updateSetting('website_description',$input['website_description']);
        
        // color schema
        $this->updateSetting('primary_color',$input['primary_color']);
        $this->updateSetting('secondary_color',$input['secondary_color']);
        
        // analytics
        $this->updateSetting('analytics',stripslashes($input['analytics']));
        
        // facebook app information
        $this->updateSetting('fb_key',$input['fb_key']);
        $this->updateSetting('fb_secret_key',$input['fb_secret_key']);
        $this->updateSetting('facebook_page_id',$input['facebook_page_id']);
        
        // like icon
        $this->updateSetting('like_icon',$input['like_icon']);
        
        // infinite scroll
        if(isset($input['infinite_scroll'])){
			$input['infinite_scroll'] = 1;
		} else {
			$input['infinite_scroll'] = 0;
		}
		$this->updateSetting('infinite_scroll',$input['infinite_scroll']);
		
		if(isset($input['infinite_load_btn'])){
			$input['infinite_load_btn'] = 1;
		} else {
			$input['infinite_load_btn'] = 0;
		}
		$this->updateSetting('infinite_load_btn',$input['infinite_load_btn']);
		//
		if(isset($input['random_bar_enabled'])){
			$input['random_bar_enabled'] = 1;
		} else {
			$input['random_bar_enabled'] = 0;
		}
        $this->updateSetting('random_bar_enabled',$input['random_bar_enabled']);
        
        // system email
        $this->updateSetting('system_email',$input['system_email']);
        
        // 
        if(isset($input['auto_approve_posts'])){
			$input['auto_approve_posts'] = 1;
		} else {
			$input['auto_approve_posts'] = 0;
		}
		$this->updateSetting('auto_approve_posts',$input['auto_approve_posts']);
		//
		if(isset($input['user_registration'])){
			$input['user_registration'] = 1;
		} else {
			$input['user_registration'] = 0;
		}
		$this->updateSetting('user_registration',$input['user_registration']);
		
		//
		if(isset($input['infinite_scroll'])){
			$input['infinite_scroll'] = 1;
		} else {
			$input['infinite_scroll'] = 0;
		}
		
		
		//
		if(isset($input['enable_watermark'])){
			$input['enable_watermark'] = 1;
		} else {
			$input['enable_watermark'] = 0;
		}
		
		$this->updateSetting('enable_watermark',$input['enable_watermark']);
		
		Cache::forget($this->model->KEY_GENERAL_SETTINGS.$this->model->GENERAL_TYPE);
		Cache::rememberForever($this->model->KEY_GENERAL_SETTINGS.$this->model->GENERAL_TYPE,function(){
		   return $this->loadAllSettingsByType(); 
		});
    }
    
    public function updateSetting($name, $value,$type = 1,$autoload = 0){
        $object = $this->model->whereName($name)->first();
        if(is_null($object))
            $object = $this->getNew();
        $object->name = $name;
        $object->value = $value;
        $object->type = $type;
        $autoload = $autoload;
        $object->save();
    }

}