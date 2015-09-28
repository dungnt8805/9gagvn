<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Funny\Repositories\Eloquent;


use App\Funny\Models\Post;
use App\Funny\Repositories\Contracts\BaseRepository;
use App\Funny\Repositories\CategoryRepositoryInterface;
use App\Funny\Repositories\Contracts\LikeRepositoryInterface;
use App\Funny\Repositories\Contracts\PostRepositoryInterface;
use App\Funny\Repositories\Contracts\TagRepositoryInterface;
use App\Funny\Repositories\StoreRepositoryInterface;
use App\Funny\Services\Forms\PostForm;
use Illuminate\Support\Str;
use Auth;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected $category;

    protected $store;

    protected $tag;

    protected $like;

    /**
     * Create a new DbPostRepository instance.
     *
     * @param  \App\Funny\Models\Post $post
     */


    public function __construct(Post $post, CategoryRepositoryInterface $category
        , StoreRepositoryInterface $store, TagRepositoryInterface $tag, LikeRepositoryInterface $like)
    {
        $this->model = $post;
        $this->category = $category;
        $this->store = $store;

        $this->tag = $tag;
        $this->like = $like;
    }

    /**
     * Get category repository
     *
     * @return \App\Funny\Repositories\Contracts\
     */
    public function getCategoryRepo()
    {
        return $this->category;
    }

    /**
     * Get store repository
     *
     * @return \App\Funny\Repositories\Contracts\
     */
    public function getStoreRepo()
    {
        return $this->store;
    }

    /**
     * Clean data input
     *
     * @param array $array
     * @return mixed
     */

    public function cleanData(array $array)
    {
        $data = [];
        if ($array['categories']) {
            $data['categories'] = $array['categories'];
        }
        unset($array['categories']);
        if ($array['is_avatar']) {
            $array['thumbnail'] = $array['is_avatar'];
        }
        unset($array['is_avatar']);
        if ($array['tags']) {
            $data['tags'] = $array['tags'];
        }
        unset($array['tags']);
        $data['post'] = $array;
        return $data;
    }

    public function getForm()
    {
        return new PostForm;
    }

    /**
     * Create or update a post
     *
     * @param \App\Funny\Models\Post $post
     * @param array $array
     * @param integer $user_id
     * @return \App\Funny\Models\Post
     */

    public function savePost($post, $array, $user_id = null)
    {
        foreach ($array as $key => $value) {
            $post->{$key} = $value;
        }
        $post->slug = Str::slug($post->title);
        if ($user_id != null)
            $post->user_id = $user_id;
        $post->save();
        return $post;

    }

    /**
     * Process save a post and references
     *
     * @param array $data
     * @param integer $id
     * @param integer $user_id
     * @return Post
     * @internal param Post $post
     */
    public function updatePost($data, $id = 0, $user_id = null)
    {
        $post = ($id == 0) ? $this->_getNew() : $this->findById($id);

        $categories = [];
        $tags = '';
        if (array_key_exists('_token', $data)) {
            unset($data['_token']);
        }
        if (array_key_exists('is_avatar', $data)) {
            $data['thumbnail'] = $data['is_avatar'];
            unset($data['is_avatar']);
        }
        if (array_key_exists('categories', $data)) {
            $categories = $data['categories'];
            unset($data['categories']);
        }
        if (array_key_exists('photo', $data)) {
            unset($data['photo']);
        }
        if (array_key_exists('tags', $data)) {
            $tags = $data['tags'];
            unset($data['tags']);
        }

        $post = $this->savePost($post, $data, $user_id);

        $post->categories()->sync($categories);

        $tag_ids = [];
        if ($tags != '') {
            $tags = explode(',', $tags);
            foreach ($tags as $tag) {
                $tag_id = $this->tag->firstOrNew($tag);
                array_push($tag_ids, $tag_id);
            }
        }
        $post->tags()->sync($tag_ids);
        return $post;
    }

    /**
     * Get post collection
     *
     * @param int $n
     * @param string $q
     * @param int $category
     * @param int $user_id
     * @param string $orderBy
     * @param string $direction
     * @return \Illuminate\Support\Collection
     */
    public function index($n, $q = null, $category = null, $user_id = null, $orderBy = 'created_at', $direction = 'desc', $check_liked = 0)
    {
        $query = $this->model->select('posts.id', 'posts.title', 'posts.created_at', 'posts.active', 'posts.slug'
            , 'posts.thumbnail', 'posts.summary', 'posts.views', 'posts.code', 'posts.youtube_id', 'posts.type', 'users.name'
            , 'users.id as user_id', 'username', 'posts.views', 'posts.likes'
        )
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->orderBy($orderBy, $direction);
        $appends = ['orderby' => $orderBy, 'dir' => $direction];
        if ($q != null) {
            $query->where('posts.title', 'LIKE', "%$q%")->orWhere('posts.slug', 'LIKE', '%' . Str::slug($q) . '%');
            $appends['q'] = $q;
        }
        if ($category != null && $category != 0) {
            $query->join('category_post', 'category_post.post_id', '=', 'posts.id')->where('category_post.category_id', '=', $category);
            $appends['category'] = $category;
        }
        if ($user_id != null) {
            $query->where('user_id', '=', $user_id);
            $appends['user_id'] = $user_id;
        }
        if ($check_liked) {
            
        }

        return $query->paginate($n)->appends($appends);

    }

    /**
     * Get resource an references to edit
     *
     * @param $id
     * @return \Illuminate\Support\Collection;
     */
    public function edit($id)
    {
        return $this->model->with('categories', 'tags')->findOrFail($id);
    }

    /**
     * auto generate identity string
     *
     * @return string
     */
    public function generateId()
    {
        $ids = [];
        $ids = $this->model->lists('code');
        $id = randomString(8);
        while (is_array($ids) && in_array($id, $ids)) {
            $id = randomString(8);
        }
        return $id;
    }

    /**
     * create new instance with id
     *
     * @return static
     */
    public function _getNew()
    {
        return $this->getNew(['code' => $this->generateId(), 'user_id' => Auth::user()->id]);
    }


    /**
     * Get one post by code
     *
     * @param $code
     * @return \App\Funny\Models\Post
     */
    public function getByCode($code)
    {
        $query = $this->model->select('posts.id', 'posts.code', 'posts.title', 'posts.thumbnail', 'posts.type', 'posts.embed'
            , 'posts.summary', 'posts.content', 'posts.views', 'posts.created_at', 'username', 'users.avatar', 'posts.user_id'
            , 'users.name', 'comments', 'youtube_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
//            ->join('comments','comments.post_id','=','posts.id')
            ->whereCode($code)->whereActive(true)->first();
        return $query;
    }


    /**
     * increase view
     *
     * @param \App\Funny\Models\Post $post
     * @return mixed
     */
    public function increaseView($post)
    {
        $post->views += 1;
        $post->save();
    }


    /**
     *
     * @param $post_id
     * @param $user_id
     * @return integer
     */
    public function like($post_id, $user_id)
    {
        $i = 0;
        $post = $this->findById($post_id);
        if (!is_null($post)) {
            $check = $this->like->checkLike($post_id, $user_id);
            if (is_null($check) || $check->score == -1) {
                $i = 1;
                if (!is_null($check) && $check->score == -1) {
                    $i = 2;
                    $check->delete();
                }

                $post->likes()->attach($user_id);
                $post->likes += $i;
                $post->save();
            }
        }
        return $i;
    }

    /**
     *
     * @param $post_id
     * @param $user_id
     * @return integer
     */
    public function unlike($post_id, $user_id)
    {
        $i = 0;
        $post = $this->findById($post_id);
        if (!is_null($post)) {
            $check = $this->like->checkLike($post_id, $user_id);
            if (is_null($check)) {
                $i = 1;
                if ($check->score == -1) {
                    $i = -1;
                }
                $post->likes()->dettach($user_id);
                $post->likes -= $i;
                $post->save();
            }
        }
        return $i;

    }

    /**
     *
     * @param $post_id
     * @param $user_id
     * @return integer
     */
    public function dislike($post_id, $user_id)
    {
        $i = 0;
        $post = $this->findById($post_id);
        if (!is_null($post)) {
            $check = $this->like->checkLike($post_id, $user_id);
            if (is_null($check) || $check->score == 1) {
                $i = 1;
                if ($check->score == 1) {
                    $i = 2;
                    $check->delete();
                }

                $post->likes()->attach($user_id, ['score' => -1]);
                $post->likes -= $i;
                $post->save();
            }
        }
        return $i;
    }
}