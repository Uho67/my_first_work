<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 15:39
 */

namespace Mymodule\Test\Ui\Listing\Bunch;

use Mymodule\Test\Model\ResourceModel\Link\CollectionFactory;


class LinkColumn implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
{
    $this->collectionFactory = $collectionFactory;
}
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
{
    $myReturn = array();
    $collection = $this->collectionFactory->create();
    $items = $collection->getData();
    foreach ($items as $item){
        $arr =  ['value' => $item['link_id'],'label' => $item['link_text']];
        $myReturn[] = $arr;
    }
    return $myReturn;
}
}