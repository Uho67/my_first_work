<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 30.07.19
 * Time: 14:59
 */

namespace Mymodule\Test\Block\Adminhtml\Link\Edit\Tab;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Config\Model\Config\Source\Enabledisable;
use Magento\Config\Model\Config\Source\YesnoFactory;


use Mymodule\Test\Api\Links\LinkInterface;

abstract class AbstractTab extends Generic implements TabInterface
{

    protected $yesNoFactory;

    const TAB_LABEL     = 'Link info';
    const TAB_TITLE     = 'Link Info';
    const CAN_SHOW_TAB  = true;
    const IS_HIDDEN     = false;
    /** @var Config */
    protected $wysiwygConfig;
    /** @var LinkInterface */
    protected $model;
    /** @var  Enabledisable */
    protected $sourceModel;
    /**
     * @param YesnoFactory  $yesnoFactory
     * @param Context       $context
     * @param Registry      $registry
     * @param FormFactory   $formFactory
     * @param Config        $wysiwygConfig
     * @param Enabledisable $enableDisable
     * @param array         $data
     */
    public function __construct(
        YesnoFactory $yesNoFactory,
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Enabledisable $enableDisable,
        array $data = []
    ) {
        $this->yesNoFactory  = $yesNoFactory;
        $this->wysiwygConfig = $wysiwygConfig;
        $this->model         = $registry->registry(LinkInterface::REGISTRY_KEY);
        $this->sourceModel   = $enableDisable;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __(static::TAB_LABEL);
    }
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __(static::TAB_TITLE);
    }
    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return static::CAN_SHOW_TAB;
    }
    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return static::IS_HIDDEN;
    }
}