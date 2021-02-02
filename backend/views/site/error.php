<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

//$this->title = $name;
?>
<div class="error">
    <div class="row">
        <div class="col-xs-4">
            <img src="/material/img/error.png">
        </div>
        <div class="col-xs-8">
            <div class="error-content">
                
                <h3 class="headline">
                   
                    <?php echo Yii::t(
                        'backend',
                        '{code}',
                        [
                            'code' => property_exists($exception, 'statusCode') ? $exception->statusCode : 500
                        ])
                    ?>
                </h3>
                <p>
                      <?php echo nl2br(Html::encode($message)) ?>
                </p>
            </div>
        </div>
    </div>
</div><!-- /.error-page -->