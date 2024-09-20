<?php
/** @var yii\web\View $this */
/** @var \app\models\Deeplink $model */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php if (!empty($model->shortLink)): ?>
    <div class="form-group">
        <?= Html::a($model->shortLink, $model->shortLink) ?>
    </div>
    <div class="form-group">
        <?= Html::img($model->qrCode) ?>
    </div>
<?php else: ?>
    <?php $form = ActiveForm::begin(['id' => 'deeplink-form']); ?>

    <?= $form->field($model, 'url')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php endif; ?>
