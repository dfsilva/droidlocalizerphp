<?php

class MapForm extends CFormModel
{
	public $initialDate;
	public $finalDate;


	public function init()
	{
		parent::init();
		$this->initialDate = date("d/m/Y");
		$this->finalDate = date("d/m/Y");
		
	}

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('initialDate, finalDate', 'date', 'format' => 'dd/MM/yyyy', 'enableClientValidation'=> true, 'allowEmpty'=>false),
		);
	}

	public function attributeLabels()
	{
		return array(
			'initialDate' => Yii::t('mess', 'Initial Date'),
			'finalDate' => Yii::t('mess', 'Final Date'),
			);
	}
}