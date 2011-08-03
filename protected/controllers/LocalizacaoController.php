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

	/**
	 *Acao para inserir uma localizacao 
	 */
	public function actionInserir(){
		header('Content-type: application/json');
		try {
			if(isset($_POST['longitude']) && isset($_POST['latitude']) && isset($_POST['id_usuario'])){
				$model = new Localizacao();
				$model->longitude = $_POST['longitude'];
				$model->latitude = $_POST['latitude'];
				$model->id_usuario = $_POST['id_usuario'];
				$model->save();
				print '{"success":true, "message":"'.'longitude: '.$model->longitude.' latitude: '.$model->latitude.' usuario: '.$model->id_usuario.'"}';
			}else{
				print '{"success":false, "message":"Faltando parametros"}';
			}
		}catch(Exception $e) {
			print '{"success":false, "message":"'.$e->getMessage().'"}';
		}
	}
	/**
	 * Acao para atualizar uma determinada localizacao.
	 */	
	public function actionAtualizar(){
		header('Content-type: application/json');
		try {
			if(isset($_POST['longitude']) && isset($_POST['latitude']) 
				&& isset($_POST['id_localizacao']) && isset($_POST['id_usuario'])){
				$model = Localizacao::model()->findByPk($_POST['id_localizacao']);;
				$model->longitude = $_POST['longitude'];
				$model->latitude = $_POST['latitude'];
				$model->update();
				print '{"success":true, "message":"'.'longitude: '.$model->longitude.' latitude: '.$model->latitude.' usuario: '.$model->id_usuario.'"}';
			}else{
				print '{"success":false, "message":"Faltando parametros"}';
			}
		}catch(Exception $e) {
			print '{"success":false, "message":"'.$e->getMessage().'"}';
		}
	}

	/**
	 * Acao para obter a ultima posicao para um determinado usuario
	 */
	public function actionLastPosition(){
		header('Content-type: application/json');
		try {
			if(isset($_POST['id_usuario'])){
				$localizacao = Localizacao::model()->findLasUpdateByUser($_POST['id_usuario']);
				print CJSON::encode(array("success"=>true, 'localizacao' => $localizacao));
			}else{
				print '{"success":false, "message":"Faltando id do usuario"}';
			}
		}catch(Exception $e) {
			print '{"success":false, "message":"'.$e->getMessage().'"}';
		}
	}

	/**
	 * Acao para buscar os valores do mapa.
	 */
	public function actionBuscarMapa(){
		header('Content-type: application/json');
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
					foreach ($localizacoes as &$value) {
						$value['hora'] = Yii::app()->dateFormatter->format('dd/MM/yyyy H:mm:ss', CDateTimeParser::parse($value['hora'],'yyyy-MM-dd H:mm:ss'));
					}
					print CJSON::encode(array("success"=>true, 'localizacoes' => $localizacoes));
				}else{
					print CJSON::encode(array("success"=>false, 'error' => "Erro de validacao.", 'localizacoes' =>''));
				}
			}
		}catch(Exception $e) {
			print CJSON::encode(array("success"=>false, 'error' => "Excessao: ".$e->getMessage(), 'localizacoes' =>''));
		}

	}
}