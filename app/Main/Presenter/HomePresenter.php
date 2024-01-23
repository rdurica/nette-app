<?php declare(strict_types=1);

namespace App\Main\Presenter;

use Rdurica\Core\Presenter\Presenter;
use Rdurica\Core\Presenter\SetMdbTemplateLayout;

/**
 * HomePresenter.
 *
 * @package   App\Presenter
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-15
 */
final class HomePresenter extends Presenter
{
    use SetMdbTemplateLayout;

    /** @var string Presenter name. */
    public const PRESENTER_NAME = 'Home';
}
