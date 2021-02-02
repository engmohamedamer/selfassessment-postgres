<?php

namespace backend\models\activequery;

/**
 * This is the ActiveQuery class for [[\backend\models\activequery\CorrectiveActionReport]].
 *
 * @see \backend\models\activequery\CorrectiveActionReport
 */
class CorrectiveActionReportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\activequery\CorrectiveActionReport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\activequery\CorrectiveActionReport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
