<?php
namespace apache02\ydb\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;


class Database extends Model
{
	private $_db;
	private $_tablesList = null;
	
	
	public function __construct ( $db, $config = [] )
	{
		if ( empty($db) || !($db instanceof Connection) ) {
			throw new InvalidParamException('Not a db connection.');
		}
		$this->_db = $db;
		parent::__construct($config);
	}
	
	public function getDb ()
	{
		return $this->_db;
	}
	
	public function dbName ()
	{
		return $this->getDb()
			->createCommand('SELECT DATABASE()')
			->queryScalar();
	}
	
	public function tablesList ()
	{
		$db = $this->getDb();
		$schema = $db->getSchema();
		$list = $schema->getTableSchemas();
		return array_map(function ( $table ) use ( $db ) {
			return [
				'id' => $table->name,
				'name' => $table->name,
				'primaryKey' => $table->primaryKey,
				'columns' => array_map(function ( $column ) {
					return $column->name;
				}, $table->columns),
				'columnsCount' => count($table->columns),
				'rowsCount' => $db->createCommand("SELECT COUNT(*) FROM `{$table->name}`")->queryScalar(),
			];
		}, $list);
	}
	
	
	public function searchTables ()
	{
		return new ArrayDataProvider([
			'allModels' => $this->tablesList(),
			'key' => 'id',
			'sort' => false,
			'pagination' => false,
		]);
	}
	
	public function tableSchema ( $tableName )
	{
		$schema = $this->getDb()->getSchema();
		foreach ( $schema->getTableSchemas() as $tableSchema ) {
			if ( $tableSchema->name == $tableName ) {
				return $tableSchema;
			}
		}
		return null;
	}
	
	public function tableModel ( $tableName )
	{
		$schema = $this->tableSchema($tableName);
		if ( !$schema ) {
			return null;
		}
		Table::__init($this->getDb(), $schema->name);
		return new Table();
	}
	
	
}
