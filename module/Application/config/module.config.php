<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\PessoasController;
use Application\Controller\PetsController;
use Application\Service\PessoaService;
use Application\Service\PetService;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'pessoas' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pessoas[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\PessoasController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'pets' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pets[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\PetsController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\PessoasController::class => function ($serviceManager) {
                $service = $serviceManager->get('PessoaService');

                return new PessoasController($service);
            },
            Controller\PetsController::class => function ($serviceManager) {
                $servicePet = $serviceManager->get('PetService');
                $servicePessoa = $serviceManager->get('PessoaService');

                return new PetsController($servicePet, $servicePessoa);
            }
        ],
    ],
    'service_manager' => [
      'factories' => [
          'PessoaService' => function ($serviceManager) {
            $db = $serviceManager->get('Doctrine\ORM\EntityManager');

            return new PessoaService($db);
          },
          'PetService' => function ($serviceManager) {
            $db = $serviceManager->get('Doctrine\ORM\EntityManager');

            return new PetService($db);
          }
      ]
    ],
    'doctrine' => [
        'driver' => [
            'exemplo_entities' => [
                'class'
                => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'exemplo_entities'
                ]
            ]
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ]
    ],
];
