<?php
use \yii\helpers\Url;
Yii::$app->response->redirect(Url::to(['/user/auth/login'], true));
?>
