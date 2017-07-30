<?php

use yii\widgets\ActiveForm;

;

use common\models\BillOfLading;

?>
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['action' => '#']); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Форма</h4>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'city_from')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'city_to')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'recipient')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status_id')->dropDownList(BillOfLading::$statusArr, ['prompt' => '--Выберите--']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                <input type="submit" value="Сохранить" class="btn btn-primary" id="btn-modal-save"/>
            </div>
            <?php ActiveForm::end(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->