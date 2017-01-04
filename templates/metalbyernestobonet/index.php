<?php
/**
 * @package&nbsp;&nbsp;&nbsp;&nbsp; Joomla.Site
 * @subpackage&nbsp; Template.metal
 *
 * @copyright&nbsp;&nbsp; Copyright (C) 2005 - 2016 Joomquery.com.
 * @license&nbsp;&nbsp;&nbsp;&nbsp; GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
/*JLoader::import('includes/defines.php');
JLoader::import('includes/framework.php');*/

include('includes/template_load_css.php');
include('includes/template_load_js.php');
//include('includes/template_functions.php');
//$menu =JFactory::getApplication()->getMenu()->getItems('menutype', 'top');
$year = JFactory::getDate()->year;
$style='';

//$menu=getMenu($menu,$style);
$baseurl =$this->baseurl;
$doc             = JFactory::getDocument();
$user = JFactory::getUser();
$templateaddress = $baseurl.'/templates/'.$this->template;
$images = $baseurl.'/templates/'.$this->template.'/assets/img';
//$logo = $baseurl.'/templates/'.$this->template.'/images/logos/3.png';
/*if($user->id==0){
    include('/includes/template_login.php');
//JFactory::getApplication()->redirect('/gestionando/?option=com_users&task=login');

}
else
{ */
   // JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_persona/models');
  //  $personamodel= JModelLegacy::getInstance('persona');
  //  $id = $user->id;

  //  $image = $baseurl.'/images/users/'.$persona->foto;

// Output as HTML5
$doc->setHtml5(true);
    ?>
<!DOCTYPE html>
<html xmlns:jdoc="http://www.w3.org/2001/XSL/Transform" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="generator"
          content="A place for cuban 's enterprising" />
    <title>Home \ Metal —A place for cuban 's enterprising Template</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Joomla Template" />
    <meta name="description" content="Metal —A place for cuban 's enterprising Template" />
    <meta name="author" content="Ernesto Alberto Bonet Moncada" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NegociosxCuba</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Favicon -->
    <jdoc:include type="head"/>

</head>
<body >

