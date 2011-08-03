<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo CHtml::encode($this->pageTitle);?></title>
<meta charset="utf-8">

<link rel="shortcut icon" href="<?=Yii::app()->request->baseUrl; ?>/images/favicon.ico" />

<?php 
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl . '/css/reset.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/layout.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/style.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/form.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.loadmask.css');

$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/cufon-yui.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/cufon-replace.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/Avenir_900.font.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/Avenir_300.font.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/Avenir_500.font.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.loadmask.js', CClientScript::POS_HEAD);
?>

<!--[if lt IE 9]>
	<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
<![endif]-->
</head>
<body id="page5">
<div class="main">
	<div class="body1"></div>
	<header>
		<div class="wrapper">
			<h1><a href="<?php echo Yii::app()->request->baseUrl; ?>" id="logo">Android Localizer</a></h1>
			<nav>
				<ul id="menu">
					<li class="<?php echo (isset(Yii::app()->session['menu']) && Yii::app()->session['menu'] == 1) ? 'menu_active' : '';?>">
						<a href="<?php echo Yii::app()->request->baseUrl;?>"><?php echo Yii::t('mess','Home')?></a>
					</li>
					<li class="<?php echo (isset(Yii::app()->session['menu']) && Yii::app()->session['menu'] == 2) ? 'menu_active' : '';?>">
						<a href="<?php echo Yii::app()->request->baseUrl."/site/about"; ?>"><?php echo Yii::t('mess','About')?></a>
					</li>
					<li class="<?php echo (isset(Yii::app()->session['menu']) && Yii::app()->session['menu'] == 3) ? 'menu_active' : '';?>">
						<?php echo CHtml::link(Yii::t('mess','Contact Us'), Yii::app()->request->baseUrl.'/site/contact'); ?>
					</li>
					<li class="<?php echo (isset(Yii::app()->session['menu']) && Yii::app()->session['menu'] == 4) ? 'menu_active' : '';?>">
						<?php echo Yii::app()->user->isGuest ?
							CHtml::link(Yii::t('mess','Login'), Yii::app()->request->baseUrl.'/site/login'):
							CHtml::link('Logout ('.Yii::app()->user->name.')', Yii::app()->request->baseUrl.'/site/logout');
						?>
					</li>
				</ul>
			</nav>
		</div>
		
		<div id="banner">
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?>
			<?php endif?>
			
			<div style="float: right; margin-right: 10px; position: relative; z-index: 200;">
				<form id="formLanguage" method="post"
					action="<?php echo Yii::app()->request->baseUrl; ?>/messages/setaLanguage">
						<input type="hidden" value="en" name="lang" id="lang"/>
						<input type="hidden" value="<?= Yii::app()->request->requestUri; ?>" name="uri_page" id="uri_page"/>
						<a onclick="jQuery('#lang').val('pt'); jQuery('#formLanguage').submit(); return false;" href="#"
							title="<?php echo Yii::t('mess','Brazil')?>">
							<img height="32" width="32" alt="<?php echo Yii::t('mess','Brazil')?>" 
								src="<?php echo Yii::app()->request->baseUrl; ?>/images/br_flag.png">
						</a>
						&nbsp;
						<a onclick="jQuery('#_lang').val('en'); jQuery('#formLanguage').submit(); return false;" href="#"
							title="<?php echo Yii::t('mess','United States')?>">
							<img height="32" width="32" alt="<?php echo Yii::t('mess','United States')?>" 
								src="<?php echo Yii::app()->request->baseUrl; ?>/images/us_flag.png">
						</a>
				</form>
			</div>
			
			<div class="text">
				<h1>Fique tranquilo! <span>Seu Android est&aacute; seguro.</span></h1>
			</div>
		</div>
	</header>
	<section id="content">
		<div class="wrapper" id="divContent">
			
			<div class="info_msg" style="display: <?=Yii::app()->user->hasFlash('info') ? '' : 'none'?>;">
			  <?php echo Yii::app()->user->getFlash('info'); ?>
		    </div>
		    
		    <div class="error_msg" style="display: <?=Yii::app()->user->hasFlash('error') ? '' : 'none'?>;">
		       <?php echo Yii::app()->user->getFlash('error'); ?>
		    </div>
			
            <article class="col1 pad_left1">
			</article>
			<article class="width_100perc">
			    <!-- ?php echo $content; ?-->
			    <div class="container">
					<div id="content">
						<?php echo $content; ?>
					</div>
				</div>
			</article>
		</div>
	</section>
	<footer>
		<div style="text-align: center;">
			Copyright &copy; <?php echo date('Y'); ?> by DiegoSilva.<br/>All Rights Reserved.<br/>
		</div>
	</footer>
</div>
</body>
</html>