<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mess','Login');
$this->breadcrumbs=array(
	Yii::t('mess','Login'),
);
?>

<h2><?php echo Yii::t('mess','Login')?></h2>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?= Yii::t('mess','Fields with')?> 
		<span class="required">*</span> <?= Yii::t('mess','are required')?>.</p>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="wrapper">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div style="margin-top: 20px;">
		<a class="button_form" href="#" onclick="jQuery('#login-form').submit();">
			<?=Yii::t('mess','Login')?>
		</a>
		<a class="button_form" href="<?=Yii::app()->request->baseUrl."/site/cadastro";?>" style="margin-left: 50px;">
			<?=Yii::t('mess','Subscribe')?>
		</a>
		<a class="button_form" href="<?=Yii::app()->request->baseUrl."/site/recuperar"; ?>">
                        <?=Yii::t('mess','Recovery Password')?>
		</a>
	</div>

<? $this->endWidget(); ?>
</div>