<div id="page" class="page-wrap">
    <!-- Page Loader -->
    <div id="pageloader">
        <div class="loader-item fa fa-spin text-color"></div>
    </div>
    <!-- Top Bar -->
    <div id="top-bar" class="top-bar-section top-bar-bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Top Contact -->
                    <div class="top-contact link-hover-black">
                        <a href="#">
                            <i class="fa fa-phone"></i>+ 123 132 1234</a>
                        <a href="#">
                            <i class="fa fa-envelope"></i>info@zozothemes.com</a></div>
                    <!-- Top Social Icon -->
                    <div class="top-social-icon icons-hover-black">
                        <a href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-youtube"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-dribbble"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-github"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-rss"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-google-plus"></i>
                        </a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Bar -->
    <!-- Sticky Navbar -->
    <header id="sticker" class="sticky-navigation">
        <!-- Sticky Menu -->
        <div class="sticky-menu relative">
            <!-- navbar -->
            <div class="navbar navbar-default navbar-bg-light" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="navbar-header">
                                <!-- Button For Responsive toggle -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span></button>
                                <!-- Logo -->

                                <a class="navbar-brand" href="index.html">
                                    <img class="site_logo" alt="Site Logo" src="<?php  echo JText::_($images.'/logo.png');?>" />
                                </a></div>
                            <!-- Navbar Collapse -->
                            <div class="navbar-collapse collapse">
                                <!-- nav -->
                                <ul class="nav navbar-nav">
                                    <!-- Home  Mega Menu -->
                                    <li>
                                        <a class="active" href="index.html">Home</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="index1.html">Metal Home 1</a>
                                            </li>
                                            <li>
                                                <a href="index2.html">Metal Home 2</a>
                                            </li>
                                            <li>
                                                <a href="index3.html">Metal Home 3</a>
                                            </li>
                                            <li>
                                                <a href="index4.html">Metal Home 4</a>
                                            </li>
                                            <li>
                                                <a href="index5.html">Metal Home 5</a>
                                            </li>
                                            <li>
                                                <a href="index6.html">Metal Home 6</a>
                                            </li>
                                            <li>
                                                <a href="index7.html">Metal One Page</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Mega Menu Ends -->
                                    <!-- Features Menu -->
                                    <li class="mega-menu">
                                        <a href="#">Features</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <!-- Home Mage Menu grids Begins -->
                                                <div class="row">
                                                    <!-- Page Block -->
                                                    <div class="col-sm-3">
                                                        <!-- Title -->
                                                        <h6 class="title">Pages</h6>
                                                        <!-- Links -->
                                                        <div class="page-links">
                                                            <div>
                                                                <a href="team.html">Team</a>
                                                            </div>
                                                            <div>
                                                                <a href="careers.html">Careers</a>
                                                            </div>
                                                            <div>
                                                                <a href="coming-soon.html">Coming Soon</a>
                                                            </div>
                                                            <div>
                                                                <a href="maintenance.html">Under Maintenance</a>
                                                            </div>
                                                            <div>
                                                                <a href="clients.html">Clients</a>
                                                            </div>
                                                            <div>
                                                                <a href="testimonials.html">Testimonials</a>
                                                            </div>
                                                            <div>
                                                                <a href="faq.html">FAQ&#39;s</a>
                                                            </div>
                                                            <div>
                                                                <a href="404.html">404 Page</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Page Block -->
                                                    <!-- Header Block -->
                                                    <div class="col-sm-3">
                                                        <!-- Title -->
                                                        <h6 class="title">Header</h6>
                                                        <!-- Links -->
                                                        <div class="page-links">
                                                            <div>
                                                                <a href="header1.html">Simple Header</a>
                                                            </div>
                                                            <div>
                                                                <a href="header2.html">Shop Header</a>
                                                            </div>
                                                            <div>
                                                                <a href="side-nav.html">Push Menu Header</a>
                                                            </div>
                                                            <div>
                                                                <a href="header3.html">Header Center</a>
                                                            </div>
                                                            <div>
                                                                <a href="header4.html">Toggle Light Header</a>
                                                            </div>
                                                            <div>
                                                                <a href="page-title-1.html">Page Title Simple</a>
                                                            </div>
                                                            <div>
                                                                <a href="page-title-2.html">Page Title Parallax</a>
                                                            </div>
                                                            <div>
                                                                <a href="page-title-3.html">Page Title Pattern</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Header Block -->
                                                    <!-- Slider Block -->
                                                    <div class="col-sm-3">
                                                        <!-- Title -->
                                                        <h6 class="title">Slider</h6>
                                                        <!-- Links -->
                                                        <div class="page-links">
                                                            <div>
                                                                <a href="revolution-slider-1.html">Revolution Slider 1</a>
                                                            </div>
                                                            <div>
                                                                <a href="revolution-slider-2.html">Revolution Slider 2</a>
                                                            </div>
                                                            <div>
                                                                <a href="revolution-slider-3.html">Revolution Slider 3</a>
                                                            </div>
                                                            <div>
                                                                <a href="revolution-slider-4.html">Revolution Slider 4</a>
                                                            </div>
                                                            <div>
                                                                <a href="carousel-slider.html">Carousel Slider</a>
                                                            </div>
                                                            <div>
                                                                <a href="text-slider.html">Text Slider</a>
                                                            </div>
                                                            <div>
                                                                <a href="videobg-slider.html">Video Background</a>
                                                            </div>
                                                            <div>
                                                                <a href="parallax-slider.html">Parallax Background</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Slider Block -->
                                                    <!-- Button Block-->
                                                    <div class="col-sm-3 text-center xs-pad-30">
                                                        <img src= " <?php  echo JText::_($images.'/sections/man.jpg');?>" alt="" />
                                                        <a href="" class="btn btn-default btn-block get-in-touch">Get In
                                                            Touch</a></div>
                                                    <!-- Button Block -->
                                                </div>
                                                <!-- Ends Home Mage Menu Block -->
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Ends Features Menu -->
                                    <!-- ABout Us -->
                                    <li>
                                        <a href="#">About</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="about-us.html">About Us 1</a>
                                            </li>
                                            <li>
                                                <a href="about-us-2.html">About Us 2</a>
                                            </li>
                                            <li>
                                                <a href="about-us-3.html">About Us 3</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Ends Widgets Block -->
                                    <!-- Portfolio Menu -->
                                    <li>
                                        <a href="#">Projects</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="portfolio.html">Grid</a>
                                            </li>
                                            <li>
                                                <a href="portfolio-list.html">List</a>
                                            </li>
                                            <li>
                                                <a href="portfolio-single.html">Single</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Portfolio Menu -->
                                    <!-- Service Menu -->
                                    <li>
                                        <a href="services.html">Services</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="services-1.html">General Contracting</a>
                                            </li>
                                            <li>
                                                <a href="services-2.html">Construction Consultant</a>
                                            </li>
                                            <li>
                                                <a href="services-3.html">House Renovation</a>
                                            </li>
                                            <li>
                                                <a href="services-4.html">Green House</a>
                                            </li>
                                            <li>
                                                <a href="services-5.html">Tiling and Painting</a>
                                            </li>
                                            <li>
                                                <a href="services-6.html">Metal Roofing</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Service Menu -->
                                    <!-- Shop Menu -->
                                    <li>
                                        <a href="#">Shop</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="shop-grid.html">Grid</a>
                                            </li>
                                            <li>
                                                <a href="shop-list.html">List</a>
                                            </li>
                                            <li>
                                                <a href="shop-single.html">Single</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Ends Shop Menu -->
                                    <!-- Blog Menu -->
                                    <li>
                                        <a href="#">Blog</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="blog-grid.html">Grid</a>
                                            </li>
                                            <li>
                                                <a href="blog-list.html">List</a>
                                            </li>
                                            <li>
                                                <a href="blog-single.html">Single</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- Blog Menu -->
                                    <!-- Contact Block -->
                                    <li>
                                        <a href="contact.html">Contact</a>
                                    </li>
                                    <!-- Ends Contact Block -->
                                    <!-- Header Search -->
                                    <li class="hidden-767">
                                        <a href="#" class="header-search">
                                                <span>
                                                    <i class="fa fa-search"></i>
                                                </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Right nav -->
                                <!-- Header Search Content -->
                                <div class="bg-white hide-show-content no-display header-search-content">
                                    <form role="search" class="navbar-form vertically-absolute-middle">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter your text &amp; Search Here"
                                                   class="form-control" id="s" name="s" value="" />
                                        </div>
                                    </form>
                                    <button class="close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <!-- Header Search Content -->
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- navbar -->
        </div>
        <!-- Sticky Menu -->
    </header>
    <!-- Sticky Navbar -->
    <section class="slider border-bottom line tp-banner-fullscreen-container">
        <div class="tp-banner">
            <ul>
                <li data-delay="7000" data-transition="fade" data-slotamount="7" data-masterspeed="2000">
                    <div class="container">
                        <h2 class="tp-caption lft skewtotop title bold white" data-x="02" data-y="181" data-speed="1000"
                            data-start="1700" data-easing="Power4.easeOut" data-endspeed="500" data-endeasing="Power1.easeIn">
                            <strong>We are Creative</strong>
                        </h2>
                        <h2 class="tp-caption lft skewtotop title bold white" data-x="02" data-y="241" data-speed="1200"
                            data-start="1900" data-easing="Power4.easeOut" data-endspeed="500" data-endeasing="Power1.easeIn">
                            <strong>Construction Company</strong>
                        </h2>
                    </div>
                    <img src="<?php  echo JText::_($images.'/sections/slider/slide1.jpg');?>" alt="" data-bgfit="cover" data-bgposition="center top"
                         data-bgrepeat="no-repeat" />
                </li>
                <li data-delay="7000" data-transition="fade" data-slotamount="7" data-masterspeed="2000">
                    <div class="container">
                        <h2 class="tp-caption lft skewtotop title bold white" data-x="02" data-y="181" data-speed="1000"
                            data-start="1700" data-easing="Power4.easeOut" data-endspeed="500" data-endeasing="Power1.easeIn">
                            <strong>We are the Leaders</strong>
                        </h2>
                        <h2 class="tp-caption lft skewtotop title bold white" data-x="02" data-y="241" data-speed="1200"
                            data-start="1900" data-easing="Power4.easeOut" data-endspeed="500" data-endeasing="Power1.easeIn">
                            <strong>In Construction Company</strong>
                        </h2>
                    </div>
                    <img src="<?php  echo JText::_($images.'/sections/slider/slide2.jpg');?>" alt="" data-bgfit="cover" data-bgposition="center top"
                         data-bgrepeat="no-repeat" />
                </li>
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
    </section>
    <!-- slider -->
    <section id="features" class="page-section bottom-pad-0 transparent slider-block" data-animation="fadeInUp">
        <div class="container">
            <div class="row special-feature">
                <!-- Special Feature Box 1 -->
                <div class="col-md-3" data-animation="fadeInLeft">
                    <div class="s-feature-box text-center">
                        <div class="mask-top">
                            <!-- Icon -->
                            <i class="icon-magic-wand"></i>
                            <!-- Title -->
                            <h4>Creative</h4></div>
                        <div class="mask-bottom">
                            <!-- Icon -->
                            <i class="icon-magic-wand"></i>
                            <!-- Title -->
                            <h4>Creative</h4>
                            <!-- Text -->
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                    </div>
                </div>
                <!-- Special Feature Box 2 -->
                <div class="col-md-3" data-animation="fadeInUp">
                    <div class="s-feature-box text-center">
                        <div class="mask-top">
                            <!-- Icon -->
                            <i class="icon-texture"></i>
                            <!-- Title -->
                            <h4>Technology</h4></div>
                        <div class="mask-bottom">
                            <!-- Icon -->
                            <i class="icon-texture"></i>
                            <!-- Title -->
                            <h4>Technology</h4>
                            <!-- Text -->
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                    </div>
                </div>
                <!-- Special Feature Box 3 -->
                <div class="col-md-3" data-animation="fadeInRight">
                    <div class="s-feature-box text-center">
                        <div class="mask-top">
                            <!-- Icon -->
                            <i class="icon-tree3"></i>
                            <!-- Title -->
                            <h4>Go Green</h4></div>
                        <div class="mask-bottom">
                            <!-- Icon -->
                            <i class="icon-tree3"></i>
                            <!-- Title -->
                            <h4>Go Green</h4>
                            <!-- Text -->
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                    </div>
                </div>
                <!-- Special Feature Box 3 -->
                <div class="col-md-3" data-animation="fadeInUp">
                    <div class="s-feature-box text-center">
                        <div class="mask-top">
                            <!-- Icon -->
                            <i class="icon-group-outline"></i>
                            <!-- Title -->
                            <h4>Team Work</h4></div>
                        <div class="mask-bottom">
                            <!-- Icon -->
                            <i class=" icon-group-outline"></i>
                            <!-- Title -->
                            <h4>Team Work</h4>
                            <!-- Text -->
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features -->
    <section id="services" class="page-section">
        <div class="container">
            <div class="row">
                <div class="owl-carousel navigation-1 opacity text-left" data-pagination="false" data-items="3"
                     data-autoplay="true" data-navigation="true">
                    <div class="col-sm-4 col-md-4 col-xs-12" data-animation="fadeInLeft">
                        <p class="text-center">

                            <a href="<?php  echo JText::_($images.'/sections/services/1.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/1.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">General Contracting</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12" data-animation="fadeInUp">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/2.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/2.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Construction Consultant</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12" data-animation="fadeInRight">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/3.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/3.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">House Renovation</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="      <?php  echo JText::_($images.'/sections/services/4.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="      <?php  echo JText::_($images.'/sections/services/4.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Metal Roofing</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href=" <?php  echo JText::_($images.'/sections/services/5.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/5.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Green House</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/6.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/6.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Tiling and Painting</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services -->
    <section id="who-we-are" class="page-section light-bg border-tb">
        <div class="container who-we-are">
            <div class="section-heading">
                <div class="section-title text-left">
                    <!-- Title -->
                    <h2 class="title">Who We Are</h2>
                </div>
                <div class="section-title-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec
                    odio ipsum. Suspendisse cursus malesuada facilisis.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Vestibulum nec odio ipsum. Suspendisse cursus malesuada facilisis.</div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <p class="description upper">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec odio
                        ipsum. Suspendisse cursus malesuada facilisis.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec odio ipsum. Suspendisse cursus
                        malesuada facilisis.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec odio ipsum.
                        Suspendisse cursus malesuada facilisis. Suspendisse cursus malesuada facilisis. Nunc consectetur odio sed
                        dolor tincidunt porttitor.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="arrow-style">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Consectetur adipiscing elit.</li>
                                <li>Vestibulum nec odio ipsum.</li>
                                <li>Vestibulum nec odio ipsum.</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="arrow-style">
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Consectetur adipiscing elit.</li>
                                <li>Vestibulum nec odio ipsum.</li>
                                <li>Vestibulum nec odio ipsum.</li>
                            </ul>
                        </div>
                    </div>
                    <h3>
                        <a href="#" class="hover">Download Our Brochure -
                            <i class="icon-file-pdf red"></i></a>
                    </h3>
                </div>
                <div class="col-md-4">
                    <div class="item-box bottom-pad-10">
                        <a>
                            <i class="icon-star13 i-5x bg-color"></i>
                            <h4>What We Do?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspendisse cursus
                                malesuada facilisis.</p>
                        </a>
                        <a>
                            <i class="icon-heart18 i-5x bg-color"></i>
                            <h4>Why People Like Us?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum. Suspendisse cursus
                                malesuada facilisis.</p>
                        </a>
                        <a>
                            <i class="icon-gift6 i-5x bg-color"></i>
                            <h4>What We Offer?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit. Vestibulum nec odio ipsum.</p>
                        </a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- who-we-are -->
    <section id="works" class="page-section">
        <div class="container general-section">
            <div class="section-heading">
                <div class="section-title text-left">
                    <!-- Title -->
                    <h2 class="title">Featured Works</h2>
                </div>
                <div class="section-title-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec
                    odio ipsum. Suspendisse cursus malesuada facilisis.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Vestibulum nec odio ipsum. Suspendisse cursus malesuada facilisis.</div>
            </div>
            <div id="options" class="filter-menu">
                <ul class="option-set nav nav-pills">
                    <li class="filter active" data-filter="all">Show All</li>
                    <li class="filter" data-filter=".commercial">Commercial</li>
                    <li class="filter" data-filter=".education">Education</li>
                    <li class="filter" data-filter=".healthcare">Healthcare</li>
                    <li class="filter" data-filter=".residential">Residential</li>
                </ul>
            </div>
            <!-- filter -->
        </div>
        <div class="container-fluid white general-section">
            <div id="mix-container" class="portfolio-grid">
                <!-- Item 1 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all commercial">
                    <div class="grid">

                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/1.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/1.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 1 Ends-->
                <!-- Item 2 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all commercial education">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/2.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/2.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 2 Ends-->
                <!-- Item 3 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all commercial healthcare">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/3.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/3.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 3 Ends-->
                <!-- Item 4 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all education residential">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/4.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/4.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 4 Ends-->
                <!-- Item 5 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all healthcare commercial">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/5.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/5.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 5 Ends-->
                <!-- Item 6 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all healthcare commercial residential">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/6.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/6.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 6 Ends-->
                <!-- Item 7 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all commercial healthcare education">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/7.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/7.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 7 Ends-->
                <!-- Item 8 -->
                <div class="grids col-xs-12 col-sm-4 col-md-3 mix all commercial residential">
                    <div class="grid">
                        <img src=" <?php  echo JText::_($images.'/sections/portfolio/thumb/8.jpg');?>" width="400" height="273" alt="Recent Work"
                             class="img-responsive" />
                        <div class="figcaption">
                            <!-- Image Popup-->
                            <a href=" <?php  echo JText::_($images.'/sections/portfolio/thumb/8.jpg');?>" data-rel="prettyPhoto[portfolio]">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="portfolio-single.html">
                                <i class="fa fa-link"></i>
                            </a></div>
                        <div class="caption-block">
                            <h4>Name Of Work</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <!-- Item 8 Ends-->
            </div>
            <!-- Mix Container -->
        </div>
    </section>
    <!-- works -->
    <section id="team" class="page-section light-bg border-tb">
        <div class="container">
            <div class="section-heading">
                <div class="section-title text-left">
                    <!-- Title -->
                    <h2 class="title">Meet Our Team</h2>
                </div>
                <div class="section-title-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec
                    odio ipsum. Suspendisse cursus malesuada facilisis.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Vestibulum nec odio ipsum. Suspendisse cursus malesuada facilisis.</div>
            </div>
            <div class="row text-center">
                <div class="owl-carousel navigation-1" data-pagination="false" data-items="4" data-autoplay="true"
                     data-navigation="true">
                    <div class="col-sm-6 col-md-3 bottom-xs-pad-20">
                        <div class="team-item dark-bg">
                            <div class="image">
                                <!-- Image -->

                                <img src=" <?php  echo JText::_($images.'/sections/team/1.jpg');?>" alt="" title="" width="270" height="270" />
                            </div>
                            <div class="description">
                                <!-- Name -->
                                <h4 class="name">Phillip Parisis</h4>
                                <!-- Designation -->
                                <div class="role">Project Manager</div>
                                <!-- Text -->
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.</p>
                            </div>
                            <div class="social-icon">
                                <!-- Social Icons -->
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest"></i>
                                </a></div>
                        </div>
                    </div>
                    <!-- .employee  -->
                    <div class="col-sm-6 col-md-3 bottom-xs-pad-20">
                        <div class="team-item dark-bg">
                            <div class="image">
                                <!-- Image -->
                                <img src=" <?php  echo JText::_($images.'/sections/team/2.jpg');?>" alt="" title="" width="270" height="270" />
                            </div>
                            <div class="description">
                                <!-- Name -->
                                <h4 class="name">Simo Kruyt</h4>
                                <!-- Designation -->
                                <div class="role">Construction Manager</div>
                                <!-- Text -->
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.</p>
                            </div>
                            <div class="social-icon">
                                <!-- Social Icons -->
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest"></i>
                                </a></div>
                        </div>
                    </div>
                    <!-- .employee -->
                    <div class="col-sm-6 col-md-3 bottom-xs-pad-20">
                        <div class="team-item dark-bg">
                            <div class="image">
                                <!-- Image -->
                                <img src=" <?php  echo JText::_($images.'/sections/team/3.jpg');?>" alt="" title="" width="270" height="270" />
                            </div>
                            <div class="description">
                                <!-- Name -->
                                <h4 class="name">Jorge Canaveral</h4>
                                <!-- Designation -->
                                <div class="role">Architect</div>
                                <!-- Text -->
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.</p>
                            </div>
                            <div class="social-icon">
                                <!-- Social Icons -->
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest"></i>
                                </a></div>
                        </div>
                    </div>
                    <!-- .employee -->
                    <div class="col-sm-6 col-md-3 bottom-xs-pad-20">
                        <div class="team-item dark-bg">
                            <div class="image">
                                <!-- Image -->
                                <img src=" <?php  echo JText::_($images.'/sections/team/4.jpg');?>" alt="" title="" width="270" height="270" />
                            </div>
                            <div class="description">
                                <!-- Name -->
                                <h4 class="name">Aimee Devlin</h4>
                                <!-- Designation -->
                                <div class="role">Sales Manager</div>
                                <!-- Text -->
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.</p>
                            </div>
                            <div class="social-icon">
                                <!-- Social Icons -->
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest"></i>
                                </a></div>
                        </div>
                    </div>
                    <!-- .employee -->
                    <div class="col-sm-6 col-md-3 bottom-xs-pad-20">
                        <div class="team-item dark-bg">
                            <div class="image">
                                <!-- Image -->
                                <img src=" <?php  echo JText::_($images.'/sections/team/5.jpg');?>" alt="" title="" width="270" height="270" />
                            </div>
                            <div class="description">
                                <!-- Name -->
                                <h4 class="name">Phillip Parisis</h4>
                                <!-- Designation -->
                                <div class="role">Resource Head</div>
                                <!-- Text -->
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.</p>
                            </div>
                            <div class="social-icon">
                                <!-- Social Icons -->
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest"></i>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team -->
    <section id="fun-factor" class="page-section">
        <div class="container">
            <div class="row text-right fact-counter">
                <div class="col-sm-6 col-md-3 bottom-xs-pad-30 fun-icon">
                    <!-- Icon -->
                    <div class="count-number text-color" data-count="92">
                        <span class="counter"></span>
                    </div>
                    <!-- Title -->
                    <h3>Project
                        <span>Delivered</span></h3>
                </div>
                <div class="col-sm-6 col-md-3 bottom-xs-pad-30">
                    <!-- Icon -->
                    <div class="count-number text-color" data-count="83">
                        <span class="counter"></span>
                    </div>
                    <!-- Title -->
                    <h3>Happy
                        <span>Clients</span></h3>
                </div>
                <div class="col-sm-6 col-md-3 bottom-xs-pad-30">
                    <!-- Icon -->
                    <div class="count-number text-color" data-count="67">
                        <span class="counter"></span>
                    </div>
                    <!-- Title -->
                    <h3>Winning
                        <span>Awards</span></h3>
                </div>
                <div class="col-sm-6 col-md-3 bottom-xs-pad-30">
                    <!-- Icon -->
                    <div class="count-number text-color" data-count="36">
                        <span class="counter"></span>
                    </div>
                    <!-- Title -->
                    <h3>Country
                        <span>Covered</span></h3>
                </div>
            </div>
        </div>
    </section>
    <!-- fun-factor -->
    <section id="latest-news" class="page-section light-bg border-tb">
        <div class="container">
            <div class="section-heading">
                <div class="section-title text-left">
                    <!-- Title -->
                    <h2 class="title">Our Latest Newst</h2>
                </div>
                <div class="section-title-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec
                    odio ipsum. Suspendisse cursus malesuada facilisis.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Vestibulum nec odio ipsum. Suspendisse cursus malesuada facilisis.</div>
            </div>
            <div class="row">
                <div class="owl-carousel navigation-1 opacity text-left" data-pagination="false" data-items="3"
                     data-autoplay="true" data-navigation="true">
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <?php  echo JText::_($images.'/sections/services/1.jpg');?>
                            <a href="<?php  echo JText::_($images.'/sections/services/1.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/1.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">General Contracting</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="read-more">Read More</a>
                        <div class="right-post-meta">
                            <span class="meta-like">
                            <i class="icon-heart"></i> 5</span>
                            <span class="meta-comment">
                            <i class="icon-comment"></i> 12</span></div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/2.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/2.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Construction Consultant</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="read-more">Read More</a>
                        <div class="pull-right">
                            <i class="icon-heart"></i> 5
                            <i class="icon-comment"></i> 12</div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/3.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/3.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">House Renovation</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="read-more">Read More</a>
                        <div class="right-post-meta">
                            <span class="meta-like">
                            <i class="icon-heart"></i> 5</span>
                            <span class="meta-comment">
                            <i class="icon-comment"></i> 12</span></div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/4.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/4.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Metal Roofing</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/5.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/5.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Green House</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="read-more">Read More</a>
                        <div class="right-post-meta">
                            <span class="meta-like">
                            <i class="icon-heart"></i> 5</span>
                            <span class="meta-comment">
                            <i class="icon-comment"></i> 12</span></div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <p class="text-center">
                            <a href="<?php  echo JText::_($images.'/sections/services/6.jpg');?>" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="<?php  echo JText::_($images.'/sections/services/6.jpg');?>" width="420" height="280" alt="" />
                            </a>
                        </p>
                        <h3>
                            <a href="#">Tiling and Painting</a>
                        </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                            deserunt a enim harum eaque fugit.</p>
                        <a href="#" class="read-more">Read More</a>
                        <div class="right-post-meta">
                            <span class="meta-like">
                            <i class="icon-heart"></i> 5</span>
                            <span class="meta-comment">
                            <i class="icon-comment"></i> 12</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- news -->
    <section id="testimonials" class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 testimonials">
                    <div class="owl-carousel pagination-2 text-center color-switch" data-pagination="true" data-autoplay="true"
                         data-navigation="false" data-singleitem="true">
                        <div class="item">
                            <div class="quote">
                                <p>&quot;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.&quot;</p>
                            </div>
                            <div class="client-details text-center left-align">
                                <div class="client-image">
                                    <!-- Image -->
                                    <img class="img-circle" src="img/sections/testimonials/1.jpg" width="80" height="80"
                                         alt="" />
                                </div>
                                <div class="client-details">
                                    <!-- Name -->
                                    <strong class="text-color">John Doe</strong>
                                    <!-- Company -->

                                    <span>Designer, zozothemes</span></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="quote">
                                <p>&quot;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.&quot;</p>
                            </div>
                            <div class="client-details text-center left-align">
                                <div class="client-image">
                                    <!-- Image -->
                                    <img class="img-circle" src="img/sections/testimonials/1.jpg" width="80" height="80"
                                         alt="" />
                                </div>
                                <div class="client-details">
                                    <!-- Name -->
                                    <strong class="text-color">John Doe</strong>
                                    <!-- Company -->

                                    <span>Designer, zozothemes</span></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="quote">
                                <p>&quot;The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                    intereste.&quot;</p>
                            </div>
                            <div class="client-details text-center left-align">
                                <div class="client-image">
                                    <!-- Image -->

                                    <img class="img-circle" src="<?php  echo JText::_($images.'/sections/testimonials/1.jpg');?>" width="80" height="80"
                                         alt="" />
                                </div>
                                <div class="client-details">
                                    <!-- Name -->
                                    <strong class="text-color">John Doe</strong>
                                    <!-- Company -->

                                    <span>Designer, zozothemes</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonials -->
    <section id="clients" class="page-section tb-pad-20 light-bg border-tb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="owl-carousel" data-pagination="false" data-items="6" data-autoplay="true"
                         data-navigation="false">
                        <a href="#">

                            <img src=" <?php  echo JText::_($images.'/sections/clients/1.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/11.png');?>" width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/2.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/22.png');?>" width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/1.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/11.png');?>" width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/2.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/22.png');?>" width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/1.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/11.png');?> width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/2.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/22.png');?>" width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/1.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/11.png');?>" width="170" height="90" alt="" /></a>
                        <a href="#">
                            <img src=" <?php  echo JText::_($images.'/sections/clients/2.png');?>" width="170" height="90" alt="" />
                            <img src=" <?php  echo JText::_($images.'/sections/clients/22.png');?>" width="170" height="90" alt="" /></a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- clients -->
    <div id="get-quote" class="bg-color black text-center">
        <div class="container">
            <div class="row get-a-quote">
                <div class="col-md-12">Get A Free Quote / Need a Help ?
                    <a class="black" href="#">Contact Us</a></div>
            </div>
            <div class="move-top bg-color page-scroll">
                <a href="#page">
                    <i class="glyphicon glyphicon-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- request -->
    <footer id="footer">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 widget bottom-xs-pad-20">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title">Address</h3>
                        </div>
                        <!-- Address -->
                        <p>
                            <strong>Office:</strong> Zozotheme.com
                            <br />No. 12, Ribon Building,
                            <br />Walse street, Australia.</p>
                        <!-- Email -->
                        <a class="text-color" href="mailto:info@zozothemes.com">info@zozothemes.com</a>
                        <!-- Phone -->
                        <p>
                            <strong>Call Us:</strong> +0 (123) 456-78-90 or
                            <br />+0 (123) 456-78-90</p></div>
                    <div class="col-xs-12 col-sm-6 col-md-3 widget bottom-xs-pad-20">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title">Services</h3>
                        </div>
                        <nav>
                            <ul>
                                <!-- List Items -->
                                <li>
                                    <a href="#">General Contracting</a>
                                </li>
                                <li>
                                    <a href="#">Construction Consultant</a>
                                </li>
                                <li>
                                    <a href="#">House Renovation</a>
                                </li>
                                <li>
                                    <a href="#">Metal Roofing</a>
                                </li>
                                <li>
                                    <a href="#">Green House</a>
                                </li>
                                <li>
                                    <a href="#">Tiling and Painting</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 widget">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title">Business Hours</h3>
                        </div>
                        <nav>
                            <ul>
                                <!-- List Items -->
                                <li>
                                    <a href="#">Monday-Friday: 9am to 5pm</a>
                                </li>
                                <li>
                                    <a href="#">Saturday / Sunday: Closed</a>
                                </li>
                            </ul>
                            <!-- Count -->
                            <div class="footer-count">
                                <p class="count-number" data-count="3550">total projects :
                                    <span class="counter"></span></p>
                            </div>
                            <div class="footer-count">
                                <p class="count-number" data-count="2550">happy clients :
                                    <span class="counter"></span></p>
                            </div>
                        </nav>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 widget newsletter bottom-xs-pad-20">
                        <div class="widget-title">
                            <!-- Title -->
                            <h3 class="title">Newsletter Signup</h3>
                        </div>
                        <div>
                            <!-- Text -->
                            <p>Subscribe to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</p>
                            <p class="form-message1"></p>
                            <div class="clearfix"></div>
                            <!-- Form -->
                            <form id="subscribe_form" action="subscription.php" method="post" name="subscribe_form"
                                  role="form">
                                <div class="input-text form-group has-feedback">
                                    <input class="form-control" type="email" value="" name="subscribe_email" />
                                    <button class="submit bg-color" type="submit">
                                        <span class="glyphicon glyphicon-arrow-right"></span>
                                    </button></div>
                            </form>
                        </div>
                        <!-- Social Links -->
                        <div class="social-icon gray-bg icons-circle i-3x">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-pinterest"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-google"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-linkedin"></i>
                            </a></div>
                    </div>
                    <!-- .newsletter -->
                </div>
            </div>
        </div>
        <!-- footer-top -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <!-- Copyrights -->
                    <div class="col-xs-12 col-sm-6 col-md-6"> <?php  echo JText::_('ClimbX '.$year);?>
                        <br />
                        <!-- Terms Link -->

                        <a href="#">Terms of Use</a> /
                        <a href="#">Privacy Policy</a></div>
                    <div class="col-xs-12 text-center visible-xs-block page-scroll gray-bg icons-circle i-3x">
                        <!-- Goto Top -->
                        <a href="#page">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom -->
    </footer>
    <!-- footer -->
</div>
<!-- page -->

</body>

</html>
<?php

//}
?>
