<?php

use common\components\comments\Comments;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $post common\models\Posts */

$comments = new Comments(['view' => $this]);

?>

<div>
    <h2><?= $post->label ?></h2>
    <div class="content-container">
        <?= $post->content ?>
    </div>
    <div class="comments-wrap">
        <?= $comments->showCommentsForPost($post->id); ?>
    </div>
</div>