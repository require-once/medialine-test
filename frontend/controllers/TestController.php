<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Category;
use Yii;
use yii\web\Response;

class TestController extends Controller {
  public function actionIndex() {
/*
    $categories = new Category(['name' => 'Общество']);
    $categories->makeRoot();

    $cityLife = new Category(['name' => 'городская жизнь']);
    $cityLife->prependTo($categories);

    $election = new Category(['name' => 'выборы']);
    $election->appendTo($categories);


    $categories2 = new Category(['name' => 'День города']);
    $categories2->makeRoot();

    $fireworks = new Category(['name' => 'фейерверки']);
    $fireworks->appendTo($categories2);

    $playground = new Category(['name' => 'детская площадка']);
    $playground->appendTo($categories2);
*/

/*
    $roots = Category::find()->roots()->all();
    var_dump($roots);

    $leaves = Category::find()->leaves()->all();
    var_dump($leaves);
*/


    $categories = Category::findOne(['name' => 'фейерверки']);
    $parent = $categories->parents(1)->one();
    var_dump($parent);

  }

  public function actionGetNews() {
    $articles = [];

    // echo 'Все новости указанной рубрики:<br/><br/>';
    $cat = Category::findOne(1);
    $articles[] = $cat->list;

    // echo '<br/>Новости вложенных рубрик:<br/>';
    $leaves = $cat->leaves()->all();

    foreach ($leaves as $child) {
      $catIn = Category::findOne($child->id);
      $articles[] = $catIn->list;
      // var_dump($catIn->list);
    }

    Yii::$app->response->format = Response::FORMAT_JSON;
    return $articles;
  }
}
