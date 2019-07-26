<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 11:01
 */

namespace Mymodule\Test\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;

use Mymodule\Test\Api\Links\LinkInterface;
use Mymodule\Test\Api\Bunch\BunchInterface;
use Mymodule\Test\Model\ResourceModel\Link\CollectionFactory;
use Mymodule\Test\Model\ResourceModel\Bunch\CollectionFactory as BunchCollection;


class LinkProvider  extends AbstractDataProvider
{
    protected $bunchCollectinFactory;
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param CollectionFactory $bunchCollection
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        BunchCollection $bunchCollection,
        array $meta = [],
        array $data = []
    ) {
        $this->bunchCollectinFactory = $bunchCollection;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {

        $bunchCollection = $this->bunchCollectinFactory->create()->getData();
        $pages_id = array();
        foreach ($bunchCollection as $item){
            $pages_id[]=$item['page_id'];
        }

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        if (empty($items)) {
            return [];
        }
        /** @var $status LinkInterface */
        foreach ($items as $link) {
            $this->loadedData[$link->getId()] = $link->getData();
            $this->loadedData[$link->getId()]['page_id'] = $pages_id;
        }
        return $this->loadedData;
    }


}