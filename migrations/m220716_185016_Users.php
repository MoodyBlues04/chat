<?php

use yii\db\Migration;

/**
 * Class m220716_185016_Users
 */
class m220716_185016_Users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Users', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Table Users deleted.\n";

        $this->dropTable('Users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220716_185016_Users cannot be reverted.\n";

        return false;
    }
    */
}
