<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 14:16
 */

namespace Mymodule\Test\Model\ResourceModel;


class Bunch extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Mymodule\Test\Api\Bunch\BunchInterface::TABLE_NAME, \Mymodule\Test\Api\Bunch\BunchInterface::ID_FIELD);
    }
}