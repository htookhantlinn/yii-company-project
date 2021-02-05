<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m210205_023557_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string(),
            'created' => $this->DateTime(),
            'modified' => $this->DateTime(),
        ]);

        $this->createIndex(
            'idx-parent_id_id',
            'category',
            'parent_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-parent_id_id',
            'category',
            'parent_id',
            'category',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
