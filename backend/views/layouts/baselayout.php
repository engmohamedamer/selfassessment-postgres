<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$bundle = \backend\assets\BackendBaseAsset::register($this);


?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

    <?php $this->beginBody() ?>
        <?php echo $content ?>
    <?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
