<?php

namespace apache02\ydb;

use Yii;


/**
 * db module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'apache02\ydb\controllers';

    /**
     * {@inheritdoc}
     */
    public function init ()
    {
        parent::init();
		
        // custom initialization code goes here
		
		// add rules for current module
		$module = $this->uniqueId;
		Yii::$app->urlManager->addRules([
			"$module" => "$module/default/database",
//			"$module/<id:[\w\d_]+>/scheme"	=> "$module/default/table",
//			"$module/<id:[\w\d_]+>/view"	=> "$module/default/view",
//			"$module/table/<id:[\w\d_]+>"	=> "$module/default/table",
		]);
    }
}
