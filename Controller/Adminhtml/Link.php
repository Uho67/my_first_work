<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:55
 */

namespace Mymodule\Test\Controller\Adminhtml;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

use Magento\Framework\App\ResourceConnection;


use Mymodule\Test\Api\Links\LinkInterface;
use Mymodule\Test\Api\LinkRepositoryInterface;
use Mymodule\Test\Model\LinkFactory;


abstract class Link extends Action
{
    const ACL_RESOURCE          = 'Mymodule_Test::all';
    const MENU_ITEM             = 'Mymodule_Test::all';
    const PAGE_TITLE            = 'Mymodule_Test_Link';
    const BREADCRUMB_TITLE      = 'Link';
    const QUERY_PARAM_ID        = 'id';


    protected $_resource;

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;


    protected $modelFactory;


    protected $model;

    /** @var Page */
    protected $resultPage;


    protected $repository;

    /** @var Logger */
    protected $logger;


    public function __construct(
        ResourceConnection $resource,
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        LinkRepositoryInterface $linkRepository,
        LinkFactory $factory,
        LoggerInterface $logger
    ){

        $this->_resource      = $resource;
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $linkRepository;
        $this->modelFactory   = $factory;
        $this->logger         = $logger;

        parent::__construct($context);
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();
        return $this->resultPage;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return Link
     */
    protected function _setPageData()
    {
        $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }

    /** @return LinkInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }

        return $this->model;
    }

    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/index');
    }
}