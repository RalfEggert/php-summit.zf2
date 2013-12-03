<?php

namespace Event\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{

    /**
     * @var EventForm
     */
    protected $eventForm = null;
    /**
     * @var EventService
     */
    protected $eventService = null;

    public function createAction()
    {
        $eventForm = $this->getEventForm();

        if ($this->getRequest()->isPost()) {
            $event = $this->getEventService()->save(
                $this->getRequest()->getPost()->toArray()
            );

            if ($event) {
                return $this->redirect()->toRoute('event-admin');
            }

            $eventForm->setData(
                $this->getEventService()->getFilter()->getValues()
            );

            $eventForm->setMessages(
                $this->getEventService()->getFilter()->getMessages()
            );
        }

        return new ViewModel(
            array(
                'eventForm' => $eventForm,
                'message'   => $this->getEventService()->getMessage()
            )
        );
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        $event = $this->getEventService()->fetchEventEntity($id);

        if (!$event) {
            $this->flashMessenger()->addErrorMessage('Unbekanntes Event');

            return $this->redirect()->toRoute('event-admin');
        }

        $this->getEventService()->delete($id);

        if ($this->getEventService()->getMessage()) {
            $this->flashMessenger()->addSuccessMessage(
                $this->getEventService()->getMessage()
            );
        }

        return $this->redirect()->toRoute('event-admin');
    }

    /**
     * @return \Event\Form\EventForm
     */
    public function getEventForm()
    {
        return $this->eventForm;
    }

    /**
     * @param \Event\Form\EventForm $eventForm
     */
    public function setEventForm($eventForm)
    {
        $this->eventForm = $eventForm;
    }

    /**
     * @return \Event\Service\EventService
     */
    public function getEventService()
    {
        return $this->eventService;
    }

    /**
     * @param \Event\Service\EventService $eventService
     */
    public function setEventService($eventService)
    {
        $this->eventService = $eventService;
    }

    public function indexAction()
    {
        return new ViewModel(
            array(
                'eventList' => $this->getEventService()->fetchEventList(),
            )
        );
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        $event = $this->getEventService()->fetchEventEntity($id);

        if (!$event) {
            $this->flashMessenger()->addErrorMessage('Unbekanntes Event');

            return $this->redirect()->toRoute('event-admin');
        }

        return new ViewModel(
            array(
                'event' => $event,
            )
        );
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute('id');

        $event = $this->getEventService()->fetchEventEntity($id);

        if (!$event) {
            $this->flashMessenger()->addErrorMessage('Unbekanntes Event');

            return $this->redirect()->toRoute('event-admin');
        }

        $eventForm = $this->getEventForm();

        if ($this->getRequest()->isPost()) {
            $event = $this->getEventService()->save(
                $this->getRequest()->getPost()->toArray(), $id
            );

            if ($event) {
                return $this->redirect()->toRoute(
                    'event-admin/action',
                    array('action' => 'update', 'id' => $event->getId())
                );
            }

            $eventForm->setData(
                $this->getEventService()->getFilter()->getValues()
            );

            $eventForm->setMessages(
                $this->getEventService()->getFilter()->getMessages()
            );
        } else {
            $eventForm->setData(
                $this->getEventService()->getHydrator()->extract($event)
            );
        }

        return new ViewModel(
            array(
                'event'     => $event,
                'eventForm' => $eventForm,
                'message'   => $this->getEventService()->getMessage()
            )
        );
    }


}

