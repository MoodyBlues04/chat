<?php

use yii\db\Migration;

/**
 * Class m220716_195140_users_status
 */
class m220716_195140_users_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'status', $this->integer()->after('email_token'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Columns email and email_token deleted.\n";

        $this->dropColumn('{{%users}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220716_195140_users_status cannot be reverted.\n";

        return false;
    }
    */
}
