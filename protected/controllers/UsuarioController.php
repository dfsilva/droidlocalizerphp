<?php

class UsuarioController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Efetua login e retorna json.
	 */
	public function actionLoginJson() {
		header('Content-type: application/json');
		try {
			if(isset($_POST['login']) && isset($_POST['senha'])){
				$model = new LoginForm;
				$model->username = $_POST['login'];
				$model->password = $_POST['senha'];
				if ($model->validate() && $model->login()){
					print '{"success":true, "idUsuario":'.Yii::app()->user->id.'}';
				}else{
					print '{"success":false, "message":"User o password invalid."}';
				}
			}
		}catch(Exception $e) {
			print '{"success":false, "message":"'.$e->getMessage().'"}';
		}
	}

}