<?php


namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\model\CommentModel;


/**
 * Class CommentsController
 * @package app\controller
 */
class CommentsController extends Controller

{
    /**
     * @var CommentModel
     */
    protected CommentModel $commentModel;

    /**
     * CommentsController constructor.
     */
    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    /**
     * This handles index page get request
     * @return string|string[]
     */
    public function index()
    {
        return $this->render('index');
    }

    /**
     * This controls feedback get request
     * @param Request $request
     * @return string|string[]
     */
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
            return $this->render('feedback', $data);
        endif;

    }
}


