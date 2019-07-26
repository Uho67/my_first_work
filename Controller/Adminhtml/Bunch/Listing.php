<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 14:55
 */

namespace Mymodule\Test\Controller\Adminhtml\Bunch;

use Mymodule\Test\Controller\Adminhtml\Bunch as BaseBunch;

class Listing extends BaseBunch
{
    const ACL_RESOURCE      = 'Mymodule_Test::bunch';
    const MENU_ITEM         = 'Mymodule_Test::bunch';
    const PAGE_TITLE        = 'Bunch Grid';
    const BREADCRUMB_TITLE  = 'Bunch Grid';
}