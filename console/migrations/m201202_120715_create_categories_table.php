<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m201202_120715_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%categories}}', [
        'id' => $this->primaryKey(),
        'tree' => $this->integer()->notNull()->defaultValue(0),
        'lft' => $this->integer()->notNull(),
        'rgt' => $this->integer()->notNull(),
        'depth' => $this->integer()->notNull(),
        'name' => $this->string()->notNull(),
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
