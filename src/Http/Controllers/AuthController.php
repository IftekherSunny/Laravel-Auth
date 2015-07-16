<?php

namespace Sun\Http\Controllers;

use Auth;
use config;
use Sun\Flash;
use Illuminate\Routing\Controller;
use Sun\Http\Requests\LoginRequest;
use Sun\Http\Requests\ResetRequest;
use Sun\Repositories\UserRepository;
use Sun\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    /**
     * @var Flash
     */
    protected $flash;

    /**
     * @var user
     */
    protected $userRepo;

    /**
     * @param Flash          $flash
     * @param UserRepository $userRepo
     *
     * @internal param User $user
     */
    public function __construct(Flash $flash, UserRepository $userRepo)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('auth', ['only' => 'getLogout']);

        $this->flash = $flash;
        $this->userRepo = $userRepo;
    }

    /**
     * To show login form
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('sun::auth.login');
    }

    /**
     * To check user credentials
     *
     * @param LoginRequest $request
     * @param Auth         $auth
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request, Auth $auth)
    {
        if (!$this->userRepo->isRegistered($request->get('email'))) {
            $this->flash->error('The email address is not registered.');

            return redirect()->back();
        }

        if (!$this->userRepo->isActive($request->get('email'))) {
            $this->flash->error('Please, confirm your email address.');

            return redirect()->back();
        }

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')],
            $request->get('remember'))
        ) {

            return redirect()->intended(Config::get('SunAuth.redirect-after-login'));
        }

        $this->flash->error('Email / Password do not match.');

        return redirect()->back();
    }

    /**
     * To show registration form
     *
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
        return view('sun::auth.register');
    }

    /**
     * To register a user
     *
     * @param RegistrationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(RegistrationRequest $request)
    {
        $user = $this->userRepo->register($request);

        if ($user->save()) {

            $this->userRepo->sendConfirmationEmail($user);

            $this->flash->success('Your confirmation email has been sent.');
        }

        return redirect('/auth/register');
    }

    /**
     * To confirm user email is valid
     *
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getEmailConfirm($code)
    {
        $user = $this->userRepo->isValidCode($code);

        if ($user) {

            $this->userRepo->makeActive($user);

            $this->flash->success('Thank you for your registration.');
        } else {
            $this->flash->error('You use wrong email confirmation code.');
        }

        return redirect('/auth/login');
    }

    /**
     * To show password reset form
     *
     * @return \Illuminate\View\View
     */
    public function getReset()
    {
        return view('sun::auth.reset');
    }

    /**
     * To reset password
     *
     * @param ResetRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postReset(ResetRequest $request)
    {
        $user = $this->userRepo->isValidEmail($request->get('email'));

        if ($user) {

            $user = $this->userRepo->setTempPassword($user);

            $this->userRepo->sendResetEmail($user);

            $this->flash->success('Your new password has been sent.');

            return redirect()->back();

        }

        $this->flash->error('Invalid email address.');

        return redirect()->back();
    }

    /**
     * To ensure password reset request from a valid user
     *
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getResetConfirm($code)
    {
        $user = $this->userRepo->isValidCode($code);

        if ($user) {

            $this->userRepo->setNewPassword($user);

            $this->flash->success('Your password has been reset successfully.');
        } else {
            $this->flash->error('You use wrong reset password confirmation code.');
        }

        return redirect('/auth/login');
    }

    /**
     * To logout a user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect('/auth/login');
    }
}
