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
		array('initialDate, finalDate', 'date'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'initialDate'=>'Initial Date',
			'finalDate'=>'Final Date'
			);
	}
}