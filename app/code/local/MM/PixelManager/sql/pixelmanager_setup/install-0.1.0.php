<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */


$installer = $this;
$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `{$this->getTable('mm_pixelmanager/pixel')}`;
CREATE TABLE `{$this->getTable('mm_pixelmanager/pixel')}` (
    `entity_id`       int(11)      NOT NULL AUTO_INCREMENT,
    `user_id`         int(11)      NOT NULL,
    `name`            varchar(255) NULL,
    `action`          varchar(255) NULL,
    `place`           varchar(255) NULL,
    `description`     text         NOT NULL,
    `is_active`       int(1)       NOT NULL DEFAULT '0',
    `store_id`        int(1)       NOT NULL DEFAULT '0',
    `pixel`           text         NOT NULL,
    `created_at`      datetime     NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at`      datetime     NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
