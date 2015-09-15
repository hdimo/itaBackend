<?php

/**
 * User: khaled
 * Date: 7/16/15 at 11:34 AM
 */

namespace Common\Service;

use Common\Listeners\Authorization;

class RoleResourcePermissionFromArray implements RoleResourcePermissionInterface {

    public function getListRoleResourcePermission() {
        return [
            Authorization::DEFAULT_ROLE =>
            [
                'allow' => [
                    ['resource' => 'Application\Controller\Index', 'permission' => ['index', 'about']],
                    ['resource' => 'Hotel\Controller\Index', 'permission' => ['index']],
                    ['resource' => 'Hotel\Controller\List', 'permission' => ['index']],
                    ['resource' => 'Hotel\Controller\HotelDetail', 'permission' => ['index']],
                    ['resource' => 'Contact\Controller\Index', 'permission' => ['index', 'process']],
                    ['resource' => 'User\Controller\Login', 'permission' => ['index', 'process']],
                    ['resource' => 'User\Controller\Register', 'permission' => ['index', 'process', 'success']],
                ],
                'deny' => []
            ],
            Authorization::USER_ROLE =>
            [
                'allow' => [
                    ['resource' => 'Board\Controller\Index', 'permission' => ['index']],
                    ['resource' => 'User\Controller\Login', 'permission' =>  ['logout']],
                    ['resource' => 'User\Controller\Profile', 'permission' => ['index']],
                    ['resource' => 'Booking\Controller\List', 'permission' => ['index']],
                    ['resource' => 'Booking\Controller\Create', 'permission' => ['index']],

                    ['resource' => 'User\Controller\UpdatePassword', 'permission' => ['index', 'process']],
                ],
                'deny' => [
                    ['resource' => 'User\Controller\Login', 'permission' => ['index']],
                    ['resource' => 'User\Controller\Register', 'permission' => ['index']],
                ],
            ],
        ];
    }

}
