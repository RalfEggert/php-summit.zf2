<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:11
 */

namespace Event\InputFilter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EventFilterFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $inputFilterManager
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $inputFilterManager)
    {
        $serviceLocator = $inputFilterManager->getServiceLocator();

        $config = $serviceLocator->get('Event\Config');

        $filter = new EventFilter();
        $filter->setStatusHaystack(
            array_keys($config['options']['event_status'])
        );

        return $filter;
    }

} 