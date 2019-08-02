<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30.07.19
 * Time: 14:58
 */

namespace Mymodule\Test\Block\Adminhtml\link\Edit\Tab;


use Mymodule\Test\Block\Adminhtml\Link\Edit\Tab\AbstractTab;
use Magento\Config\Model\Config\Source\Yesno;

use Mymodule\Test\Api\Links\LinkInterface;

class General extends AbstractTab
{

    const TAB_LABEL     = 'General';
    const TAB_TITLE     = 'General';
    /** {@inheritdoc} */
    protected function _prepareForm()
    {
        $yesno = $this->yesNoFactory->create()->toOptionArray();
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('link');
        $form->setFieldNameSuffix('link');
        $fieldSet = $form->addFieldset(
            'general_fieldset',
            ['legend' => __('General')]
        );
        if ($this->model->getData(LinkInterface::ID_FIELD)) {
            $fieldSet->addField(
                LinkInterface::ID_FIELD,
                'hidden',
                ['name' => LinkInterface::ID_FIELD]
            );
        }
        $fieldSet->addField(
            LinkInterface::TEXT_FIELD,
            'text',
            [
                'name'      => LinkInterface::TEXT_FIELD,
                'label'     => __('Text'),
                'required'  => true
            ]
        );
        $fieldSet->addField(
            LinkInterface::BODY_FIELD,
            'text',
            [
                'name'      => LinkInterface::BODY_FIELD,
                'label'     => __('Body'),
                'required'  => true
            ]
        );
        $fieldSet->addField(
            LinkInterface::STATUS_FIELD,
            'select',
            [
                'name'      => LinkInterface::STATUS_FIELD,
                'label'     => __('Status'),
                'required'  => true,
                'values' => $yesno
            ]
        );
        $fieldSet->addField(
            'pages',
            'hidden',
            [
                'name'      => 'pages',
                'label'     => __('Pages'),
                'required'  => true
            ]
        );

        $data = $this->model->getData();
        $data['pages'] = '1,2,3';
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}