<?php

/** @var yii\web\View $this */
/** @var \app\models\Deeplink $model */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <h5>Generate link</h5>
            <div class="col-lg-12 mb-3">
                <?= $this->render('generator', ['model' => $model]) ?>
            </div>
        </div>

    </div>
</div>
<?php
$this->registerJs(<<<JS
$(document).on('submit', 'form#deeplink-form', function (event) {
    event.preventDefault();
    let form = $(this);
    form.hide();
    form.parent().append('<div class="spinner-border" role="status"></div>')
    $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success: function (data) {
                form.parent().html(data);
            }
        });
        return false;
});
JS); ?>
