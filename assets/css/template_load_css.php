<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 8/28/15
 * Time: 4:43 p.m.
 */
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$doc->_scripts=null;
$site_name=JFactory::getApplication()->getCfg('sitename');
$baseurl=$this->baseurl;
/* Required Files */
JLoader::import('includes/defines.php');
JLoader::import('includes/framework.php');
require_once('components/com_content/models/articles.php');
$art= new ContentModelArticles();
$articles=$art->getItems();
$templateadress=$this->baseurl.'/assets';
$themepath_image=$templateadress.'/images';
//<!-- Theme style -->
$doc->addStyleSheet( $templateadress.'/css/AdminLTE.min.css');

$doc->addStyleSheet($templateadress. '/css/metro-bootstrap.css');
$doc->addStyleSheet($templateadress . '/css/metro-bootstrap-responsive.css');
$doc->addStyleSheet($templateadress . '/css/iconFont.css');
$doc->addStyleSheet($templateadress . '/css/docs.css');
$doc->addStyleSheet($templateadress . '/js/prettify/prettify.css');

 // <!-- Bootstrap 3.3.2 -->
$doc->addStyleSheet($templateadress . '/bootstrap/css/bootstrap.min.css');
// <!-- FontAwesome 4.3.0 -->
$doc->addStyleSheet($templateadress . '/font_awesome/css/font-awesome.css');
$doc->addStyleSheet($templateadress . '/font_awesome/css/font-awesome.min.css');

 //   <!-- Ionicons 2.0.0 -->
$doc->addStyleSheet($templateadress . '/ionicons/css/ionicons.min.css');
  //<!-- Theme style -->
  $doc->addStyleSheet($templateadress . '/admin/css/admin.min.css');
  //    <!-- AdminLTE Skins. Choose a skin from the css/skins
  //       folder instead of downloading all of them to reduce the load. -->
    $doc->addStyleSheet($templateadress . '/admin/css/skins/_all-skins.css');
	  //  <!-- iCheck -->
	  $doc->addStyleSheet($templateadress . '/bootstrap/plugins/iCheck/flat/blue.css');
	  $doc->addStyleSheet($templateadress . '/bootstrap/plugins/iCheck/all.css');
	      //<!-- Morris chart -->
		  $doc->addStyleSheet($templateadress . '/bootstrap/plugins/morris/morris.css');
  // <!-- jvectormap -->
	 $doc->addStyleSheet($templateadress . '/bootstrap/plugins/jvectormap/jquery-jvectormap-1.2.2.css');
	

	
    //<!-- Date Picker -->	  
	$doc->addStyleSheet($templateadress . '/bootstrap/plugins/datepicker/datepicker3.css');
	 //   <!-- Daterange picker -->
	 $doc->addStyleSheet($templateadress . '/bootstrap/plugins/daterangepicker/daterangepicker-bs3.css');
	   //  <!-- bootstrap wysihtml5 - text editor -->
	 $doc->addStyleSheet($templateadress . '/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
   // <!--    Kendo-->
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.common.min.css');
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.bootstrap.min.css');
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.rtl.min.css');
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.dataviz.min.css ');
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.dataviz.default.min.css ');
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.dataviz.metro.min.css');
   $doc->addStyleSheet($templateadress . '/kendo/styles/kendo.default.min.css');
      //<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   // <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
//Theme style
   $doc->addStyleSheet($templateadress . '/admin/css/AdminLTE.min.css');
//<!-- AdminLTE Skins. Choose a skin from the css/skins
    // folder instead of downloading all of them to reduce the load. -->

$doc->addStyleSheet($templateadress . '/admin/css/skins/_all-skins.min.css');


/*
$doc->addStyleSheet($templateadress .'/includes/css/style.css');
$doc->addStyleSheet($templateadress .' /includes/css/social-icons.css');
$doc->addStyleSheet($templateadress .'/includes/css/website.css');
$doc->addStyleSheet($templateadress .'/includes/css/basic.css');*/







