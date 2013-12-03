<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:11
 */

namespace Event\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdminControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $controllerLoader
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $controllerLoader)
    {
        $serviceLocator = $controllerLoader->getServiceLocator();
        $formElementManager = $serviceLocator->get('FormElementManager');

        $service = $serviceLocator->get('Event\Service\Event');
        $form = $formElementManager->get('Event\Form');

        $controller = new AdminController();
        $controller->setEventService($service);
        $controller->setEventForm($form);

        return $controller;
    }

} 