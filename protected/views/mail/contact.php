<h2><?php echo Yii::t('mess','Contact Us')?></h2>

<div>
	<div>
		<?=Yii::t('mess', 'Name')?>:&nbsp;
		<?=$model->name;?>
	</div>

	<div>
		<?=Yii::t('mess', 'Email')?>:&nbsp;
		<?=$model->email;?>
	</div>

	<div>
		<?=Yii::t('mess', 'Subject')?>:&nbsp;
		<?=$model->subject;?>
	</div>

	<div>
		<?=Yii::t('mess', 'Message')?>:&nbsp;
		<?=$model->body;?>
	</div>
</div>

