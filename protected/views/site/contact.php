<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mess','Contact Us');
$this->breadcrumbs=array(Yii::t('mess','Contact Us'));
?>

<h2><?php echo Yii::t('mess','Contact Us')?></h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contactForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?= Yii::t('mess','Fields with')?> 
		<span class="required">*</span> <?= Yii::t('mess','are required')?>.</p>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>50,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="wrapper">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
		<div class="wrapper">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->textField($model,'verifyCode'); ?>
			</div>
			<div class="hint">Please enter the letters as they are shown in the image above.
			<br/>Letters are not case-sensitive.</div>
			<?php echo $form->error($model,'verifyCode'); ?>
		</div>
        <?php endif; ?>
        
	<div>
        <a class="button_form" href="#" onclick="jQuery('#contactForm').submit();">
            <?=Yii::t('mess','Send')?>
        </a>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form -->

