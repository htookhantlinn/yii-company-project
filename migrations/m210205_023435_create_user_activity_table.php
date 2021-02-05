<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_activity}}`.
 */
class m210205_023435_create_user_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_activity}}', [
            'id' => $this->primaryKey(),
            'user' => $this->integer(),
            'company' => $this->integer(),
            'modified' => $this->DateTime(),
            'created' => $this->DateTime(),
            'action' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_activity}}');
    }
}
