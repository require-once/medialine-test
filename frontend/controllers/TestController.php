<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Category;
use Yii;
use yii\web\Response;

class TestController extends Controller {
  public function actionIndex() {
/*
    $society = new Category(['name' => 'Общество']);
    $society->makeRoot();

    $cityLife = new Category(['name' => 'городская жизнь']);
    $cityLife->prependTo($society);

    $election = new Category(['name' => 'выборы']);
    $election->appendTo($society);


    $dayOfCity = new Category(['name' => 'День города']);
    $dayOfCity->makeRoot();

    $fireworks = new Category(['name' => 'фейерверки']);
    $fireworks->appendTo($dayOfCity);

    $playground = new Category(['name' => 'детская площадка']);
    $playground->appendTo($dayOfCity);
*/

/*
    $election = Category::findOne(['name' => 'выборы']);

    $president = new Category(['name' => 'президенсткие']);
    $president->appendTo($election);

    $local = new Category(['name' => 'муниципальные']);
    $local->appendTo($election);
*/

    $categories = [];

    $roots = Category::find()->roots()->all();
    foreach ($roots as $category) {
      $categories[] = $category;
    }

    $leaves = Category::find()->leaves()->all();
    foreach ($leaves as $leaf) {
      $categories[] = $leaf;
    }

    Yii::$app->response->format = Response::FORMAT_JSON;
    return $categories;
  }

  public function actionGetNews($category_id) {
    $articles = [];

    // Все новости указанной рубрики
    $cat = Category::findOne($category_id);
    if (count($cat->list) > 0) {
      $articles[] = $cat->list;
    }

    // Новости вложенных рубрик
    $leaves = $cat->leaves()->all();

    foreach ($leaves as $child) {
      $catIn = Category::findOne($child->id);
      if (count($catIn->list) > 0) {
        $articles[] = $catIn->list;
      }
    }

    Yii::$app->response->format = Response::FORMAT_JSON;
    return $articles;
  }
}
