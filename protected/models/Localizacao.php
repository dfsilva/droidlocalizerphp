<?php

/**
 * This is the model class for table "tb_localizacao".
 *
 * The followings are the available columns in table 'tb_localizacao':
 * @property integer $id_localizacao
 * @property string $longitude
 * @property string $latitude
 * @property string $hora
 * @property integer $id_usuario
 *
 * The followings are the available model relations:
 * @property TbUsuario $idUsuario
 */
class Localizacao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Localizacao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_localizacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('longitude, latitude, id_usuario', 'required'),
		array('id_usuario', 'numerical', 'integerOnly'=>true),
		array('longitude, latitude', 'length', 'max'=>20),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id_localizacao, longitude, latitude, id_usuario', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idUsuario' => array(self::BELONGS_TO, 'TbUsuario', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_localizacao' => 'Id Localizacao',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
			'hora' => 'Hora',
			'id_usuario' => 'Id Usuario',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_localizacao',$this->id_localizacao);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('id_usuario',$this->id_usuario);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function findByIdUsuarioAndDate($idUsuario, $dataInicial, $dataFinal){
		$dataIni = Yii::app()->dateFormatter->format('yyyy-MM-dd', CDateTimeParser::parse($dataInicial,'dd/MM/yyyy'));
		$dataFin = Yii::app()->dateFormatter->format('yyyy-MM-dd', CDateTimeParser::parse($dataFinal,'dd/MM/yyyy'));
		
		$dataIni = $dataIni.' 00:00:00';
		$dataFin = $dataFin.'23:59:59';
		
		return Yii::app()->db->createCommand()
		->select('longitude, latitude, hora')
		->from($this->tableName())
		->where('id_usuario=:id and hora >= :dataInicial and hora <= :dataFinal',
		array(':id'=> $idUsuario ? $idUsuario : Yii::app()->user->id, ':dataInicial'=> $dataIni, ':dataFinal'=> $dataFin))
		->queryAll();
	}
	
	public function findLasUpdateByUser($idUsuario){
		return Yii::app()->db->createCommand()
		->select('id_localizacao, longitude, latitude, hora')
		->from($this->tableName())
		->where('id_usuario=:id', array(':id'=> $idUsuario ? $idUsuario : Yii::app()->user->id))
		->order(array('hora desc'))
		->limit(1)
		->queryAll();
	}

	public function beforeSave() {
		$this->hora = new CDbExpression('NOW()');
		return parent::beforeSave();
	}
}