<?php

class MessagesController extends Controller
{
	public function actionIndex()
	{
		$this->redirect(Yii::app()->user->returnUrl);
	}


	public function actionSetaLanguage(){
		//Yii::app()->session['_lang'] = $_POST['_lang'];
		Yii::app()->session['lang'] = isset($_POST['lang']) ? $_POST['lang'] : 'pt';
		$this->redirect(isset($_POST['uri_page']) ? $_POST['uri_page'] :Yii::app()->request->baseUrl);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
	// return the filter configuration for this controller, e.g.:
	return array(
	'inlineFilterName',
	array(
	'class'=>'path.to.FilterClass',
	'propertyName'=>'propertyValue',
	),
	);
	}

	public function actions()
	{
	// return external action classes, e.g.:
	return array(
	'action1'=>'path.to.ActionClass',
	'action2'=>array(
	'class'=>'path.to.AnotherActionClass',
	'propertyName'=>'propertyValue',
	),
	);
	}
	*/
}