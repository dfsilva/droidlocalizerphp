<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mess','Recovery Password');
$this->breadcrumbs=array(
	Yii::t('mess','Login')=>array('site/login'),
	Yii::t('mess','Recovery Password'),
);
?>

<h2><?php echo Yii::t('mess','Recovery Password')?></h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recovery-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?= Yii::t('mess','Fields with')?> 
		<span class="required">*</span> <?= Yii::t('mess','are required')?>.</p>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>80,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div style="margin-top: 20px;">
		<a class="button_form" href="#" onclick="jQuery('#recovery-form').submit();">
			<?=Yii::t('mess','Recovery Password')?>
		</a>
	</div>

<?php $this->endWidget(); ?>
</div>
