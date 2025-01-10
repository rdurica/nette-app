<?php declare(strict_types=1);

namespace App\Main\Presenter;

use Rdurica\Core\Presenter\Presenter;
use Rdurica\Core\Presenter\RequireLoggedUser;
use Rdurica\Core\Presenter\SetMdbTemplateLayout;

/**
 * HomePresenter.
 *
 * @copyright Copyright (c) 2025, Robert Durica
 * @since     2025-01-10
 */
final class HomePresenter extends Presenter
{
    use SetMdbTemplateLayout;
    use RequireLoggedUser;
}
