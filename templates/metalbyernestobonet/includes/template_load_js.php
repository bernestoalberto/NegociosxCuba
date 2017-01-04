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
/*JLoader::import('includes/defines.php');
JLoader::import('includes/framework.php');*/
require_once('components/com_content/models/articles.php');
$art= new ContentModelArticles();
$articles=$art->getItems();
$templateadress=$this->baseurl.'/templates/'.$this->template.'/assets';
$themepath_image=$templateadress.'/images';


//    <!-- Load JavaScript Libraries -->

//<!-- Scripts-->

$doc->addScript($templateadress . '/js/jquery.min.js');
$doc->addScript($templateadress . '/js/bootstrap.min.js');


//<!-- Menu jQuery plugin -->
$doc->addScript($templateadress . '/js/hover-dropdown-menu.js');

//<!-- Menu jQuery Bootstrap Addon -->
$doc->addScript($templateadress . '/js/jquery.hover-dropdown-menu-addon.js');


//<!-- Scroll Top Menu -->
$doc->addScript($templateadress . '/js/jquery.easing.1.3.js');

//<!-- Sticky Menu -->
$doc->addScript($templateadress . '/js/jquery.sticky.js');

//<!-- Bootstrap Validation -->
$doc->addScript($templateadress . '/js/bootstrapValidator.min.js');

//<!-- Revolution Slider -->
$doc->addScript($templateadress . '/rs-plugin/js/jquery.themepunch.tools.min.js');
$doc->addScript($templateadress . '/rs-plugin/js/jquery.themepunch.revolution.min.js');
$doc->addScript($templateadress . '/js/revolution-custom.js');

//<!-- Portfolio Filter -->
$doc->addScript($templateadress . '/js/jquery.mixitup.min.js');

//<!-- Animations -->
$doc->addScript($templateadress . '/js/jquery.appear.js');
$doc->addScript($templateadress . '/js/effect.js');

//<!-- Owl Carousel Slider -->
$doc->addScript($templateadress . '/js/owl.carousel.min.js');

//<!-- Pretty Photo Popup -->
$doc->addScript($templateadress . '/js/jquery.prettyPhoto.js');

//<!-- Parallax BG -->
$doc->addScript($templateadress . '/js/jquery.parallax-1.1.3.js');

//<!-- Fun Factor / Counter -->
$doc->addScript($templateadress . '/js/jquery.countTo.js');

//<!-- Twitter Feed -->
$doc->addScript($templateadress . '/js/tweet/carousel.js');
$doc->addScript($templateadress . '/js/tweet//scripts.js');
$doc->addScript($templateadress . '/js/tweet//tweetie.min.js');

//<!-- Background Video -->
$doc->addScript($templateadress . '/js/jquery.mb.YTPlayer.js');

//<!-- Custom Js Code -->
$doc->addScript($templateadress . '/js/custom.js');

//<!-- Scripts -->


?>

