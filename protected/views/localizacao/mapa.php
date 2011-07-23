<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

<script type="text/javascript">
  function initialize() {
	 var coo = <?= isset($coord) ? $coord : '[]'?>;

	 if(coo != ''){
		 var corr = new Array();

		jQuery.each(coo, function(i, obj){
		  corr[i] = new google.maps.LatLng(obj.latitude, obj.longitude);
		});

		var myOptions = {
	      zoom: 10,
	      center: corr[0],
	      mapTypeId: google.maps.MapTypeId.ROADMAP
		};

	    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	    jQuery.each(corr, function(i, obj){
		    var marker = new google.maps.Marker({
		    	position: obj,
		    	map: map,
		    	icon: i == (corr.length-1) ? '' : '<?=Yii::app()->baseUrl?>/images/mapmarker.png',
		    	title: i == (corr.length-1) ? "Ultima posicao" : "Posicao - "+(i+1)
		    }); 
		});
		
		tracado = new google.maps.Polyline({
			path: corr,
			strokeColor: "#FF0000",
			strokeOpacity: 0.8,
			strokeWeight: 2,
			map : map
		});
	  }else{
	  	 var c = new google.maps.LatLng(-15.707663,-48.039552);
		 var myOptions = {
			      zoom: 4,
			      center: c,
			      mapTypeId: google.maps.MapTypeId.ROADMAP
			    };
	     var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	  }

}
</script>
	<h2><?php echo Yii::t('mess','Map')?></h2>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'mapForm',
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		));?>

		<?php echo $form->errorSummary($model); ?>
		
		<div style="float: right; display: inline;">
			<div class="form_2" style="display: inline-block; height: 34px; padding-top: 6px; padding-right: 20px;">
				<?php echo $form->labelEx($model,'initialDate'); ?>
				<? $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name'=>'MapForm[initialDate]',
                            'value'=>$model->initialDate,
                            //'language'=>'pt-BR',
                            'options'=>array(
                                    'showAnim'=>'fold',
                        			'dateFormat'=>'dd/mm/yy'),
						 'htmlOptions' => array('onkeydown'=>'return false;')
						));
				?>
				
				<?php echo $form->labelEx($model,'finalDate'); ?>
				<? $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name'=>'MapForm[finalDate]',
                            'value'=>$model->finalDate,
                            //'language'=>'br',
                            'options'=>array(
										'showAnim'=>'fold',
										'dateFormat'=>'dd/mm/yy'),
							'htmlOptions' => array('onkeydown'=>'return false;')
							));
				?>
			</div>
			 <?= CHtml::ajaxLink(
	                   Yii::t('mess','Send'),
	                   Yii::app()->createUrl("localizacao/buscarMapa"),
	                   array("update" => "#div_mapa","type"=>"POST"),
	                   array("href" => Yii::app()->createUrl("site/buscarMapa"),
	                   		"class" =>"button_form") 
	                   );
				 ?>
        </div>
	<?php $this->endWidget(); ?>

	<div id="map_canvas" style="width:90%; height:400px; margin-left: 45px;"></div>
 
	<script type="text/javascript">
		initialize();
	</script>