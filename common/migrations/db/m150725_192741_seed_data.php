<?php

use common\models\User;
use yii\db\Migration;

class m150725_192741_seed_data extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $sql=file_get_contents(__DIR__ . '/sql/init.sql');
        $this->execute($sql);

    }
    /**
     * @return bool|void
     */
    public function safeDown()
    {
        echo "m190113_004502_fillData cannot be reverted.\n";

        return false;
    }
}
