<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30.07.19
 * Time: 14:56
 */

namespace Mymodule\Test\Block\Adminhtml\Link\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
use Mymodule\Test\Block\Adminhtml\Link\Edit\Tab\General as GeneralTab;


class Tabs extends WidgetTabs
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('mymodule_test_link_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Link information'));
    }
    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    GeneralTab::class
                )->toHtml(),
                'active' => true
            ]
        );
        $this->addTab('form_section1', array(
            'label'     => __('Page'),
            'title'     => __('Page'),
            'url'       => $this->getUrl('*/page/index', array('_current' => true)),
            'class'     => 'ajax',
        ));
        return parent::_beforeToHtml();
    }
}