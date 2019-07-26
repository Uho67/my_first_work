<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 13:25
 */

namespace Mymodule\Test\Api\Bunch;
use Magento\Cms\Api\Data\PageInterface;

use Mymodule\Test\Api\Links\LinkInterface;

interface BunchInterface
{
    const TABLE_NAME                = 'my_link_page_table';
    const ID_FIELD                  = 'bunch_id';
    const LINK_ID_FILD              =  LinkInterface::ID_FIELD;
    const PAGE_ID_FILD              =  PageInterface::PAGE_ID;

    const CACHE_TAG                 = 'my_link_page_table';
    const REGISTRY_KEY              = 'my_link_page_table';

    public function getId();

    public function getLinkId();
    public function setLinkId($id);
    public function getPageId();
    public function setPageId($id);

}