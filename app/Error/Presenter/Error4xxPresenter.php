<?php declare(strict_types=1);

namespace App\Error\Presenter;

use Nette\Application\BadRequestException;
use Nette\Application\Request;
use Nette\Application\UI\Presenter;
use Rdurica\Core\Presenter\SetMdbTemplateLayout;

/**
 * Error4xxPresenter.
 *
 * @package   App\Presenter
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-15
 */
final class Error4xxPresenter extends Presenter
{
    use SetMdbTemplateLayout;

    /**
     * @throws BadRequestException
     */
    protected function startup(): void
    {
        parent::startup();

        if (!$this->getRequest()?->isMethod(Request::FORWARD)) {
            $this->error();
        }
    }

    public function renderDefault(BadRequestException $exception): void
    {
        // load template 403.latte or 404.latte or ... 4xx.latte
        $file = __DIR__ . "/../../../vendor/rdurica/core/src/Templates/Error/{$exception->getCode()}.latte";
        $this->getTemplate()->setFile(
            is_file($file) ? $file : __DIR__ . '/../../../vendor/rdurica/core/src/Templates/Error/4xx.latte'
        );
    }
}
