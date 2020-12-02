<?php

namespace frontend\models;

use creocoder\nestedsets\NestedSetsBehavior;

class Category extends \yii\db\ActiveRecord {
  public static function tableName() {
    return '{{%categories}}';
  }

  public function behaviors() {
    return [
      'tree' => [
        'class' => NestedSetsBehavior::class,
        'treeAttribute' => 'tree',
        // 'leftAttribute' => 'lft',
        // 'rightAttribute' => 'rgt',
        // 'depthAttribute' => 'depth',
      ],
    ];
  }

  public function transactions() {
    return [
      self::SCENARIO_DEFAULT => self::OP_ALL,
    ];
  }

  public static function find() {
    return new CategoryQuery(get_called_class());
  }

  public function getList() {
    return $this
      ->hasMany(Article::class, ['id' => 'article_id'])
      ->viaTable('news_to_categories', ['category_id' => 'id']);
  }
}
