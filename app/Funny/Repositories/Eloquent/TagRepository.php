<?php
/**
 * @author dungnt13
 * @date 9/11/2015
 */

namespace App\Funny\Repositories\Eloquent;


use App\Funny\Models\Tag;
use App\Funny\Repositories\BaseRepository;
use App\Funny\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\Str;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * Create or check tag then return id
     *
     * @param string $str
     * @return mixed
     */
    public function firstOrNew($str)
    {
        $tag = $this->model->whereSlug(Str::slug($str))->orWhere('tag', '=', $str)->first();
        if (is_null($tag)) {
            $tag = $this->getNew();
            $tag->tag = $str;
            $tag->slug = Str::slug($str);
            $tag->save();
        }
        return $tag->id;
    }
}