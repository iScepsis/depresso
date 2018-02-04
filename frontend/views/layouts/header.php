<?php
use yii\bootstrap\Html;

?>

<header class="header">
    <div class="row">
        <div class="col-md-6">
            <?=

            Html::a(
                Html::img('images/logo.png', ['height' => '100px']),
                'index'); ?>
        </div>
        <div class="col-md-6">
            <h3 class="text-muted">Another web-blog, from another grumpy developer...</h3>
        </div>
    </div>

</header>

