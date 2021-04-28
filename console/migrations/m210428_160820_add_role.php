<?php

use yii\db\Migration;

/**
 * Class m210428_160820_add_role
 */
class m210428_160820_add_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $auth->add($auth->createRole('admin'));
        $auth->add($auth->createRole('user'));
        $auth->add($auth->createRole('manager'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210428_160820_add_role cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210428_160820_add_role cannot be reverted.\n";

        return false;
    }
    */
}
