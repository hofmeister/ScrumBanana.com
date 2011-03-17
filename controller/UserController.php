<?php
class UserController extends Controller {
    public function login() {
        $this->validate(array(
            'email'=>'required,email',
            'password'=>'required,min(4)',
        ));
        $data = Request::post()->get('email','password');
        $userDoc = UserService::byAuth($data->email,$data->password);
        if ($userDoc) {

            $user = new UserModel($userDoc);
            SessionHandler::instance()->setUser($user);
            MessageHandler::instance()->addMessage('You were successfully logged in');
        } else {
            MessageHandler::instance()->addError('Error in username and / or password');
        }
        $this->redirect();
    }
    public function logout() {
        SessionHandler::instance()->clearUser();
        $this->redirect();
    }

    public function register() {
        $this->validate(array(
            'name'=>'required,min(2)',
            'email'=>'required,email',
            'password'=>'required,min(4)',
            'password2'=>'required,min(4),equal(password)',
        ));
        $userDoc = Request::post()->get('name','email','password');
        $userDoc->password = md5($userDoc->password);
        $userDoc = UserService::save($userDoc);
        if (!$userDoc) {
            MessageHandler::instance()->addError('E-mail was already registered - forgot your password?');
            return;
        }
        $user = new UserModel($userDoc);
        SessionHandler::instance()->setUser($user);
        MessageHandler::instance()->addMessage('You were successfully registered and logged in');
        $this->redirect();
    }

}