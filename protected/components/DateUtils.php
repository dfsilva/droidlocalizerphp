<?php
class DateUtils{
	public static function formatDataBase($dataStr){
		return Yii::app()->dateFormatter->format('yyyy-MM-dd', CDateTimeParser::parse($dataStr,'dd/MM/yyyy'));
	}
}