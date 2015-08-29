<?php
/**
 * @author dungnt13
 * @date 8/28/2015
 */

namespace App\Funny\Presenters;


class CategoryPresenter
{
    /**
     * Sort categories to tree array
     *
     * @param array $source
     *
     * @return array $list
     */
    public function sortedTree($source)
    {
        $refs = array();
        $list = array();
        foreach ($source as $s) {
            $ref = &$refs[$s->id];
            $ref['id'] = $s->id;
            $ref['parent_id'] = $s->parent_id;
            $ref['title'] = $s->title;
            $ref['slug'] = $s->slug;
            $ref['description'] = $s->description;
            if ($s->parent_id == 0) {
                $list[$s->id] = &$ref;
            } else {
                $refs[$s->parent_id]['children'][$s->id] = &$ref;
            }
        }
        return $list;
    }

    /**
     * Generate array tree to list
     *
     * @param array $array
     * @return string
     */
    public function toUL(array $array)
    {
        $html = '<ul>' . PHP_EOL;

        foreach ($array as $value) {
            $html .= '<li>' . $value['title'];
            if (!empty($value['children'])) {
                $html .= $this->toUL($value['children']);
            }
            $html .= '</li>' . PHP_EOL;
        }

        $html .= '</ul>' . PHP_EOL;

        return $html;
    }

    /**
     * Generate categories tree to select box
     *
     * @param $source
     * @param array $lists
     * @param int $repeat
     * @param int $except
     * @return array
     */
    public function selectBoxTree($source, $lists = [0 => 'None'], $repeat = 0, $except = 0)
    {
        foreach ($source as $value) {
            if ($value['id'] != $except) {
                $lists[$value['id']] = str_repeat('— ', $repeat) . $value['title'];
                if (!empty($value['children'])) {
                    $lists = $this->selectBoxTree($value['children'], $lists, $repeat + 1, $except);
                }
            }
        }
        return $lists;
    }

    /**
     * Generate array categories with properties
     *
     * @param $source
     * @param int $repeat
     * @param array $lists
     * @return array
     */
    public function getListTree($source, $repeat = 0, $lists = array())
    {
        foreach ($source as $value) {
            $title = $value['title'];
            $value['title'] = str_repeat('— ', $repeat) . $title;
            $lists[] = $value;
            if (!empty($value['children'])) {
                $lists = $this->getListTree($value['children'], $repeat + 1, $lists);
            }
        }
        return $lists;
    }
}