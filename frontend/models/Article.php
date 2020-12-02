<?php

namespace frontend\models;

class Article extends \yii\db\ActiveRecord {
  public static function tableName() {
    return '{{%news}}';
  }

  public function getList() {
    return $this
      ->hasMany(Category::class, ['id' => 'category_id'])
      ->viaTable('news_to_categories', ['article_id' => 'id']);
  }
}
