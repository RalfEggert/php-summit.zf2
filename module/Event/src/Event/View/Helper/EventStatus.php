<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:02
 */

namespace Event\View\Helper;


use Zend\Form\View\Helper\AbstractHelper;

class EventStatus extends AbstractHelper
{
    protected $statusOptions = array();

    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions)
    {
        $this->statusOptions = $statusOptions;
    }

    /**
     * @return array
     */
    public function getStatusOptions()
    {
        return $this->statusOptions;
    }

    function __invoke($statusId)
    {
        if (isset($this->statusOptions[$statusId])) {
            return $this->statusOptions[$statusId];
        }

        return 'Status unbekannt';
    }
} 