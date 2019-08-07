<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 10:49
 */

namespace Mymodule\Test\Controller\Adminhtml\Link;
use Mymodule\Test\Controller\Adminhtml\Link as BaseLink;


class Create extends BaseLink
{
    const ACL_RESOURCE          = 'Mymodule_Test::create';
    const MENU_ITEM             = 'Mymodule_Test::create';
    const PAGE_TITLE        = 'Add link';
    const BREADCRUMB_TITLE  = 'Add link';

}