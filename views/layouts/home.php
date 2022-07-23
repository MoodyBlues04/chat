<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\ActiveForm;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="https://unpkg.com/flexboxgrid2@7.2.1/flexboxgrid2.min.css">
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <header>
            <div class="search">
                there is search line (for users)
            </div>
            
            <div class="user">
            <?php
            // устанавливаем первый и последний год диапазона
            $yearArray = range(2000, 2005);
            ?>
            <!-- выводим выпадающий список -->
            <select name="year">
                <option value="">Выберите год</option>
                <?php
                foreach ($yearArray as $year) {
                    // если вы хотите выбрать конкретный год
                    $selected = ($year == 2015) ? 'selected' : '';
                    echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                }
                ?>
            </select>            
                user icon & drop down list
            </div>
        </header>
        <main>
            <div class="links">
                <a href="" class="link">main</a>
                <a href="#1" class="link">feature 1</a>
                <a href="#2" class="link">feature 2</a>
                <a href="#3" class="link">feature 3</a>
                <a href="#4" class="link">feature 4</a>
                <a href="#5" class="link">feature 5</a>
                <a href="#6" class="link">feature 6</a>
            </div>
            <div class="content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>