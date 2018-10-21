<?php
namespace apache02\ydb\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;


class Table extends ActiveRecord
{
	private static $_db = null;
	private static $_tableName = null;
	
	
	public static function __init ( $db, $tableName )
	{
		static::$_db = $db;
		static::$_tableName = $tableName;
	}
	
	public static function getDb ()
	{
		return static::$_db;
	}
	
	public static function tableName ()
	{
		return static::$_tableName;
	}
	
	public function attributeLabels ()
	{
		$schema = static::getTableSchema();
		return array_map(function ( $column ) {
			return $column->name;
		}, $schema->columns);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function beforeSave ( $insert )
	{
		// prevent saving this AR model
		$this->addError('', 'READ ONLY');
		return false;
	}
	
	
	public function search ()
	{
		return new ActiveDataProvider([
			'query' => static::find(),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
	}
	
	public function schemaSearch ()
	{
		$i = 0;
		$columns = array_map(function ( $column ) use ( &$i ) {
			return [
				'i'				=> ++$i,
				'name'			=> $column->name,
				'allowNull'		=> $column->allowNull,
				'type'			=> $column->type,
				'phpType'		=> $column->phpType,
				'dbType'		=> $column->dbType,
				'defaultValue'	=> $column->defaultValue,
				'size'			=> $column->size,
				'scale'			=> $column->scale,
				'primary'		=> $column->isPrimaryKey,
				'autoIncrement'	=> $column->autoIncrement,
				'unsigned'		=> $column->unsigned,
				'comment'		=> $column->comment,
			];
		}, static::getTableSchema()->columns);
		return new ArrayDataProvider([
			'allModels' => $columns,
			'key' => 'name',
			'sort' => false,
		]);
	}
	
	public function getTableCreate ()
	{
		$table = static::tableName();
		$table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); 
		$row = $this->getDb()
			->createCommand("SHOW CREATE TABLE `$table`")
			->queryOne();
		$row = array_values($row);
		return $row[1];
	}
	
	
}
