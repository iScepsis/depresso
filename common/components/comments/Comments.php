<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 24.03.2018
 * Time: 18:33
 */

namespace common\components\comments;

use dosamigos\ckeditor\CKEditor;
use yii\base\Component;
use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Widget;
use \common\models\Comments as CommentModel;

class Comments extends Component {

    //public $post_id = null;
    public $view = null;

    protected $comments;

    public function init() {
        CommentsAssets::register( $this->view );
       // if (empty($this->post_id)) new \Exception('id статьи не указан');
        parent::init();
    }



    public function showCommentsForPost($post_id){
        $this->getComments($post_id);
        $html = '';
        foreach ($this->comments as $comment) {
            $html .= $this->buildHtml($comment);
        }
        return $html;

    }

    public function createCommentModel(int $post_id, int $user_id, int $comment_id = null ){
        $comment = new CommentModel();
        $comment->fid_post = $post_id;
        $comment->fid_user = $user_id;
        if (!empty($comment_id)) $comment->parent_id = $comment_id;

        return $comment;
        //return $form;
    }

    protected function buildHtml(CommentModel $comment){
        $html =  "<div class='comment'>";
        $html .= $this->buildCommentHeader($comment);
        $html .= "<div class='comment-body'>{$comment->content}</div>";
        $html .= "<div class='comment-footer'></div>";
        $html .= "</div>";
        return $html;
    }

    protected function buildCommentHeader(CommentModel $comment){
        $html = "<div class='comment-header'>";
        $html .= "<div class='col-md-6'>{$comment->user->username}</div>";
        $html .= "<div class='col-md-6'>{$comment->created_at}</div>";
        $html .= "</div>";
        return $html;
    }

    protected function buildCommentFooter(CommentModel $comment){
        $html = "<div class='comment-footer'>";
        $html .= "<div class='col-md-6'>{$comment->likes_count}</div>";
        $html .= "<div class='col-md-6'>Ответить</div>";
        $html .= "</div>";
        return $html;
    }

    protected function getComments($post_id){
        $this->comments = CommentModel::find()
            ->joinWith('user')
            ->where(['fid_post' => $post_id])
            ->all();
    }



}