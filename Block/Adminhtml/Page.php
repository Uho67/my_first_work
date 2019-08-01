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

//    protected function _prepareLayout(){
//        if(!$this->getRequest()->getParam('noser')){
//            $serialzeAr = array('data'=>array('grid_block'=>$this,'callback'=>'getSelectedProducts',
//                'input_element_name'=>'selected_products','reload_param_name'=>'selected_products'));
//            $serializer = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Grid\Serializer','serializer',$serialzeAr);
//            $this->getParentBlock()->insert($serializer,$this->getNameInLayout());
//        }
//        return parent::_prepareLayout();
//    }

    protected function _prepareLayout()
    {

        $this->addTab(
            'productgrid',
            [
                'label' => __('Select Product'),
                'url' => $this->getUrl('modulename/*/actionname', ['_current' => true]),
                'class' => 'ajax',

            ]
        );
    }



}
