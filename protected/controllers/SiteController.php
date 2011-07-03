<?php

class SiteController extends Controller {

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
		),
            'page' => array(
                'class' => 'CViewAction',
		),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$model = new MapForm;
		Yii::app()->session['menu'] = 1;
		$this->render('index', array('model' => $model));
	}

	public function actionBuscarMapa(){
		try {
			if(Yii::app()->request->isAjaxRequest){
				$model = new MapForm;

				$localizacoes = Localizacao::model()->findByIdUsuario(Yii::app()->user->id);

				$coord = json_encode($localizacoes);
				$this->renderPartial('mapa',array('model'=>$model, 'coord'=>$coord), false,true);
			}
		}catch(Exception $e) {
			//throw new CHttpException(404,'The specified post cannot be found.');
			//throw new CHttpException(500, $e->getMessage());
			//echo $e->getMessage();
			Yii::app()->user->setFlash('info', Yii::t('mess', $e->getMessage()));
			$this->renderPartial('mapa',array('model'=>$model, 'coord'=>$coord), false,true);
			//$this->renderPartial('mapa',array('model'=>$model, 'coord'=>$coord), false,true);
		}

	}

	public function actionAbout() {
		Yii::app()->session['menu'] = 2;
		$this->render('about');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {
					
				$message = new YiiMailMessage();
				$message->view = 'contact';
				$message->setTo(array(Yii::app()->params['adminEmail']=>'Diego Ferreira da Silva'));
				$message->setFrom(array($model->email=>$model->name));
				$message->setSubject('Contato - DroidLocalizer: '.$model->subject);
				$message->setBody(array('model' => $model), 'text/html');
					
				$numsent = Yii::app()->mail->send($message);
					
				Yii::app()->user->setFlash('info', Yii::t('mess', 'Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
			}
		}
		Yii::app()->session['menu'] = 3;
		$this->render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm;

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->login())
			$this->redirect(Yii::app()->request->baseUrl);
		}

		Yii::app()->session['menu'] = 4;
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Exibir a página de cadastro de usuário.
	 */
	public function actionCadastro() {

		$model = new Usuario('register');
		if (isset($_POST['Usuario'])) {
			$model->attributes = $_POST['Usuario'];
			if ($model->validate()) {
				if ($model->save()) {
					Yii::app()->user->setFlash('info', 'Cadastro efetuado com sucesso!');
					$this->refresh();
				} else {
					Yii::app()->user->setFlash('erro', 'Erro no cadastro!');
					$this->refresh();
				}
			}
		}
		Yii::app()->session['menu'] = 4;
		$this->render('cad_usuario', array('model' => $model));
	}

	/**
	 * Exibir a página para recuperar a senha do usuário.
	 */
	public function actionRecuperar() {
		$model = new RecoveryForm();
		if (isset($_POST['RecoveryForm'])) {
			$model->attributes = $_POST['RecoveryForm'];
		}
		Yii::app()->session['menu'] = 4;
		$this->render('recovery_password', array('model' => $model));
	}

}