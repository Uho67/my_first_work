<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30.07.19
 * Time: 14:53
 */

namespace Mymodule\Test\Block\Adminhtml\Link\Edit;
use Magento\Backend\Block\Widget\Form\Generic;


class Form extends Generic
{
    /** {@inheritdoc} */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id'    => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}