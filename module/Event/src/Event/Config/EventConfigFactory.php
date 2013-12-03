<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:00
 */

namespace Event\Config;

use Zend\Config\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EventConfigFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = Factory::fromFile(
            APPLICATION_ROOT . '/module/Event/config/event.config.php'
        );

        return $config;
    }


} 