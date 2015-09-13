<?php
/**
 * @author dungnt13
 * @date 9/11/2015
 */

namespace App\Funny\Repositories\Contracts;



interface TagRepositoryInterface
{
    /**
     * Create or check tag then return id
     *
     * @param string $str
     * @return mixed
     */
    public function firstOrNew($str);


}