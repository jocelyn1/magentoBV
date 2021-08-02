<?php

namespace Jkelle\CmsBlockNotification\Setup;

use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationInterface;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Jkelle\CmsBlockNotification\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @inheritDoc
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        /**
         * Create table 'cms_block_notification'
         */

        if(!$setup->tableExists(CmsBlockNotification::TABLE_NAME)) {
            $table = $setup->getConnection()
                ->newTable($setup->getTable(CmsBlockNotification::TABLE_NAME))
                ->addColumn(
                    CmsBlockNotificationInterface::ENTITY_ID,
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ],
                    CmsBlockNotificationInterface::ENTITY_ID
                )->addColumn(
                    CmsBlockNotificationInterface::BLOCK_ID,
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    CmsBlockNotificationInterface::BLOCK_ID
                )->addColumn(
                    CmsBlockNotificationInterface::BEGIN_AT,
                    Table::TYPE_DATETIME,
                    null,
                    [],
                    CmsBlockNotificationInterface::BEGIN_AT
                )->addColumn(
                    CmsBlockNotificationInterface::END_AT,
                    Table::TYPE_DATETIME,
                    null,
                    [],
                    CmsBlockNotificationInterface::END_AT
                );
//                )->addForeignKey(
//                   $setup->getFkName(
//                       CmsBlockNotification::TABLE_NAME,
//                       CmsBlockNotificationInterface::BLOCK_ID,
//                       'cms_block',
//                       'block_id'
//                   ),
//                   CmsBlockNotificationInterface::BLOCK_ID,
//                    $setup->getTable('cms_block'),
//                    'block_id',
//                    Table::ACTION_CASCADE
//                );

            $setup->getConnection()->createTable($table);
        }
    }
}
