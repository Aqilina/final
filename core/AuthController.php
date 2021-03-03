<?php


namespace app\core;


use app\model\AuthModel;


/**
 * Responsible for handling login and register
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller

{
    /**
     * @var Validation
     */
    public Validation $vld;
    /**
     * @var AuthModel
     */
    protected AuthModel $authModel;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->vld = new Validation;
        $this->authModel = new AuthModel();
    }


    /**
     * This is get and post methods for register
     * @param Request $request
     * @return string|string[]
     */
    public function register(Request $request)
    {
        if ($request->isGet()) :

            $data = [
                'name' => '',
                'lastname' => '',
                'email' => '',
                'phone' => '',
                'address' => '',
                'password' => '',
                'confirmPassword' => '',
                'errors' => [
                    'nameErr' => '',
                    'lastname' => '',
                    'emailErr' => '',
                    'phoneErr' => '',
                    'addressErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => '',
                ],
            ];

            return $this->render('register', $data);
        endif;

        if ($request->isPost()) :
            $data = $request->getBody();

            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);
            $data['errors']['lastnameErr'] = $this->vld->validateLastname($data['lastname']);
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->authModel);
            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 6, 10);
            $data['errors']['confirmPasswordErr'] = $this->vld->confirmPassword($data['confirmPassword']);

            //JEI NERA KLAIDU
            if ($this->vld->ifEmptyArr($data['errors'])) :

                //uzhashinti slaptazodi
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->authModel->registerToDb($data)) {
                    $request->redirect('/login');
                } else {
                    die('Something went wrong in adding user to db');
                }

            endif;

            return $this->render('register', $data);
        endif;
    }


//    --------------------------------------------------------------------
    /**
     * This enables user login. Handles get an post requests.
     *
     * @param Request $request
     * @return string|string[]
     */
    public function login(Request $request)
    {
        if ($request->isGet()) :
            $data = [
                'email' => '',
                'password' => '',
                'errors' => [
                    'emailErr' => '',
                    'passwordErr' => '',
                ]
            ];
            return $this->render('login', $data);
        endif;

        if ($request->isPost()) :

            // we get all post values sanitized
            $data = $request->getBody();

            // validation
            $data['errors']['emailErr'] = $this->vld->validateLoginEmail($data['email'], $this->authModel);
            $data['errors']['passwordErr'] = $this->vld->validateEmpty($data['password'], 'Please enter your password');

            // if there are no errors
            if ($this->vld->ifEmptyArr($data['errors'])) {

                $loggedInUser = $this->authModel->loginToDb($data['email'], $data['password']);


                if ($loggedInUser) {

                    $this->createUserSession($loggedInUser);
                    $request->redirect('/index');
                } else {
                    $data['errors']['passwordErr'] = 'Wrong password or email';
                    // load view with errors
                    return $this->render('login', $data);
                }
            }

            return $this->render('login', $data);
        endif;
    }

    /**
     *  if we have user we save its data in session
     * @param $userRow
     */
    public function createUserSession($userRow)
    {
        $_SESSION['user_id'] = $userRow->id;
        $_SESSION['user_email'] = $userRow->email;
        $_SESSION['user_name'] = $userRow->name;

    }

    /**
     * Unset Session values and destroy session + redirect to /
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        session_destroy();

        $request->redirect('/');

    }


}