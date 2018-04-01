<?php

use common\components\comments\Comments as CommentsComponent;
use yii\widgets\Pjax;
use \common\models\Comments as CommentModel;

/* @var $this yii\web\View */
/* @var $post common\models\Posts */
/* @var $comments CommentsComponent */

?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2><?= $post->label ?></h2>
        <div class="content-container">
            <?= $post->content ?>
        </div>
    </div>
</div>
<hr>


<?= $this->render("@frontend/views/comments/index", [
    'post_id' => $post->id,
    'commentsComponent' => $comments,
    'commentModel' => new CommentModel(['fid_post' => $post->id])
]); ?>


