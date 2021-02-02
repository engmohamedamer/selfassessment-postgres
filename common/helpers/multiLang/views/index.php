<?php
/**
 * @var View $this
 */
use yii\helpers\Html;
use yii\web\View;

?>
<?php $sid = uniqid();
//Yii::$app->language ='en';
$setDefualtLang= 'en';
?>

<div class="translatenav">

<ul class="nav nav-pills ">
	<?php foreach (Yii::$app->params['mlConfig']['languages'] as $languageCode => $languageName): ?>

		<li class="nav-item  <?= ($setDefualtLang == $languageCode) ? 'active' : '' ?>">
			<a class="nav-link " href="#L<?= $sid.$languageCode ?>" data-toggle="tab" aria-expanded="true">
				<?= $languageName ?>
			</a>
		</li>
	<?php endforeach ?>

</ul>




<div class="tab-content mt-2">

	<?php foreach (Yii::$app->params['mlConfig']['languages'] as $languageCode => $languageName): ?>

		<?php
		$attribute = $this->context->attribute;

		if ( $languageCode != Yii::$app->params['mlConfig']['default_language'] )
		{
			$attribute .= '_' . $languageCode;
		}

		$activeClass = ($setDefualtLang == $languageCode) ? 'active' : '';
		?>


		<div class="tab-pane <?= $activeClass ?>" id="L<?=  $sid.$languageCode ?>">

			<?= $this->context->getInputField($attribute) ?>
		</div>


	<?php endforeach ?>
</div>
</div>
