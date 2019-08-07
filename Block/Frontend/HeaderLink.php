<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 26.07.19
 * Time: 9:11
 */

namespace Mymodule\Test\Block\Frontend;

use Magento\Framework\View\Element\Template;

use Mymodule\Test\Api\Bunch\BunchInterface;
use Mymodule\Test\Model\ResourceModel\Link\CollectionFactory as LinkFactory;

class HeaderLink extends Template
{


    protected $linkCollectionFactory;



    public function __construct(

        LinkFactory $linkCollectionFactory ,
        Template\Context $context,
        array $data = [])
    {
        $this->linkCollectionFactory  = $linkCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getLinks()
    {

        $pageId= $this->getLayout()->getBlock("cms_page")->getPage()->getId();
        $bunchTable = BunchInterface::TABLE_NAME;

        $linkCollection = $this->linkCollectionFactory->create()
            ->join([$bunchTable],"main_table.link_id =$bunchTable.link_id",'page_id')
            ->addFieldToFilter('page_id', $pageId)
            ->addFieldToFilter('status',1);

        return $linkCollection;
    }

}