<?php

namespace Jkelle\CmsBlockNotification\Setup;

use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * Class UpgradeSchema
 * @package Jkelle\CmsBlockNotification\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @inheritDoc
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addTitleField($setup);
        }
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addTitleField(SchemaSetupInterface $setup)
    {
       $setup->getConnection()->dropColumn($setup->getTable(CmsBlockNotification::TABLE_NAME), 'title');
       $setup->getConnection()->addColumn(
           $setup->getTable(CmsBlockNotification::TABLE_NAME),
           'title',
           Table::TYPE_TEXT,
           null,
           ['nullable' => true],
           'title'
       );

        $setup->getConnection()->dropColumn($setup->getTable(CmsBlockNotification::TABLE_NAME), 'toto');
        $setup->getConnection()->addColumn(
            $setup->getTable(CmsBlockNotification::TABLE_NAME),
            'toto',
            Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'toto'
        );

       // pour le <filterSearch name="fulltext"/> fonctionne avec les filters aussi activé
       $setup->getConnection()->addIndex(
           $setup->getTable(CmsBlockNotification::TABLE_NAME),
           'index_title_toto',
           [
               'title', 'toto'
           ],
           AdapterInterface::INDEX_TYPE_FULLTEXT
       );
    }
}
