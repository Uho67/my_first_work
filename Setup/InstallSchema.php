<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 25.07.19
 * Time: 0:27
 */

namespace Mymodule\Test\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

use Mymodule\Test\Api\Links\LinkInterface;

class InstallSchema implements InstallSchemaInterface
{


    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->createTableLinks($setup,$context);
    }


    public function createTableLinks(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable( LinkInterface::TABLE_NAME)
        )->addColumn(
            LinkInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Link ID'
        )->addColumn(
            LinkInterface::TEXT_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Link text'
        )->addColumn(
            LinkInterface::BODY_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Link Body'
        )->addColumn(
            LinkInterface::STATUS_FIELD,
            Table::TYPE_BOOLEAN,
            255,
            ['nullable' => false],
            'Link Staus'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable(LinkInterface::TABLE_NAME),
                [LinkInterface::TEXT_FIELD],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            [LinkInterface::TEXT_FIELD, LinkInterface::BODY_FIELD],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Link table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}