<?php


namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\model\CommentModel;
use app\core\Validation;


class CommentsController extends Controller

{
    protected CommentModel $commentModel;
    public Validation $vld;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->vld = new Validation();
    }

    public function index()
    {
        return $this->render('index');
    }


    public function feedback(Request $request)
    {
        if ($request->isGet()) :
            $data = [
                'comments' => $this->commentModel->getComments(),
                'name' => '',
                'comment' => '',
                'errors' => [
                    'nameErr' => '',
                    'commentErr' => '',
                ],
            ];

//        var_dump($data);
            return $this->render('feedback', $data);
        endif;

//-----------------------------------------------------------------------------------------------
        if ($request->isPost()) :

            $data = [
                'comments' => $this->commentModel->getComments(),
                'name' => $request->getBody()['name'],
                'comment' => $request->getBody()['comment'],
            ];

            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);
            $data['errors']['commentErr'] = $this->vld->validateComment($data['comment']);


            //if there are no errors:
            if ($this->vld->ifEmptyArr($data['errors'])) :

                //PRIDETI KOMENTARA
//            $this->commentModel->insertComment($data);

                $data = [
                    'comments' => $this->commentModel->getComments()
                ];
            endif;

            return $this->render('feedback', $data);

        endif;
    }

}


