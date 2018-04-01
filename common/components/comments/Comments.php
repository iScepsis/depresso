<?php
namespace common\components\comments;

use yii\base\Component;
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

    public function createCommentModel(int $post_id, int $comment_id = null ){
        $comment = new CommentModel();
        $comment->fid_post = $post_id;
        //$comment->fid_user = $user_id;
        if (!empty($comment_id)) $comment->parent_id = $comment_id;

        return $comment;
    }

    protected function buildHtml(CommentModel $comment){
        $html =  "<div class='row'>";
            $html .=  "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                $html .=  "<div class='comment'>";
                $html .= $this->buildCommentHeader($comment);
                $html .= "<div class='comment-body'>{$comment->content}</div>";
                $html .= $this->buildCommentFooter($comment);
                $html .= "</div>";
            $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    protected function buildCommentHeader(CommentModel $comment){
        $html = "<div class='comment-header'>";
            $html .= "<div class='row'>";
                $html .= "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'><b>{$comment->user->username}</b></div>";
                $html .= "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right'>{$comment->created_at}</div>";
            $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    protected function buildCommentFooter(CommentModel $comment){
        $html = "<div class='comment-footer'>";
            $html .= "<div class='row'>";
                $html .= "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>{$comment->likes_count}</div>";
                $html .= "<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right'>
                                <a href='#comment-form' onclick='setAnswerForComment({$comment->id});'>Ответить</a>
                          </div>";
            $html .= "</div>";
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