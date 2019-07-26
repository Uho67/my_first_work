<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 25.07.19
 * Time: 13:19
 */

namespace Mymodule\Test\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

use Mymodule\Test\Api\Bunch\BunchInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')){
            $this->createBunchSchema($setup,$context);
        }
    }
    public function createBunchSchema(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable( BunchInterface::TABLE_NAME)
        )->addColumn(
            BunchInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Bunch ID'
        )->addColumn(
            BunchInterface::LINK_ID_FILD,
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'Link Id'
        )->addColumn(
            BunchInterface::PAGE_ID_FILD,
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'Page id'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable(BunchInterface::TABLE_NAME),
                [BunchInterface::LINK_ID_FILD],
                AdapterInterface::INDEX_TYPE_INDEX
            ),
            [BunchInterface::LINK_ID_FILD, BunchInterface::PAGE_ID_FILD],
            ['type' => AdapterInterface::INDEX_TYPE_INDEX]
        )->setComment(
            'Link table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }

}