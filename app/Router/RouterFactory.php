<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;

/**
 * RouterFactory.
 *
 * @package   App\Router
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-15
 */
final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList();
        $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');
        return $router;
    }
}
