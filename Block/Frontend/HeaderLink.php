<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 26.07.19
 * Time: 9:11
 */

namespace Mymodule\Test\Block\Frontend;

use Magento\Framework\View\Element\Template;
use Magento\Cms\Api\PageRepositoryInterface as PageRepository ;
use Magento\Framework\App\Action\Context;

use Mymodule\Test\Model\ResourceModel\Link\CollectionFactory as LinkFactory;
use Mymodule\Test\Model\ResourceModel\Bunch\CollectionFactory as BunchFactory;



class HeaderLink extends Template
{
    protected $_objectManager;

    protected $linkCollectionFactory;
    protected $bunchCollectionFactory;
    protected $pageFactory;
    public $pageRepository;
    public $page;

    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory,
        Context $actionContext,
        LinkFactory $linkCollectionFactory ,
        BunchFactory $bunchCollectionFactory,
        Template\Context $context,
        PageRepository  $pageRepository,
        array $data = [])
    {
        $this->pageFactory            = $pageFactory;
        $this->_objectManager         = $actionContext->getObjectManager();
        $this->linkCollectionFactory  = $linkCollectionFactory;
        $this->bunchCollectionFactory = $bunchCollectionFactory;
        $this->pageRepository = $pageRepository;
        parent::__construct($context, $data);
    }

    public function getLinks()
    {


        $cmsPage = \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Cms\Model\Page::class);
        $pageId = $cmsPage->getId();


        if(!$pageId){
            return [] ;
        }
        $bunchCollection = $this->bunchCollectionFactory->create()->addFieldToFilter('page_id', $pageId);



        $linkId = array();
        foreach($bunchCollection as $item) {
            $linkId[] = $item->getLinkId();
        }


        $linkCollection = $this->linkCollectionFactory->create()
            ->addFieldToFilter('link_id',$linkId)->addFieldToFilter('status',1);



        $response = array();
        foreach ($linkCollection as $item){
            $response[] = [$item->getBody(),$item->getText()];
        }
        return $response;
    }

}