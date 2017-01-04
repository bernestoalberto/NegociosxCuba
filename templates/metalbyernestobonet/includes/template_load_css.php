<?php
/**
 * Created by PhpStorm.
 * User: Ernesto
 * Date: 10/3/2016
 * Time: 12:00 p.m.
 */
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$doc->_scripts=null;
$site_name=JFactory::getApplication()->getCfg('sitename');
$baseurl=$this->baseurl;
/* Required Files */

//require_once('components/com_content/models/articles.php');
//$art= new ContentModelArticles();
//$articles=$art->getItems();
$templateadress=$this->baseurl.'/templates/'.$this->template.'/assets';
$themepath_image=$templateadress.'/images';



$doc->addStyleSheet($templateadress. '/img/favicon.ico','shortcut icon');



//  <!-- Font -->
$doc->addStyleSheet($templateadress. '/css/arimo.css','stylesheet');
$doc->addStyleSheet($templateadress. '/css/oswald.css','stylesheet');

//  <!-- Font Awesome Icons -->
$doc->addStyleSheet($templateadress. '/css/font-awesome.min.css','stylesheet');

//   <!-- Bootstrap core CSS -->
$doc->addStyleSheet($templateadress. '/css/bootstrap.min.css','stylesheet');
$doc->addStyleSheet($templateadress. '/css/hover-dropdown-menu.css','stylesheet');


//  <!-- Icomoon Icons -->
$doc->addStyleSheet($templateadress. '/css/icons.css','stylesheet');


//   <!-- Revolution Slider -->
$doc->addStyleSheet($templateadress. '/css/revolution-slider.css','stylesheet');
$doc->addStyleSheet($templateadress. '/css/settings.css','stylesheet');


//   <!-- Animations -->
$doc->addStyleSheet($templateadress. '/css/animate.min.css','stylesheet');


//    <!-- Owl Carousel Slider -->
$doc->addStyleSheet($templateadress. '/css/owl/owl.carousel.css','stylesheet');
$doc->addStyleSheet($templateadress. '/css/owl/owl.theme.css','stylesheet');
$doc->addStyleSheet($templateadress. '/css/owl/owl.transitions.css','stylesheet');


      //  <!-- PrettyPhoto Popup -->
$doc->addStyleSheet($templateadress. '/css/prettyPhoto.css','stylesheet');

     //   <!-- Custom Style -->
$doc->addStyleSheet($templateadress. '/css/style.css','stylesheet');
$doc->addStyleSheet($templateadress. '/css/responsive.css','stylesheet');

      //  <!-- Color Scheme -->
$doc->addStyleSheet($templateadress. '/css/color.css','stylesheet');



	 ?>






