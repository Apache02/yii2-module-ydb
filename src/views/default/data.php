<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Database $db
 * @var Table $model
 */

use yii\helpers\Html;
use semantic\grid\GridView;
use semantic\grid\DataLinkColumn;


?>

<?= $this->context->renderPartial('_tabs', ['model'=>$model]) ?>

<?= GridView::widget([
	'id' => 'table',
	'dataProvider' => $dataProvider,
	'tableOptions' => ['class'=>'ui celled sortable small table'],
]); ?>

<style type="text/css">
#table {
	overflow-y: auto;
}
</style>