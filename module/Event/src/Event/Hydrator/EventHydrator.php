<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 09:58
 */

namespace Event\Hydrator;


use Zend\Stdlib\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;
use Zend\Stdlib\Hydrator\Filter\FilterProviderInterface;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;

/**
 * Class EventHydrator
 *
 * @package Event\Hydrator
 */
class EventHydrator extends ClassMethods
{
    public function extract($object)
    {
        $data = parent::extract($object);

        if (isset($data['date']) && $data['date'] instanceof \DateTime) {
            $data['date'] = $data['date']->format('Y-m-d');
        }

        if (isset($data['time']) && $data['time'] instanceof \DateTime) {
            $data['time'] = $data['time']->format('H:i');
        }

        return $data;
    }

    public function hydrate(array $data, $object)
    {
        if (isset($data['date'])) {
            $data['date'] = new \DateTime($data['date']);
        }

        if (isset($data['time'])) {
            $data['time'] = new \DateTime($data['time']);
        }

        return parent::hydrate(
            $data, $object
        );
    }

} 