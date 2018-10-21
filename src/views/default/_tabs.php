<?php

/**
 * @var yii\web\View $this
 * @var Table $model
 */

use yii\helpers\Html;
use semantic\TabularMenuItem;
use semantic\Breadcrumbs;


$id = $model::tableName();
$this->title = Yii::t('db', 'Table #{0}', $id);

?>


<?= Breadcrumbs::widget([
	'homeLink' => false,
	'options' => ['class'=>'ui header breadcrumb'],
	'links' => [
		[
			'label' => Yii::t('db', 'Database'),
			'url' => ['database'],
		],
		$id
	],
	'tag' => 'h1',
	'size' => 'massive',
]) ?>

<?= TabularMenuItem::widget([
	'items'		=> [
		'table'		=> [
			'label'		=> Yii::t('db', 'View'),
			'icon'		=> 'info circle',
			'url'		=> ['table', 'id'=>$id],
		],
		'data'		=> [
			'label'		=> Yii::t('db', 'Data'),
			'icon'		=> 'th list',
			'url'		=> ['data', 'id'=>$id],
		],
		'show-create'=> [
			'label'		=> Yii::t('db', 'SQL'),
			'icon'		=> 'code',
			'url'		=> ['show-create', 'id'=>$id],
		],
	],
]) ?>

