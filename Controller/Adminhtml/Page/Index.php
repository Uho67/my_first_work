<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30.07.19
 * Time: 11:08
 */

namespace Mymodule\Test\Controller\Adminhtml\Page;


class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Page')));

        return $resultPage;
    }


}