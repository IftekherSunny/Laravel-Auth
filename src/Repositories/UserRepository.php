<?php

namespace Sun\Repositories;

use Config;
use Mail;

class UserRepository
{

    /**
     * To check user account is active
     *
     * @param $email
     *
     * @return bool
     */
    public function isActive($email)
    {
        $model = Config::get('SunAuth.user-model-namespace');
        $user = $model::whereEmail($email)->first();

        return $user->active;
    }

    /**
     * To check given email is registered
     *
     * @param $email
     *
     * @return bool
     */
    public function isRegistered($email)
    {
        $model = Config::get('SunAuth.user-model-namespace');
        $user = $model::whereEmail($email)->first();

        if ($user) {
            return true;
        }

        return false;
    }

    /**
     * To register a user
     *
     * @param $request
     *
     * @return array
     */
    public function register($request)
    {
        $model = Config::get('SunAuth.user-model-namespace');
        $user = new $model;

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->tempPassword = ' ';
        $user->active = 0;
        $user->code = md5(rand());

        return $user;
    }

    /**
     * To send confirmation email
     *
     * @param $user
     */
    public function sendConfirmationEmail($user)
    {
        Mail::send('sun::emails.registration', ['code' => $user->code, 'name' => $user->name], function ($m) use ($user) {
            $m->to($user->email,
                $user->name)->subject('[ ' . Config::get('SunAuth.app.name') . ' ] Confirm your email address.');
        });
    }

    /**
     * @param $code
     *
     * @return array users
     */
    public function isValidCode($code)
    {
        $model = Config::get('SunAuth.user-model-namespace');
        $user = $model::whereCode($code)->first();

        return $user;
    }

    /**
     * To make user account active
     *
     * @param $user
     */
    public function makeActive($user)
    {
        $user->active = 1;
        $user->code = '';
        $user->save();
    }

    /**
     * To check email is valid
     *
     * @param $email
     *
     * @return array
     */
    public function isValidEmail($email)
    {
        $model = Config::get('SunAuth.user-model-namespace');
        $user = $model::whereEmail($email)->first();

        return $user;
    }

    /**
     * To set temporary password for a user
     *
     * @param $user
     *
     * @return array
     */
    public function setTempPassword($user)
    {
        $tempPassword = rand();

        $user->password = '';
        $user->tempPassword = bcrypt($tempPassword);
        $user->code = md5(rand());

        $user->save();

        return [
            "tempPassword" => $tempPassword,
            "user" => $user
        ];
    }

    /**
     * To send password reset email
     *
     * @param $user
     */
    public function sendResetEmail($user)
    {
        Mail::send('sun::emails.reset', ['password' => $user['tempPassword'], 'code' => $user['user']->code,
            'name' => $user['user']->name],
            function ($m) use ($user) {
                $m->to($user['user']->email,
                    $user['user']->name)->subject('[ ' . Config::get('SunAuth.app.name') . ' ] Your new password.');
            });

    }

    /**
     * To set new password for a user
     *
     * @param $user
     */
    public function setNewPassword($user)
    {
        $user->code = '';
        $user->password = $user->tempPassword;
        $user->tempPassword = '';
        $user->save();

    }
}