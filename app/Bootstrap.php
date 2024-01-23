<?php declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

use function dirname;

/**
 * Bootstrap.
 *
 * @package   app
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-15
 */
class Bootstrap
{
    public static function boot(): Configurator
    {
        $appDir = dirname(__DIR__);
        $environment = getenv()['ENV'];

        $configurator = new Configurator();
        $configurator->setDebugMode($environment === 'dev');
        $configurator->enableTracy($appDir . '/log');
        $configurator->setTempDirectory($appDir . '/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();
        $configurator->addDynamicParameters([
            'env' => getenv(),
        ]);

        $configurator->addConfig($appDir . '/config/common/application.neon');
        $configurator->addConfig($appDir . '/config/common/services.neon');
        $configurator->addConfig($appDir . '/config/' . $environment . '/config.neon');

        return $configurator;
    }
}
