<?php

use backend\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FileStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $components array */
/* @var $totalSize integer */

$this->title = 'File Storage Items';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="file-storage-item-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="row text-right">
            <div class="pull-right">
                <div class="col-xs-12">
                    <dl>
                        <dt>
                            <?php echo 'Used size' ?>:
                        </dt>
                        <dd>
                            <?php echo Yii::$app->formatter->asSize($totalSize); ?>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="pull-right">
                <div class="row">
                    <div class="col-xs-12">
                        <dl>
                            <dt>
                                <?php echo 'Count' ?>:
                            </dt>
                            <dd>
                                <?php echo $dataProvider->totalCount ?>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'component',
                    'filter'    => $components
                ],
                [
                    'attribute'     => 'path',
                    'format'        => 'raw',
                    'headerOptions' => ['style' => 'text-align:center'],
                    'value'         => function ($model) {
                        return Html::a($model->path, ['view', 'id' => $model->id], ['class' => 'alink']);
                    },
                ],
                'type',
                'size:size',
                'name',
                'upload_ip',
                'created_at:date',

                [
                    'class'    => 'backend\grid\ActionColumn',
                    'template' => '{view} {delete}'
                ]
            ]
        ]); ?>

    </div>


<?php
$app_css = <<<CSS
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #CFD8DC !important;
}
CSS;

$this->registerCss($app_css);