<?php


namespace Mymodule\Test\Model;

use Magento\Framework\DB\TransactionFactory;


class BunchRepository  implements \Mymodule\Test\Api\BunchRepositoryInterface
{

    protected $transactionFactory;
    /** @var \Mymodule\Test\Model\ResourceModel\Bunch */
    protected $resource;

    /** @var \Mymodule\Test\Model\BunchFactory  */
    protected $bunchFactory;

    /** @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var \Mymodule\Test\Model\ResourceModel\Bunch\CollectionFactory */
    protected $collectionFactory;

    /** @var \Mymodule\Test\Api\Bunch\BunchSearchResultInterfaceFactory */
    protected $searchResultsFactory;

    protected $scopeConfig;

    protected $messageManager;

    public function __construct(
        TransactionFactory $transactionFactory ,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Mymodule\Test\Model\ResourceModel\Bunch $resource,
        \Mymodule\Test\Model\BunchFactory $bunchFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Mymodule\Test\Model\ResourceModel\Bunch\CollectionFactory $collectionFactory,
        \Mymodule\Test\Api\Bunch\BunchSearchResultInterfaceFactory $statusSearchResultFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->transactionFactory       = $transactionFactory;
        $this->scopeConfig              = $scopeConfig;
        $this->resource                 = $resource;
        $this->bunchFactory             = $bunchFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $statusSearchResultFactory;
        $this->messageManager           = $context->getMessageManager();
    }


    public function getById($id){
        $link = $this->bunchFactory->create();
        $this->resource->load($link, $id);

        if (!$link->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Bunch with id "%1" does not exist.', $id));
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


    public function save(\Mymodule\Test\Api\Bunch\BunchInterface $bunch){
        try {
            $this->resource->save($bunch);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage()));
        }

        return $bunch;
    }


    public function delete(\Mymodule\Test\Api\Bunch\BunchInterface $bunch)
    {
        try {
            $this->resource->delete($bunch);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;
    }

    public function massSave($linkId,array $pages)
    {
        $transactionalModel = $this->transactionFactory->create();

        foreach ($pages as $page){
            $bunch = $this->bunchFactory->create();
            $bunch->setPageId($page);
            $bunch->setLinkId($linkId);
            $transactionalModel->addObject($bunch);
        }

        try {
            $transactionalModel->save();
        }  catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }

    }
    public function deleteByLinkId($id){
//        ???

    }


}