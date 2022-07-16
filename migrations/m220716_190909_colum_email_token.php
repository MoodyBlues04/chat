<?php

use yii\db\Migration;

/**
 * Class m220716_190909_colum_email_token
 */
class m220716_190909_colum_email_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'email', $this->string()->unique()->after('password'));
        $this->addColumn('{{%users}}', 'email_token', $this->string()->unique()->after('email'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Columns email and email_token deleted.\n";

        $this->dropColumn('{{%users}}', 'email');
        $this->dropColumn('{{%users}}', 'email_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220716_190909_colum_email_token cannot be reverted.\n";

        return false;
    }
    */
}
