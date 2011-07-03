<?php

/**
 * This is the model class for table "tb_perfil".
 *
 * The followings are the available columns in table 'tb_perfil':
 * @property integer $id_perfil
 * @property string $nome_perfil
 *
 * The followings are the available model relations:
 * @property TbUsuario[] $tbUsuarios
 */
class Perfil extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Perfil the static model class
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
		return 'tb_perfil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome_perfil', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_perfil, nome_perfil', 'safe', 'on'=>'search'),
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
			'tbUsuarios' => array(self::HAS_MANY, 'TbUsuario', 'id_perfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_perfil' => 'Id Perfil',
			'nome_perfil' => 'Nome Perfil',
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

		$criteria->compare('id_perfil',$this->id_perfil);
		$criteria->compare('nome_perfil',$this->nome_perfil,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}