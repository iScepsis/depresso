<?php
/* @var $post_id int - id поста */
/* @var $commentsComponent common\components\comments\Comments */
?>

<div class="comments-wrap">
        <?= $commentsComponent->showCommentsForPost($post_id); ?>
</div>