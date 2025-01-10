<?php declare(strict_types=1);

namespace App\Auth\Presenter;

use App\Auth\Model\Data\SignInFormData;
use Contributte\Translation\Exceptions\InvalidArgument;
use Contributte\Translation\Translator;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Rdurica\Core\Enum\FlashType;
use Rdurica\Core\Presenter\Presenter;
use Rdurica\Core\Presenter\RequireAnonymousUser;
use Rdurica\Core\Presenter\SetMdbTemplateLayout;
use Rdurica\CoreAcl\Exception\DisabledAccountException;
use Rdurica\CoreAcl\Exception\InvalidCredentialsException;
use Rdurica\CoreAcl\Model\Service\AuthenticationService;

/**
 * HomePresenter.
 *
 * @package   App\Presenter
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-15
 */
final class SignPresenter extends Presenter
{
    use SetMdbTemplateLayout;
    use RequireAnonymousUser;

    /**
     * Constructor.
     *
     * @param User                  $user
     * @param AuthenticationService $authenticationService
     */
    public function __construct(
        private User $user,
        private AuthenticationService $authenticationService,
        private Translator $translator
    ) {
        parent::__construct();
    }

    /**
     * SignIn form.
     *
     * @return Form
     * @throws InvalidArgument
     */
    public function createComponentSignInForm(): Form
    {
        $labelUsername = $this->translator->translate('auth.label.username');
        $labelPassword = $this->translator->translate('auth.label.password');
        $labelButton = $this->translator->translate('auth.label.login');

        $form = new Form();
        $form->addText('username', $labelUsername)
            ->setRequired();
        $form->addPassword('password', $labelPassword)
            ->setRequired();
        $form->addSubmit('login', $labelButton);

        $form->addProtection();
        $form->setMappedType(SignInFormData::class);
        $form->onSuccess[] = [$this, 'signInFormOnSuccess'];

        return $form;
    }

    /**
     * Process SignIn form.
     *
     * @param Form           $form
     * @param SignInFormData $data
     *
     * @return void
     * @throws AbortException
     * @throws InvalidArgument
     */
    public function signInFormOnSuccess(Form $form, SignInFormData $data): void
    {
        try {
            $identity = $this->authenticationService->authenticate($data->username, $data->password);
            $this->user->login($identity);
        } catch (DisabledAccountException) {
            $message = $this->translator->translate('auth.flash.disabledAccount');
            $this->addFlashMessage($message);
        } catch (InvalidCredentialsException) {
            $message = $this->translator->translate('auth.flash.invalidCredentials');
            $this->addFlashMessage($message, FlashType::WARNING);
        } catch (AuthenticationException) {
            $message = $this->translator->translate('auth.flash.authenticationFailed');
            $this->addFlashMessage($message, FlashType::ERROR);
        }

        $this->redirect('this');
    }
}
