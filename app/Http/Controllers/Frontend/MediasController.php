<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/7/2015
 * Time: 3:07 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Funny\Repositories\Contracts\MediaRepositoryInterface;
use App\Funny\Services\Image;
use File;
use ImageManager;
use Config;
use Timthumb;

class MediasController extends FrontendController
{

    protected $media;

    public function __construct(MediaRepositoryInterface $media)
    {
        parent::__construct();
        $this->media = $media;
    }

    public function getUpload()
    {

    }

    public function postUpload()
    {
        $json = [];
        $json["error"] = "not_uploaded";
        $form = $this->media->getForm();
        if (!$form->isValid()) {
            $json['error'] = 'Ảnh không đúng định dạng!';
        } else {
            $data = $form->getInputData();
            $file_name = $data['name'];
            $file = $_FILES['file'];
            $content = File::get($file['tmp_name']);

            $upload = ImageManager::saveFile($file_name, $content);
            if ($upload['status'] == 'success') {
                $media_data = ['file_path' => $upload['folder'], 'file_name' => $upload['file_name'], 'type' => 1];
                $media = $this->media->create($media_data);
                $url = $media->file_path . '/' . $media->file_name;
                $json['error'] = 'success';
                $json['id'] = $media->id;
                $json['is_avatar'] = $url;
                $json['image_thumb'] = Timthumb::link($url, 90, 90, 1);
                $json['image_500'] = Timthumb::link($url, 550, 500, 1);
                $json['image_max'] = Timthumb::link($url, 800, 800);

            } else {
                $json['error'] = 'Có lỗi xảy ra trong quá trình upload';
            }
        }

        return $this->json($json);

    }

    public function postDelete()
    {
        $id = \Input::get('id');
        $media = $this->media->findById($id);
        $json = ['error' => 'success'];
        if ($media) {
            $path = $media->file_path . '/' . $media->file_name;
            $delete = ImageManager::deleteFile($path);
            $media->forceDelete();
        } else
            $json['error'] = 'not_exists';
        return $this->json($json);

    }
}