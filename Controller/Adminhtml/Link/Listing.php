<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 1:08
 */

namespace Mymodule\Test\Controller\Adminhtml\Link;

use Mymodule\Test\Controller\Adminhtml\Link;

class Listing extends Link
{
    const ACL_RESOURCE      = 'Mymodule_Test::links';
    const MENU_ITEM         = 'Mymodule_Test::links';
    const PAGE_TITLE        = 'Link Grid';
    const BREADCRUMB_TITLE  = 'Link Grid';
}