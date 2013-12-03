<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:40
 */

namespace Event\Form;


use Zend\Form\Form;

class EventForm extends Form
{
    protected $statusOptions = array();

    /**
     * @return array
     */
    public function getStatusOptions()
    {
        return $this->statusOptions;
    }

    /**
     * @param array $statusOptions
     */
    public function setStatusOptions($statusOptions)
    {
        $this->statusOptions = $statusOptions;
    }

    public function init()
    {
        $this->add(
            array(
                'type' => 'Csrf',
                'name' => 'csrf',
            )
        );

        $this->add(
            array(
                'type'    => 'text',
                'name'    => 'name',
                'options' => array(
                    'label' => 'Name der Veranstaltung',
                ),
            )
        );

        $this->add(
            array(
                'type'    => 'textarea',
                'name'    => 'description',
                'options' => array(
                    'label' => 'Beschreibung',
                ),
            )
        );

        $this->add(
            array(
                'type'    => 'date',
                'name'    => 'date',
                'options' => array(
                    'label'  => 'Datum',
                    'format' => 'Y-m-d',
                ),
            )
        );

        $this->add(
            array(
                'type'    => 'time',
                'name'    => 'time',
                'options' => array(
                    'label'  => 'Zeit',
                    'format' => 'H:i',
                ),
            )
        );


        $this->add(
            array(
                'type'    => 'select',
                'name'    => 'status',
                'options' => array(
                    'label'         => 'Status',
                    'value_options' => $this->getStatusOptions(),
                ),
            )
        );


        $this->add(
            array(
                'type'       => 'submit',
                'name'       => 'save_event',
                'attributes' => array(
                    'value' => 'Speichern',
                    'id'    => 'save_event',
                ),
            )
        );
    }
}
