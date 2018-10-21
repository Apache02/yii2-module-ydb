<?php

namespace apache02\ydb\controllers;

use Yii;
use yii\web\Controller;
use apache02\ydb\models\Database;
use apache02\ydb\models\Table;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;


/**
 * Default controller for the `db` module
 */
class DefaultController extends Controller
{
	public $defaultAction = 'database';
	
	
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionDatabase ()
	{
		$model = new Database(Yii::$app->getDb());
		return $this->render('database', [
			'db' => $model,
			'dbName' => $model->dbName(),
			'dataProvider' => $model->searchTables(),
		]);
	}
	
	public function findTableModel ( $tableName )
	{
		$db = new Database(Yii::$app->getDb());
		$model = $db->tableModel($tableName);
		if ( !$model ) {
			throw new NotFoundHttpException('Table not found.');
		}
		return $model;
	}
	
	public function actionTable ( $id )
	{
		$model = $this->findTableModel($id);
		return $this->render('table', [
			'model' => $model,
			'dataProvider' => $model->schemaSearch(),
		]);
	}
	
	public function actionData ( $id )
	{
		$model = $this->findTableModel($id);
		return $this->render('data', [
			'model' => $model,
			'dataProvider' => $model->search(),
		]);
	}
	
	public function actionShowCreate ( $id )
	{
		$model = $this->findTableModel($id);
		return $this->render('show-create', [
			'model' => $model,
			'sql' => $model->getTableCreate(),
		]);
	}
	
}

