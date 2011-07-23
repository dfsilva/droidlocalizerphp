<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mess','Error');
$this->breadcrumbs=array(
	Yii::t('mess','Error'),
);
?>

<h2>Erro <?php echo $code; ?></h2>

<div class="error">
	<?php echo CHtml::encode($message); ?>	
</div>