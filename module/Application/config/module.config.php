<?php
/**
 * Zend Framework 2 - ZF2 PHP Summit
 *
 * Gepimpte SkeletonApplication für das Zend Framework 2,
 *
 * @package    Application
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * Application module configuration
 *
 * @package    Application
 */
return array(
    'router'          => array(
        'routes' => array(
            'home'    => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'controllers'     => array(
        'invokables' => array(
            'index' => 'Application\Controller\IndexController',
        ),
    ),

    'view_manager'    => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => include __DIR__ . '/../view/template_map.php',
        'template_path_stack'      => array(
            __DIR__ . '/../view',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'SessionConfig' => 'Zend\Session\Service\SessionConfigFactory',
            'mainmenu' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),

    'session_config' => array(
        'name' => 'ZFPHPSUMMIT',
    ),

    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
        ),
    ),
);
