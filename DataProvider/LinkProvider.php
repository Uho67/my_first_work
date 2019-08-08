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
use Mymodule\Test\Model\ResourceModel\Link\CollectionFactory;
use Mymodule\Test\Api\LinkRepositoryInterface;


class LinkProvider  extends AbstractDataProvider
{


    protected $_registry;
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param CollectionFactory $bunchCollection
     * @param array             $meta
     * @param array             $data
     */
    protected $linkRepository;
    public function __construct(
        LinkRepositoryInterface $linkRepository,
        \Magento\Framework\Registry $registry,
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->linkRepository = $linkRepository;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        $model = $this->_registry->registry('mymodule_test_current_link');
        if($model!=null) {
            $this->loadedData[$model->getId()] = $model->getData();
            return $this->loadedData;
        }else return [];
    }


}