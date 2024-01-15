<?php

declare(strict_types=1);

namespace app;

use Nette\Bootstrap\Configurator;

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
		$configurator = new Configurator();
		$appDir = dirname(__DIR__);

        $configurator->setDebugMode((bool)getenv()["DEBUG"]); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();
        $configurator->addDynamicParameters([
            'env' => getenv(),
        ]);
		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');
		$configurator->addConfig($appDir . '/config/database.neon');

		return $configurator;
	}
}
