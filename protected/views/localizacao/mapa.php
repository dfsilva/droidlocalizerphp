<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . '/js/markerwithlabel.js'?>"></script>
<script type="text/javascript">
  
  function criarMapa(){
	  var c = new google.maps.LatLng(-15.707663,-48.039552);
		 var myOptions = {
			      zoom: 4,
			      center: c,
			      mapTypeId: google.maps.MapTypeId.ROADMAP
			    };
	 var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }

  function popularMapa(coordenadas) {
		 var coo = coordenadas;

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
			    var marker = new MarkerWithLabel({
			    	position: obj,
			    	map: map,
			    	icon: (corr.length-1) == i ? null : 'images/mapmarker.png',
			    	labelContent: (corr.length-1) == i ? "Ultima posicao - "+coo[i].hora : "Posicao - "+(i+1)+" "+coo[i].hora,
			    	labelClass: "labels"
			    }); 
			});
			
			tracado = new google.maps.Polyline({
				path: corr,
				strokeColor: "#FF0000",
				//strokeOpacity: 0.8,
				strokeWeight: 1,
				map : map
			});
		  }
	 }
  
  function preConsulta(){
	  $("#div_mapa").mask("Buscando valores, aguarde...");
  }

  function posConsulta(data, result){
	  if(!data.success){
		$(".error_msg").text(data.error);
		$(".error_msg").show();
	  }else{
		 popularMapa(data.localizacoes);
	  }
	  $("#div_mapa").unmask();
  }
</script>
	<h2><?php echo Yii::t('mess','Map')?></h2>
	<div>
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
	                   array("success" => "posConsulta","beforeSend"=>"preConsulta","type"=>"POST"),
	                   array("href" => Yii::app()->createUrl("site/buscarMapa"),
	                   	"class" =>"button_form") 
	                   );
			 ?>
        </div>
	<?php $this->endWidget(); ?>
	</div>
	<div id="map_canvas" style="width:90%; height:400px; margin-left: 45px; border: 1px solid; margin-top: 40px;"></div>
	<script type="text/javascript">
		criarMapa();
	</script>