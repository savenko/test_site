<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\BootstrapPluginAsset;
use \common\models\BillOfLading;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BillOfLadingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Накладные';
$this->params['breadcrumbs'][] = $this->title;

BootstrapPluginAsset::register($this);
$this->registerJsFile('/admin/js/bill-of-lading.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?= Html::a('Создать накладную', ['#'], ['class' => 'btn btn-success btn-sm', 'id' => 'add-btn']) ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?php Pjax::begin(['id' => "bill-of-lading-pjax"]);
                    echo GridView::widget([
                        'id' => 'bill-of-lading-grid',
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\CheckboxColumn'],
                            'city_from',
                            'city_to',
                            'recipient',
                            ['attribute' => 'status_id', 'value' => function ($data) {
                                if ($data->status_id) return BillOfLading::$statusArr[$data->status_id];
                            }],
//            'created_at:datetime',
                            // 'updated_at',

                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update}  {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#',
                                            ['title' => 'Обновить', 'data-pjax' => '0', 'class' => 'btn btn-default btn-sm btn-edit', 'data-id' => $model->id]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', '#',
                                            ['title' => 'Удалить', 'class' => 'btn btn-default btn-sm btn-delete', 'data-id' => $model->id]);
                                    }
                                ],
                            ],
                        ],
                        'layout' => "{items}
                    <div class='dt-row dt-bottom-row'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                {summary}
                            </div>
                            <div class='col-sm-6 text-right'>
                                {pager}
                            </div>
                        </div></div>"
                    ]);
                    Pjax::end();
                    ?>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- /.col -->
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <?= Html::dropDownList('action', [], ['delete' => 'Удалить'], ['prompt' => '--Выберите--', 'class' => 'form-control']) ?>
    </div>
    <div class="col-sm-3">
        <a href="#" id="run-action" class="btn btn-primary">Применить</a>
    </div>
</div>

<?= $this->render('_modal', ['model' => $model]) ?>
