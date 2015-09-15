<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 14/03/15
 * Time: 17:20
 */

return array(

    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Application\Entity\User',
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => function(\Application\Entity\User $user, $passwordGiven) {
                    return $user->getPassword() === sha1($passwordGiven);
                },
            ),
        ),
    ),

    "router"=>array(
        "routes"=>array(
            "user"=>array(
                "type"=>"Segment",
                "options"=>array(
                    'route'=>'/user[/:controller[/:action]]',
                    "defaults"=>array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'=>'Login',
                        'action'=>'index'
                    ),
                ),
            ),

            "oauth"=>array(
                "type"=>"Segment",
                "options"=>array(
                    'route'=>'/oauth[/:type]',
                    "defaults"=>array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'=>'Oauth',
                        'action'=>'index'
                    ),
                ),
            ),
        ),
    ),

    "controllers"=>array(
        "invokables"=>array(
            'User\Controller\Login'=>'User\Controller\LoginController',
            'User\Controller\Register'=>'User\Controller\RegisterController',
            'User\Controller\Oauth'=>'User\Controller\OauthController',
            'User\Controller\Profile'=>'User\Controller\ProfileController',
            'User\Controller\UpdatePassword'=>'User\Controller\UpdatePasswordController',
        ),
    ),

    'service_manager'=>array(
        'abstract_factories'=>array(
            'User\Service\AbstractFactory\OauthAbstractFactory',
        ),
    ),

    "view_manager"=>array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    )

);