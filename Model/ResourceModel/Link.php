<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:19
 */

namespace Mymodule\Test\Model\ResourceModel;
use Mymodule\Test\Api\Bunch\BunchInterface;


class Link extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(\Mymodule\Test\Api\Links\LinkInterface::TABLE_NAME, \Mymodule\Test\Api\Links\LinkInterface::ID_FIELD);
    }
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {

        $tableName  = BunchInterface::TABLE_NAME;
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->getTable($tableName)
        )->where(
            'link_id = ?',
            $object->getId()
        )->reset(\Zend_Db_Select::COLUMNS)
            ->columns(['page_id']);

        $result = $connection->fetchCol($select);
      if($result) {
          $object->setPages(implode(',', $result));
      }
        return parent::_afterLoad($object);
    }
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if($object->getPages()) {

            $tableName = $this->getTable(BunchInterface::TABLE_NAME);
            $connection = $this->getConnection();
            $where = $connection->quoteInto('link_id = ?', $object->getId());
            $connection->delete($tableName, $where);

            $pages = explode(',',trim($object->getPages(),','));
            $data = array();
            foreach ($pages as $page){
                $data[] = ['page_id' => $page ,'link_id' => $object->getId()];
            }
            $this->getConnection()->insertMultiple($tableName,$data);

        }
        return parent::_afterSave($object); // TODO: Change the autogenerated stub
    }


    protected function _afterDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        $tableName = $this->getTable(BunchInterface::TABLE_NAME);
        $connection = $this->getConnection();
        $where = $connection->quoteInto('link_id = ?', $object->getId());
        $connection->delete($tableName, $where);
        return parent::_beforeDelete($object); // TODO: Change the autogenerated stub
    }


}