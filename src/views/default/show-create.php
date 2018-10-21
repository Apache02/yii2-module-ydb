<?php

/**
 * @var yii\web\View $this
 * @var Table $model
 * @var string $sql
 */

use yii\helpers\Html;


?>

<?= $this->context->renderPartial('_tabs', ['model'=>$model]) ?>

<div class="ui form">
	<div class="field">
		<?= Html::textarea('', $sql, ['id'=>'code', 'rows'=>20, 'class'=>'ui basic big segment']) ?>
	</div>
</div>

<style type="text/css">
#code {
	font-family: monospace;
}
</style>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
	var code = document.getElementById('code');
	var text = code.value;
	code.rows = text.split("\n").length;
	code.addEventListener('focus', function ( event ) {
		code.select();
	});
	code.addEventListener('input', function ( event ) {
		code.value = text;
	});
});
</script>
