<?php $this->pageTitle=Yii::app()->name; ?>

<?php if(!Yii::app()->user->isGuest){ ?>
	<div id="div_mapa">
		<?php $this->renderPartial('//localizacao/mapa', array('model'=>$model), false, true);?>
	</div>
<?php }?>

		

