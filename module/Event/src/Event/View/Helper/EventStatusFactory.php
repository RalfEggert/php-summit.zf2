<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:04
 */

namespace Event\View\Helper;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EventStatusFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $viewHelperManager
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $viewHelperManager)
    {
        $serviceLocator = $viewHelperManager->getServiceLocator();

        $config = $serviceLocator->get('Event\Config');

        $helper = new EventStatus();
        $helper->setStatusOptions($config['options']['event_status']);

        return $helper;
    }
}