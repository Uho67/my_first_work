<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:22
 */

namespace Mymodule\Test\Model\ResourceModel\Link\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Magento\Framework\Api\SearchCriteriaInterface;

use Mymodule\Test\Model\ResourceModel\Link\Collection as LinkCollection;
use Mymodule\Test\Model\ResourceModel\Link as LinkResource;

class Collection extends LinkCollection implements SearchResultInterface
{


    /** @var AggregationInterface */
    protected $aggregations;

    /** @var SearchCriteriaInterface */
    protected $searchCriteria;


    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(Document::class, LinkResource::class);
    }

    /** {@inheritdoc} */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /** {@inheritdoc} */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /** {@inheritdoc} */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /** {@inheritdoc} */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;

        return $this;
    }

    /** {@inheritdoc} */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /** {@inheritdoc} */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /** {@inheritdoc} */
    public function setItems(array $items = null)
    {
        return $this;
    }



}