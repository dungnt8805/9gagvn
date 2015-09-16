<?php
/**
 * Created by PhpStorm.
 * User: nguyentuan
 * Date: 9/9/2015
 * Time: 9:08 AM
 */

namespace App\Funny\Repositories\Eloquent;


use App\Funny\Models\Media;
use App\Funny\Repositories\Contracts\BaseRepository;
use App\Funny\Repositories\Contracts\MediaRepositoryInterface;
use App\Funny\Services\Forms\MediaForm;

class MediaRepository extends BaseRepository implements MediaRepositoryInterface
{
    public function __construct(Media $media)
    {
        $this->model = $media;
    }

    public function getForm()
    {
        return new MediaForm;
    }
}