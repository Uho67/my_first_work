<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30.07.19
 * Time: 10:25
 */

namespace Mymodule\Test\Block\Adminhtml;


class Page extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_page';
        $this->_blockGroup = 'Mymodule_Test';
        $this->_headerText = __('Page');
        parent::_construct();
    }

}
