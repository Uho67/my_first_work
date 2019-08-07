<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 1:08
 */

namespace Mymodule\Test\Controller\Adminhtml\Link;

use Mymodule\Test\Controller\Adminhtml\Link;

class Index extends Link
{
    const ACL_RESOURCE      = 'Mymodule_Test::all';
    const MENU_ITEM         = 'Mymodule_Test::all';
    const PAGE_TITLE        = 'Link Grid';
    const BREADCRUMB_TITLE  = 'Link Grid';
}