<?php
$this->pageTitle = Yii::t('UserModule.views_auth_register_success', 'Registration successful');
?>
<div class="container" style="text-align: center;">
    <?= humhub\widgets\SiteLogo::widget(['place' => 'login']); ?>
    <br>
    <div class="row">
        <div class="panel panel-default" style="max-width: 300px; margin: 0 auto 20px; text-align: left;">
            <div class="panel-heading"><?php echo Yii::t('TctpModule.base', '<strong>¡Falta poco!</strong> Comprueba tu correo.'); ?></div>
            <div class="panel-body">
                <p><?php echo Yii::t('TctpModule.base', 'Por favor, verifica tu correo electrónico y haz click en el botón <strong>"Regístrate ahora"</strong>.'); ?></p>
                <br/>
                <a href="<?php echo \yii\helpers\Url::to(["/"]) ?>" class="btn btn-primary"><?php echo Yii::t('UserModule.views_auth_register_success', 'back to home') ?></a>
            </div>
        </div>
    </div>
</div>



