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
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->linkRepository = $linkRepository;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        if (empty($items)) {
            return [];
        }
        /** @var $status LinkInterface */
        foreach ($items as $link) {
            $this->loadedData[$link->getId()] = $this->linkRepository->getById($link->getId())->getData();

        }
        return $this->loadedData;
    }


}