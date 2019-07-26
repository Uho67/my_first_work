<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 14:18
 */

namespace Mymodule\Test\Model\ResourceModel\Bunch;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Mymodule\Test\Model\Bunch::class, \Mymodule\Test\Model\ResourceModel\Bunch::class);
    }
}