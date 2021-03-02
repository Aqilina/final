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

    public function commentsGetFromDb()
    {

        $comments = $this->commentModel->getComments();
        $data = [
            'comments' => $comments,
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}