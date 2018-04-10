<?php
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use humhub\modules\user\widgets\AuthChoice;
use humhub\models\Setting;


$this->pageTitle = Yii::t('UserModule.views_auth_login', 'Login');
?>
<div class="container-fluid">
  <div class="topbar backgroundPrimary">
	<div class="row">
		<div class="col-lg-1 col-xs-1"></div>
		<div class="col-md-7">
			<?php
					$baseUrl = Yii::$app->settings->get('baseUrl') . '/uploads/logo_image/logo.png?cacheId=0';
			?>
			 <img style="margin:5px auto 0px auto;" src="<?php echo $baseUrl?>"/>
		</div>
	</div>
  </div>
  <div class="row">
	<div class="well well-lg clearfix">
		<div class="col-lg-1 visible-lg"></div>
		<div class="col-lg-3 col-lg-push-7 col-sm-5 col-sm-push-7 col-xs-12">
		  <!--tab inicio sesión-->
		  <div class="panel panel-default animated bounceIn" id="login-form">
			<br/>
			<?php if ($canRegister) : ?>
			<div class="text-center">
					  <h4><strong>Únete</strong> a la comunidad</h4>
					  <br/>
			  <ul id="tabs" class="nav nav-tabs tabs-center" data-tabs="tabs">
				<li class="<?php echo (!isset($_POST['Invite'])) ? "active" : ""; ?> tab-login">
				  <a
					 href="#login"
					 data-toggle="tab">
					<?php echo Yii::t('SpaceModule.views_space_invite', 'Login'); ?>
				  </a>
				</li>
				<li class="<?php echo (isset($_POST['Invite'])) ? "active" : ""; ?> tab-register">
				  <a
					 href="#register"
					 data-toggle="tab">
					<?php echo Yii::t('SpaceModule.views_space_invite', 'New user?'); ?>
				  </a>
				</li>
			  </ul>
			</div>
			<br/>
			<?php endif; ?>
			<div class="tab-content">
			  <!--TAB INICIO DE SESIÓN-->
			  <div class="tab-pane <?php echo (!isset($_POST['Invite'])) ? "active" : ""; ?>" id="login">
				<div class="panel-body">
				  <?php if (Yii::$app->session->hasFlash('error')): ?>
				  <div class="alert alert-danger" role="alert">
					<?= Yii::$app->session->getFlash('error') ?>
				  </div>
				  <?php endif; ?>
				  <?php if(AuthChoice::hasClients()): ?>
				  <?= AuthChoice::widget([]) ?>
				  <?php else: ?>
				  <p>
					<?php echo Yii::t('UserModule.views_auth_login', "If you're already a member, please login with your username/email and password."); ?>
				  </p>
				  <?php endif; ?>
				  <?php $form = ActiveForm::begin(['id' => 'account-login-form', 'enableClientValidation' => false]); ?>
				  <?php echo $form->field($model, 'username')->textInput(['id' => 'login_username', 'placeholder' => $model->getAttributeLabel('username')])->label(false); ?>
				  <?php echo $form->field($model, 'password')->passwordInput(['id' => 'login_password', 'placeholder' => $model->getAttributeLabel('password')])->label(false); ?>
				  <?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
				  <hr>
				  <div class="row">
					<div class="col-md-4">
					  <?php echo CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Sign in'), array('id' => 'login-button', 'data-ui-loader' => "", 'class' => 'btn btn-large btn-primary')); ?>
					</div>
					<div class="col-md-8 text-right">
					  <small>
						<a
						   href="<?php echo Url::toRoute('/user/password-recovery'); ?>">
						  <br>
							<?php echo Yii::t('UserModule.views_auth_login', 'Forgot your password?'); ?>
						</a>
					  </small>
					</div>
				  </div>
				  <?php ActiveForm::end(); ?>
				</div>
			  </div>
			  <!--FIN TAB INICIO DE SESIÓN-->
			  <!--TAB REGISTRATE-->
			  <div class="tab-pane <?php echo (isset($_POST['Invite'])) ? "active" : ""; ?>" id="register">
				<?php if ($canRegister) : ?>
				<div id="register-form">
				  <div class="panel-body">
					<?php echo Yii::t('UserModule.views_auth_login', "Don't have an account? Join the network by entering your e-mail address."); ?>
					<?php $form = ActiveForm::begin(['id' => 'invite-form']); ?>
					<br/>
					<?php echo $form->field($invite, 'email')->input('email', ['id' => 'register-email', 'placeholder' => Yii::t('UserModule.views_auth_login', 'email')]); ?>
					<hr>
					<?php echo CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Register'), array('class' => 'btn btn-primary', 'data-ui-loader' => '')); ?>
					<?php ActiveForm::end(); ?>
				  </div>
				</div>
				<?php endif; ?>
			  </div>
			  <!--FIN TAB REGISTRATE-->
			</div>
		  </div>
			<div class="visible-lg visible-md">
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
			</div>
		</div>
		<div class="col-lg-7 col-lg-pull-3 col-sm-7 col-sm-pull-5 col-xs-12">
		<?php if (Yii::$app->hasModule('tctp') && Yii::$app->getModule('tctp')->settings->get('tctp.hp.bienvenida.habilitado') == 1) :	?>
			<div class="panel panel-default">
					<div class="panel-body text-center">
						<?php echo Setting::Get('tctp.hp.bienvenida.html', 'tctp');		?>
					</div>
				</div>
			<?php endif; ?>
			<?php
					if (Yii::$app->getModule('user')->settings->get('auth.allowGuestAccess') == 1) {
               			echo \humhub\modules\content\widgets\Stream::widget([
									'streamAction' => '//dashboard/dashboard/stream',
									'showFilters' => false,
									'messageStreamEmpty' => Yii::t('DashboardModule.views_dashboard_index_guest', '<b>No public contents to display found!</b>'),
							]);
					}
			?>
		</div>
		<div class="col-lg-1 visible-lg"></div>
	</div>
  </div>
  <br>
  <?= humhub\widgets\LanguageChooser::widget(); ?>
</div>
<script type="text/javascript">
  $(function () {
    // set cursor to login field
    $('#login_username').focus();
  }
   )
  // Shake panel after wrong validation
    <?php if ($model->hasErrors()) {
      ?>
        $('#login-form').removeClass('bounceIn');
      $('#login-form').addClass('shake');
      $('#register-form').removeClass('bounceInLeft');
      $('#app-title').removeClass('fadeIn');
      <?php }
  ?>
    // Shake panel after wrong validation
    <?php if ($invite->hasErrors()) {
      ?>
        $('#register-form').removeClass('bounceInLeft');
      $('#register-form').addClass('shake');
      $('#login-form').removeClass('bounceIn');
      $('#app-title').removeClass('fadeIn');
      <?php }
  ?>
</script>
