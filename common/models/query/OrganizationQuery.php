<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\query\Organization]].
 *
 * @see \common\models\query\Organization
 */
class OrganizationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\query\Organization[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\Organization|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
