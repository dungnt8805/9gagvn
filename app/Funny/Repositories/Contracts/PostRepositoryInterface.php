<?php
/**
 * @author dungnt13
 * @date 9/10/2015
 */

namespace App\Funny\Repositories\Contracts;


interface PostRepositoryInterface
{
    /**
     * Get category repository
     *
     * @return \App\Funny\Repositories\Contracts\
     */
    public function getCategoryRepo();

    /**
     * Get store repository
     *
     * @return \App\Funny\Repositories\Contracts\
     */
    public function getStoreRepo();

    /**
     *
     *
     * @return mixed
     */
    public function getForm();

    /**
     * Clean data input
     *
     * @param array $array
     * @return mixed
     */
    public function cleanData(array $array);

    /**
     * Create or update a post
     *
     * @param \App\Funny\Models\Post $post
     * @param array $array
     * @param integer $user_id
     * @return \App\Funny\Models\Post
     */
    public function savePost($post, $array, $user_id = null);

    /**
     * Process save a post and references
     *
     * @param array $data
     * @param integer $id
     * @param integer $user_id
     * @return \App\Funny\Models\Post
     */
    public function updatePost($data, $id = null, $user_id = null);

    /**
     * Get post collection
     * @param int $n
     * @param string $q
     * @param int $category
     * @param int $user_id
     * @param string $orderBy
     * @param string $direction
     * @param array $array
     * @return \Illuminate\Support\Collection
     */
    public function index($n, $q = null, $category = null, $user_id = null, $orderBy = 'created_at', $direction = 'desc', $array = null);


    /**
     * Get resource an references to edit
     *
     * @param $id
     * @return \Illuminate\Support\Collection;
     */
    public function edit($id);

    /**
     * auto generate identity string
     *
     * @return string
     */
    public function generateId();

    /**
     * create new instance with id
     *
     * @return static
     */
    public function _getNew();

    /**
     * Get one post by code
     *
     * @param $code
     * @return \App\Funny\Models\Post
     */
    public function getByCode($code);

    /**
     * increase view
     *
     * @param \App\Funny\Models\Post $post
     * @return mixed
     */
    public function increaseView($post);

    /**
     *
     * @param $post_id
     * @param $user_id
     * @return integer
     */
    public function like($post_id, $user_id);

    /**
     *
     * @param $post_id
     * @param $user_id
     * @return integer
     */
    public function unlike($post_id, $user_id);

    /**
     *
     * @param $post_id
     * @param $user_id
     * @return integer
     */
    public function dislike($post_id, $user_id);

    /**
     * Get random post from database
     *
     * @return \App\Funny\Models\Post $post
     *
     */
    public function randomPost();

    /**
     * Get the next article from database
     *
     * @param $post_id
     * @return string
     */
    public function getNext($post_id);

    /**
     * Get the prev article from database
     *
     * @param $post_id
     * @return string
     */
    public function getPrev($post_id);
}