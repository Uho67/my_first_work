<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 14:27
 */

namespace Mymodule\Test\Api\Bunch;


interface BunchSearchResultInterface  extends \Magento\Framework\Api\SearchResultsInterface
{
    public function getItems();
    public function setItems(array $items);
}