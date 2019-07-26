<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:06
 */

namespace Mymodule\Test\Api\Links;


interface LinkSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    public function getItems();
    public function setItems(array $items);
}
