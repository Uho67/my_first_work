<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 31.07.19
 * Time: 15:01
 */

namespace Mymodule\Test\Block\Adminhtml\Page;


class Grid extends \Magento\Backend\Block\Widget\Grid\Extended

{

    protected $_coreRegistry = null;
    protected $_pageFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Cms\Model\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    )
    {

        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $backendHelper, $data);
    }


    protected function _construct()
    {
        parent::_construct();
        $this->setId('page_grid');
        $this->setDefaultSort('page_id');
        $this->setUseAjax(true);

    }


    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('page_id', ['in' => $productIds]);
            } else {
                if ($productIds) {
                    $this->getCollection()->addFieldToFilter('page_id', ['nin' => $productIds]);
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }




    protected function _prepareColumns()
    {
        //This is for radio button in grid
        $this->addColumn(
            'page_id',
            [
                'type' => 'checkbox',
                'html_name' => 'page_id',
                'required' => true,
                'values' => $this->_getSelectedProducts(),
                'align' => 'center',
                'index' => 'page_id',
                'header_css_class' => 'col-multyselect',
                'column_css_class' => 'col-multyselect'
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('title'),
                'index' => 'title',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name'
            ]
        );


        return parent::_prepareColumns();
    }

    protected function _prepareCollection()
    {

        $collection = $this->_pageFactory->create()->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }



    public function getGridUrl()
    {
        return $this->_getData(
            'grid_url'
        ) ? $this->_getData(
            'grid_url'
        ) : $this->getUrl(
            'mymodule_test/page/index',
            ['_current' => true]
        );
    }


    protected function _getSelectedProducts()
    {
        $products = array_keys($this->getSelectedProducts());
        return $products;
    }


    public function getSelectedProducts()
    {

        $proIds = [];
        $proIds[] = ['page_id' => 2];

        return $proIds;
    }
}