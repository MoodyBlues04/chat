<?php

use app\models\UserData;
use yii\bootstrap4\Html;

?>
<div class="profile-main">
    <div class="profile-left">
        <div class="profile-picture">
            <img
                class="profile-icon"
                src= <?= Html::encode(UserData::getImgPath())  ?>
                alt=""
                border="0"
            >
            <a href="./upload-img" class="button-link">
                <button 
                    type="button"
                    class="change-icon btn btn-outline-primary"
                    
                >
                    Change icon
                </button>
            </a>
        </div>

        <div class="left-content">
            <a href="./edit" class="button-link">
                <button
                    type="button"
                    class="profile-edit btn btn-outline-primary"
                >
                    Редактировать
                </button>
            </a>
        </div>
    </div>

    <div class="profile-right">
        <h2><?= Html::encode($model->name) . ' ' . Html::encode($model->surname)?></h2>
        <p><?= Html::encode($model->introduction) ?></p>
        <div>some another information maybe (not users')</div>
    </div>
</div>

<div class="profile-content">
    <p>some other stuff (your wall)</p>
</div>