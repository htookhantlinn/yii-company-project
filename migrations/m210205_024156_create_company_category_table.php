<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%company}}`
 * - `{{%category}}`
 */
class m210205_024156_create_company_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_category}}', [
            'id' => $this->primaryKey(),
            'company' => $this->integer()->notNull(),
            'category' => $this->integer()->notNull(),
        ]);

        // creates index for column `company`
        $this->createIndex(
            '{{%idx-company_category-company}}',
            '{{%company_category}}',
            'company'
        );

        // add foreign key for table `{{%company}}`
        $this->addForeignKey(
            '{{%fk-company_category-company}}',
            '{{%company_category}}',
            'company',
            '{{%company}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category`
        $this->createIndex(
            '{{%idx-company_category-category}}',
            '{{%company_category}}',
            'category'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-company_category-category}}',
            '{{%company_category}}',
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
        // drops foreign key for table `{{%company}}`
        $this->dropForeignKey(
            '{{%fk-company_category-company}}',
            '{{%company_category}}'
        );

        // drops index for column `company`
        $this->dropIndex(
            '{{%idx-company_category-company}}',
            '{{%company_category}}'
        );

        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-company_category-category}}',
            '{{%company_category}}'
        );

        // drops index for column `category`
        $this->dropIndex(
            '{{%idx-company_category-category}}',
            '{{%company_category}}'
        );

        $this->dropTable('{{%company_category}}');
    }
}
