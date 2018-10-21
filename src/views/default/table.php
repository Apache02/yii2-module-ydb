<?php

/**
 * @var yii\web\View $this
 * @var ..\..\models\Table $model
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use semantic\grid\GridView;
use semantic\grid\DataLinkColumn;
use semantic\grid\NiceColorLabelColumn;
use semantic\grid\SimpleTagsColumn;


$formatter = clone Yii::$app->formatter;
$formatter->nullDisplay = '';


?>

<?= $this->context->renderPartial('_tabs', ['model'=>$model]) ?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'tableOptions' => ['class'=>'ui celled definition selectable table'],
	'formatter' => $formatter,
	'columns' => [
		[
			'attribute'	=> 'name',
//			'label'		=> Yii::t('db', 'Column Name'),
			'label'		=> '',
		],
		[
			'class'		=> NiceColorLabelColumn::class,
			'colorMap'	=> [
				'integer'	=> 'blue',
				'tinyint'	=> 'blue',
				'smallint'	=> 'blue',
				'decimal'	=> 'green',
				'string'	=> 'teal',
				'datetime'	=> 'orange',
				'binary'	=> 'black',
			],
			'excludeColorMap' => true,
			'attribute'	=> 'type',
			'label'		=> Yii::t('db', 'Type'),
		],
		[
			'class'		=> NiceColorLabelColumn::class,
			'attribute'	=> 'phpType',
			'label'		=> 'PHP',
		],
		[
//			'class'		=> NiceColorLabelColumn::class,
			'attribute'	=> 'dbType',
			'label'		=> 'DB',
		],
		[
			'attribute'	=> 'size',
			'label'		=> Yii::t('db', 'Size'),
		],
		[
			'attribute'	=> 'defaultValue',
			'label'		=> Yii::t('db', 'Default Value'),
		],
		[
			'class'		=> SimpleTagsColumn::class,
			'label'		=> Yii::t('db', 'Other'),
			'tagOptions'=> ['class'=>'ui small label'],
			'tags'		=> [
				[
					'if'		=> 'primary',
					'label'		=> 'PK',
					'color'		=> 'blue',
					'title'		=> Yii::t('db', 'Primary Key'),
				],
				[
					'if'		=> 'autoIncrement',
					'label'		=> 'AI',
					'color'		=> 'teal',
					'title'		=> Yii::t('db', 'Auto Increment'),
				],
				[
					'if'		=> 'allowNull',
					'label'		=> 'NULL',
					'color'		=> 'black',
					'title'		=> Yii::t('db', 'Allow Null'),
				],
				[
					'if'		=> 'unsigned',
					'label'		=> 'U',
					'color'		=> 'green',
					'title'		=> Yii::t('db', 'Unsigned'),
				],
			],
		],
		[
			'attribute'	=> 'comment',
			'label'		=> Yii::t('db', 'Comment'),
		],
	],
]); ?>
