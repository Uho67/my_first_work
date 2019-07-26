<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:20
 */

namespace Mymodule\Test\Model\ResourceModel\Link;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Mymodule\Test\Model\Link::class, \Mymodule\Test\Model\ResourceModel\Link::class);
    }
}