<?php


namespace app\core;


use app\model\CommentModel;

class Api extends Controller
{

    /**
     * @var CommentModel
     */
    private CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function commentsGetFromDb(Request $request)
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

        header('Content-Type: application/json');
        echo json_encode($data);

        endif;
    }


    public function addComment(Request $request)
    {
        $vld = new Validation();

        if ($request->isPost()) :

        $data = [
            'comments' => $this->commentModel->getComments(),
            'name' => $request->getBody()['name'],
            'comment' => $request->getBody()['comment'],
        ];

        $data['errors']['nameErr'] = $vld->validateName($data['name']);
        $data['errors']['commentErr'] = $vld->validateComment($data['comment']);

        //if there are no errors:
        if ($vld->ifEmptyArr($data['errors'])) :


//            //PRIDETI KOMENTARA
            $this->commentModel->insertComment($data);
            $result['success'] = "Comment added";
        else:
            $result['errors'] = $data['errors'];
        endif;

        header('Content-Type: application/json');
        echo json_encode($result);

        endif;
    }

}