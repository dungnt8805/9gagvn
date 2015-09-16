<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/9/2015
 * Time: 9:41 AM
 */

namespace App\Funny\Services;

use Config,
    File,
    Log,
    Carbon\Carbon,
    Dflydev\ApacheMimeTypes\PhpRepository as DFlyDevMiMe,
    Illuminate\Support\Facades\Storage;

class Image
{

    protected $disk;
    protected $mimeDetect;

    public function __construct()
    {
        $this->disk = Storage::disk(config('cms.uploads.storage'));
//        $this->mimeDetect = $mimeDetect;
    }

    /**
     * Sanitize the folder name
     *
     * @param string $folder
     * @return string
     */
    protected function cleanFolder($folder)
    {
        return '/' . trim(str_replace('..', '', $folder), '/');
    }

    /**
     * Create folder follow format Y/m/d
     *
     * @param  $dir
     * @return string
     */
    protected function dirFolder($dir = '')
    {
        return $dir . '/' . date('Y') . "/" . date('m') . "/" . date('d');
    }

    /**
     * @param $file
     * @return string
     */
    protected function fileName($file)
    {
        return Config::get('cms.uploads.prefix') . "_" . time() . md5(time() . $file) . "_$file";
    }

    /**
     * @param $file
     * @param $content
     * @param  $dir
     * @return string
     */
    public function saveFile($file, $content, $dir = '')
    {
        $return = ['msg' => '', 'status' => 'Failed'];
        $folder = $this->dirFolder($dir);
        $file_name = $this->fileName($file);
        $path = $this->cleanFolder($folder . '/' . $file_name);
        if ($this->disk->exists($path)) {
            $return['msg'] = 'File already exists';
        }
        $upload = $this->disk->put($path, $content);
        if ($upload) {
            $return['status'] = 'success';
            $return['file_name'] = $file_name;
            $return['folder'] = "uploads$folder";
        }
        return $return;
    }

    public function deleteFile($path)
    {
        $path = $this->cleanFolder($path);

        if (!$this->disk->exists($path)) {
            return "File does not exist.";
        }

        return $this->disk->delete($path);
    }

}