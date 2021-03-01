<?php


namespace app\core;


use app\core\Controller;
use app\model\AuthModel;


class AuthController extends Controller

{
    public Validation $vld;
    protected AuthModel $authModel;

    public function __construct()
    {
        $this->vld = new Validation;
        $this->authModel = new AuthModel();
    }


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
//            var_dump($data);
            return $this->render('register', $data);
        endif;

        if ($request->isPost()) :
            $data = $request->getBody();

            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);
            $data['errors']['lastnameErr'] = $this->vld->validateLastname($data['lastname']);
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email']);
//            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email']);
            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 6, 10);
            $data['errors']['confirmPasswordErr'] = $this->vld->confirmPassword($data['confirmPassword']);

            //JEI NERA KLAIDU
            if ($this->vld->ifEmptyArr($data['errors'])) :

                //uzhashinti slaptazodi
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->authModel->registerToDb($data)) {
                    print "NUEJO I DB";
//                    $request->redirect('/login');
                } else {
                    die('Something went wrong in adding user to db');
                }

            endif;

            var_dump($data);
            return $this->render('register', $data);
        endif;

    }



//    --------------------------------------------------------------------
    public function login()
    {
        $data = [
            'vardas' => 'Aqilina'
        ];
        return $this->render('login', $data);
    }


}