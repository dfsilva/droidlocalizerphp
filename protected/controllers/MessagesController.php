<?php

class MessagesController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(Yii::app()->user->returnUrl);
	}

	public function actionSetaLanguage(){
		Yii::app()->session['lang'] = isset($_POST['lang']) ? $_POST['lang'] : 'pt';
		$this->redirect(isset($_POST['uri_page']) ? $_POST['uri_page'] :Yii::app()->request->baseUrl);
	}

}