<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 26.07.19
 * Time: 12:09
 */

namespace Mymodule\Test\Model\ResourceModel\Page;

use Magento\Framework\Data\OptionSourceInterface;

use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;

class Sourse implements OptionSourceInterface
{
    protected $pageCollectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->pageCollectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $collection = $this->pageCollectionFactory->create()->getData();
        $return = array();
        foreach ($collection as $item){
            $return[] = ['value' =>$item['page_id'],'label' => $item['identifier']];
        }

        return $return;
    }
}