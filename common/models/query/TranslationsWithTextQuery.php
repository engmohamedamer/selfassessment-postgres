<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[TranslationsWithText]].
 *
 * @see TranslationsWithText
 */
class TranslationsWithTextQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TranslationsWithText[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TranslationsWithText|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
