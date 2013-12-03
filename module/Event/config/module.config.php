<?php
return array(
    'router'          => array(
        'routes' => array(
            'event-admin' => array(
                'type'          => 'literal',
                'options'       => array(
                    'route'    => '/event/admin',
                    'defaults' => array(
                        'controller' => 'event-admin',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'action' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => '/:action[/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9-_]*',
                                'id'     => '[0-9]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers'     => array(
        'invokables' => array(
            'event-admin' => 'Event\Controller\AdminController',
        ),
    ),
    'view_manager'    => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'Event\Entity\Event' => 'Event\Entity\EventEntity',
        ),
        'factories'  => array(
            'Event\Table\Event'   => 'Event\Table\EventTableFactory',
            'Event\Service\Event' => 'Event\Service\EventServiceFactory',
            'Event\Config'        => 'Event\Config\EventConfigFactory',
        ),
        'shared'     => array(
            'Event\Entity\Event' => false,
        ),
    ),
    'hydrators'       => array(
        'invokables' => array(
            'Event\Hydrator' => 'Event\Hydrator\EventHydrator',
        ),
    ),
    'view_helpers'       => array(
        'factories' => array(
            'EventStatus' => 'Event\View\Helper\EventStatusFactory',
        ),
    ),
    'input_filters'       => array(
        'factories' => array(
            'Event\Filter' => 'Event\InputFilter\EventFilterFactory',
        ),
    ),
    'navigation'      => array(
        'default' => array(
            array(
                'label' => 'Events',
                'route' => 'event-admin',
                'pages' => array(
                    array(
                        'label'   => 'Event anzeigen',
                        'route'   => 'event-admin/action',
                        'action'  => 'show',
                        'visible' => false,
                    ),
                ),
            ),
        ),
    ),
);