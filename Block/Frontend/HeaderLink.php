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


use Mymodule\Test\Model\ResourceModel\Link\CollectionFactory;



class HeaderLink extends Template
{
    protected $collectionFactory;
    public $pageRepository;

    public function __construct(
        CollectionFactory $collectionFactory ,
        Template\Context $context,
        PageRepository  $pageRepository,
        array $data = [])
    {
        $this->pageRepository = $pageRepository;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getLinks()
    {
        $url = $this->getRequest()->getParams();
        $page = $this->pageRepository->getById($url['id']);
        $currentPageIdentifire = $page->getIdentifier();

        $collection = $this->collectionFactory->create();
        $collection = $collection->getData();
        $response = array();
        foreach ($collection as $item){
            $response[] = [$item['body'],$item['link_text']];
        }
        return $response;
    }

}