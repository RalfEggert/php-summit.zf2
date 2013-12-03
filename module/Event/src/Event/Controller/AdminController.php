<?php

namespace Event\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    protected $eventList = array();

    function __construct()
    {
        $this->eventList = array(
            123 => array(
                'id' => '123',
                'name' => 'Fettes Brot Konzert',
                'description' => 'Konzert mit den Broten',
                'date' => new \DateTime('2013-12-06'),
                'time' => new \DateTime('20:00'),
                'status' => 1,
            ),
            456 => array(
                'id' => '456',
                'name' => 'Malen nach Zahlen',
                'description' => 'Für die ganze Familie',
                'date' => new \DateTime('2013-12-12'),
                'time' => new \DateTime('15:00'),
                'status' => 2,
            ),
        );
    }


    public function indexAction()
    {
        return new ViewModel(
            array(
                'eventList' => $this->eventList,
            )
        );
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!isset($this->eventList[$id])) {
            $this->flashMessenger()->addErrorMessage('Unbekanntes Event');

            return $this->redirect()->toRoute('event-admin');
        }

        return new ViewModel(
            array(
                'event' => $this->eventList[$id],
            )
        );
    }


}

