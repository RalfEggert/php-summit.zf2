<?php
/**
 * Zend Framework 2 - ZF2 PHP Summit
 *
 * Gepimpte SkeletonApplication für das Zend Framework 2,
 *
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * Global configuration
 *
 * @package    Application
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Sqlite' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'db' => array(
        'driver' => 'Pdo_Sqlite',
        'database' => __DIR__ . '/../../data/db/events.db'
    ),
);