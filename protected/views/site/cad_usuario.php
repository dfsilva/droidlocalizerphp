<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mess','Subscribe');
$this->breadcrumbs=array(
	Yii::t('mess','Login')=>array('site/login'),
	Yii::t('mess','Subscribe'),
);
?>

<h2><?php echo Yii::t('mess','Subscribe')?></h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cad-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?= Yii::t('mess','Fields with')?> 
		<span class="required">*</span> <?= Yii::t('mess','are required')?>.</p>
        
	<div class="wrapper">
		<?php echo $form->labelEx($model,'nome_usuario'); ?>
		<?php echo $form->textField($model,'nome_usuario',array('size'=>80,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nome_usuario'); ?>
	</div>
	
	<div class="wrapper">
		<?php echo $form->labelEx($model,'email_usuario'); ?>
		<?php echo $form->textField($model,'email_usuario',array('size'=>80,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email_usuario'); ?>
	</div>
	
	<div class="wrapper">
		<?php echo $form->labelEx($model,'senha_usuario'); ?>
		<?php echo $form->passwordField($model,'senha_usuario',array('size'=>20,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'senha_usuario'); ?>
	</div>
	
	<div class="wrapper">
		<?php echo $form->labelEx($model,'senha_usuario_repeat'); ?>
		<?php echo $form->passwordField($model,'senha_usuario_repeat', array('size'=>20,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'senha_usuario_repeat'); ?>
	</div>
	
	<div style="margin-top: 20px;">
		<a class="button_form" href="#" onclick="jQuery('#cad-form').submit();">
           <?=Yii::t('mess','Subscribe')?>
        </a>
	</div>
<?php $this->endWidget(); ?>
</div>
