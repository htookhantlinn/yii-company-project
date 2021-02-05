<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%category}}`
 */
class m210205_023938_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'website' => $this->string(),
            'address' => $this->string(),
            'ph_no' => $this->string(),
            'user' => $this->integer()->notNull(),
            'category' => $this->integer()->notNull(),
        ]);

        // creates index for column `user`
        $this->createIndex(
            '{{%idx-company-user}}',
            '{{%company}}',
            'user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-company-user}}',
            '{{%company}}',
            'user',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category`
        $this->createIndex(
            '{{%idx-company-category}}',
            '{{%company}}',
            'category'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-company-category}}',
            '{{%company}}',
            'category',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-company-user}}',
            '{{%company}}'
        );

        // drops index for column `user`
        $this->dropIndex(
            '{{%idx-company-user}}',
            '{{%company}}'
        );

        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-company-category}}',
            '{{%company}}'
        );

        // drops index for column `category`
        $this->dropIndex(
            '{{%idx-company-category}}',
            '{{%company}}'
        );

        $this->dropTable('{{%company}}');
    }
}
