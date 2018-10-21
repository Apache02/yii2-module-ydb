<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Database $db
 * @var string $dbName
 */

use yii\helpers\Html;
use semantic\grid\GridView;
use semantic\grid\DataLinkColumn;
use yii\helpers\ArrayHelper;


$this->title = Yii::t('db', 'Database');

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'tableOptions' => ['class'=>'ui celled selectable definition table'],
	'columns' => [
		'name' => [
			'class'		=> DataLinkColumn::class,
			'label'		=> Yii::t('db', 'Table Name'),
			'attribute'	=> 'name',
			'url'		=> ['table'],
			'urlAttr'	=> ['id'=>'id'],
		],
		'pk' => [
			'label'		=> Yii::t('db', 'Primary Key'),
			'value'		=> function ( $model ) {
				return implode(', ', ArrayHelper::getValue($model, 'primaryKey'));
			},
		],
		'columnsCount' => [
			'class'		=> DataLinkColumn::class,
			'label'		=> Yii::t('db', 'Columns'),
			'attribute'	=> 'columnsCount',
			'url'		=> ['table'],
			'urlAttr'	=> ['id'=>'id'],
		],
		'rowsCount' => [
			'class'		=> DataLinkColumn::class,
			'label'		=> Yii::t('db', 'Rows'),
			'attribute'	=> 'rowsCount',
			'url'		=> ['data'],
			'urlAttr'	=> ['id'=>'id'],
		],
	],
]); ?>

<div class="ui meta inverted basic segment">
	<div><?= Yii::t('db', 'Database name: {0}', $dbName) ?></div>
	<div><?= Yii::t('db', 'Version: {0}', $db->getDb()->serverVersion) ?></div>
</div>
