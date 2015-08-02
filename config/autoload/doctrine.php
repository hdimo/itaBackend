<?php
/**
 * User: khaled
 * Date: 8/2/15 at 12:56 PM
 */

$params =  array(
    'host'     => 'localhost',
    'port'     => '3306',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'ita',
);

return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => $params['host'],
                    'port'     => $params['port'],
                    'user'     => $params['user'],
                    'password' => $params['password'],
                    'dbname'   => $params['dbname'],
                )
            )
        )
    ),
);
