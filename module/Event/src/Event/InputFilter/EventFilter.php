<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 11:10
 */

namespace Event\InputFilter;


use Zend\InputFilter\InputFilter;

class EventFilter extends InputFilter
{
    protected $statusHaystack = array();

    /**
     * @return array
     */
    public function getStatusHaystack()
    {
        return $this->statusHaystack;
    }

    /**
     * @param array $statusHaystack
     */
    public function setStatusHaystack($statusHaystack)
    {
        $this->statusHaystack = $statusHaystack;
    }

    public function init()
    {
        $this->add(
            array(
                'name'       => 'name',
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => '3',
                            'max' => '64',
                            'message' => 'Name muss zwischen %min% und %max% Zeichen lang sein!'
                        ),
                    ),
                ),
            ),
        );
        $this->add(
            array(
                'name'       => 'description',
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
        );
        $this->add(
            array(
                'name'       => 'date',
                'required'   => true,
                'validators' => array(
                    array(
                        'name'    => 'Date',
                        'options' => array(
                            'format' => 'Y-m-d',
                            'message' => 'Datum entspricht nicht Format "%format%"!'
                        ),
                    ),
                ),
            ),
        );
        $this->add(
            array(
                'name'       => 'time',
                'required'   => true,
                'validators' => array(
                    array(
                        'name'    => 'Date',
                        'options' => array(
                            'format' => 'H:i',
                            'message' => 'Zeit entspricht nicht Format "%format%"!'
                        ),
                    ),
                ),
            ),
        );
        $this->add(
            array(
                'name'       => 'status',
                'required'   => true,
                'validators' => array(
                    array(
                        'name'    => 'InArray',
                        'options' => array(
                            'haystack' => $this->getStatusHaystack(),
                            'message' => 'Ungültiger Status!'
                        ),
                    ),
                ),
            ),
        );
    }


} 