<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_to_categories}}`.
 */
class m201202_124715_create_news_to_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_to_categories}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news_to_categories}}');
    }
}
