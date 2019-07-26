<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:19
 */

namespace Mymodule\Test\Model\ResourceModel;


class Link extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Mymodule\Test\Api\Links\LinkInterface::TABLE_NAME, \Mymodule\Test\Api\Links\LinkInterface::ID_FIELD);
    }
}