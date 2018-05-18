<?php
/**
 * Created by PhpStorm.
 * User: West
 * Date: 5/18/2018
 * Time: 3:41 PM
 */

namespace App\Handlers\Transformers;

/**
 * Class Transformer
 * @package App\Handlers\Transformers
 */
abstract class Transformer
{
    /**
     * This one for Collection
     * @param $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);

}
