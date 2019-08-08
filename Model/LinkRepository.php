<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:16
 */

namespace Mymodule\Test\Model;


class LinkRepository implements \Mymodule\Test\Api\LinkRepositoryInterface
{
    /** @var \Mymodule\Test\Model\ResourceModel\Link */
    protected $resource;

    /** @var \Mymodule\Test\Model\LinkFactory  */
    protected $linksFactory;

    /** @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var \Mymodule\Test\Model\ResourceModel\Link\CollectionFactory */
    protected $collectionFactory;

    /** @var \Mymodule\Test\Api\Links\LinkSearchResultInterfaceFactory */
    protected $searchResultsFactory;


    protected $messageManager;

    public function __construct(

        \Mymodule\Test\Model\ResourceModel\Link $resource,
        \Mymodule\Test\Model\LinkFactory $linksFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Mymodule\Test\Model\ResourceModel\Link\CollectionFactory $collectionFactory,
        \Mymodule\Test\Api\Links\LinkSearchResultInterfaceFactory $linkSearchResultFactory,
        \Magento\Framework\App\Action\Context $context
    ) {

        $this->resource                 = $resource;
        $this->linksFactory             = $linksFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $linkSearchResultFactory;
        $this->messageManager           = $context->getMessageManager();
    }


    public function getById($id){
        $link = $this->linksFactory->create();
        $this->resource->load($link, $id);

        if (!$link->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Link with id "%1" does not exist.', $id));
        }

        return $link;
    }


    public function deleteById($id){
        $this->delete($this->getById($id));
    }


    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria){
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }


    public function save(\Mymodule\Test\Api\Links\LinkInterface $link){
        try {
            $this->resource->save($link);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }

        return $link;
    }


    public function delete(\Mymodule\Test\Api\Links\LinkInterface $link)
    {
        try {
            $this->resource->delete($link);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }


}