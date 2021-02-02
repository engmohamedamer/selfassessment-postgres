<?php

namespace common\helpers;

use trntv\filekit\behaviors\UploadBehavior;
use yii\helpers\ArrayHelper;
/**
 * This is the custom UploadBehavior for soft delete.
 */
class MyUploadBehavior extends UploadBehavior
{
    public $metaAttribute;

    protected function saveFilesToRelation($files)
    {
        $modelClass = $this->getUploadModelClass();
        foreach ($files as $file) {
            $model = new $modelClass;
            $model->setScenario($this->uploadModelScenario);
            $model = $this->loadModel($model, $file);
            $model->meta = $this->metaAttribute;
            if ($this->getUploadRelation()->via !== null) {
                $model->save(false);
            }
            $this->owner->link($this->uploadRelation, $model);
        }
    }
}