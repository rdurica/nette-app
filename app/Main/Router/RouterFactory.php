<?php declare(strict_types=1);

namespace App\Main\Router;

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
    private RouteList $router;

    public function __construct()
    {
        $this->router = new RouteList();
    }

    public function create(): RouteList
    {
        $this->addMainModule();

        return $this->router;
    }

    protected function addMainModule(): void
    {
        $this->router[] = $list = new RouteList('Main');
        $list->addRoute('<presenter>/<action>[/<id>]', 'Home:default');
    }
}
