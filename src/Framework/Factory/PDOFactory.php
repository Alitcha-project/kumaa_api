<?php

namespace Kumaa\Framework\Factory;

use PDO;
use Psr\Container\ContainerInterface;

class PDOFactory
{
    /**
     * __invoke
     *
     * @param  mixed $container
     * @return PDO
     */
    public function __invoke(ContainerInterface $container): PDO
    {
        $db_name = $container->get('config_db')['db_name'];
        $host = $container->get('config_db')['host'];
        $username = $container->get('config_db')['username'];
        $password = $container->get('config_db')['password'];
        return new \PDO(
            'mysql:dbname='. $db_name .';host='. $host,
            $username,
            $password,
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}
