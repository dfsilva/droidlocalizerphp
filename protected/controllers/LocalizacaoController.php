<?php

class LocalizacaoController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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

	public function actionInserir(){
		header('Content-type: application/json');
		try {
			if(isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['id_usuario'])){
				$model = new Localizacao();
				$model->longitude = $_POST['longitude'];
				$model->latitude = $_POST['latitude'];
				$model->id_usuario = $_POST['id_usuario'];
				//$model->longitude = -48.0548019322028600;
				//$model->latitude = -15.8101495332429700;
				//$model->longitude = -48.0548019322028600;
				//$model->latitude = -15.8101495332429700;
				//$model->longitude = -48.054801;
				//$model->latitude = -15.810149;
				//$model->id_usuario = 2;
				$model->save();
				print '{"success":true, "message":"'.'longitude: '.$model->longitude.' latitude: '.$model->latitude.' usuario: '.$model->id_usuario.'"}';
			}else{
				print '{"success":false, "message":"Faltando parametros"}';
			}
		}catch(Exception $e) {
			print '{"success":false, "message":"'.$e->getMessage().'"}';
		}
	}

	public function actionBuscarMapa(){
		try {
			if(Yii::app()->request->isAjaxRequest){
				$model = new MapForm;

				if(isset($_POST['ajax']) && $_POST['ajax'] === 'mapForm'){
					echo CActiveForm::validate($model);
					Yii::app()->end();
				}

				$model->attributes = $_POST['MapForm'];
				if ($model->validate()) {
					$localizacoes = Localizacao::model()->findByIdUsuarioAndDate(Yii::app()->user->id, $model->initialDate, $model->finalDate);
					$coord = CJSON::encode($localizacoes);
					$this->renderPartial('mapa',array('model'=>$model, 'coord'=>$coord), false, true);
				}else{
					echo CActiveForm::validate($model);
					Yii::app()->end();
				}
			}
		}catch(Exception $e) {
			//throw new CHttpException(404,'The specified post cannot be found.');
			//throw new CHttpException(500, $e->getMessage());
			//echo $e->getMessage();
			Yii::app()->user->setFlash('info', Yii::t('mess', $e->getMessage()));
			$this->renderPartial('site/mapa',array('model'=>$model, 'coord'=>$coord), false,true);
			//$this->renderPartial('mapa',array('model'=>$model, 'coord'=>$coord), false,true);
		}

	}
}