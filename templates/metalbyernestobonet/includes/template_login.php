<?php
/**
 * @package&nbsp;&nbsp;&nbsp;&nbsp; Joomla.Site
 * @subpackage&nbsp; Template.Your_New_template_name
 *
 * @copyright&nbsp;&nbsp; Copyright (C) 2005 - 2015 Joomquery.com.
 * @license&nbsp;&nbsp;&nbsp;&nbsp; GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

  ?> 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gestionando</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/Gestionando/templates/metrouibyernestobonet/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="/Gestionando/templates/metrouibyernestobonet/assets/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Gestionando/templates/metrouibyernestobonet/assets/dist/css/admin.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Gestionando/templates/metrouibyernestobonet/assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
	  <i class = "icon ion-"></i>
        <b>Gestionando</b>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Por favor identif&iacutequese</p>
        <form  id="loginForm" method="post" action="<?php echo JRoute::_('index.php?option=com_users&task=user.login');?>" >
		<fieldset>
          <div class="form-group has-feedback">
		  			<?php if (!$field->hidden) : ?>
            <input type="text" class="form-control" name="username" placeholder="Usuario" 
                   filter="username" 	required="true" validate="username"/>
            <span class="glyphicon glyphicon-user form-control-feedback" ></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Contrasenya" 
                   required="true" filter="raw"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
         
		  			<?php endif; ?>
	
       </fieldset>  
          <div class="row">
            <div class="col-xs-8">    
           
              
<!--			--><?php //if (JPluginHelper::isEnabled('system', 'remember')) : ?>
<!--			<div  class="control-group">-->
<!--			<div class="controls"><input id="remember" type="checkbox" name="remember" class="inputbox" value="yes" />-->
<!--			<label>--><?php //echo JText::_('Recuerdame') ?><!--</label>-->
<!--			  </div>-->
<!---->
<!--			</div>-->
<!--			--><?php //endif; ?>
                               
            </div><!-- /.col -->
			      
              <button type="button" onclick="$('#loginForm').submit()"  class="btn btn-block btn-primary btn-lg">
			         
			         Identificarse
					 </button>  

          </div>
          
		  <?php echo JHtml::_('form.token'); ?>

        </form>


<!--<!--	--><?php
////		$usersConfig = JComponentHelper::getParams('com_users');
////		if ($usersConfig->get('allowUserRegistration')) : ?>
<!--<!--				     <form id="formregister" method="post" action="<?php ////echo JRoute::_('index.php?option=com_users&view=registration'); ?>
<!--<!--
<!--<!--                                        <a  onclick="$('#formregister').submit()"
<!--<!--                                      <?php ////echo JText::_('Registrarse'); ?>
<!--<!--                                        </a>
<!--<!--
<!--<!--                                     <?php ////echo JHtml::_('form.token'); ?>
<!--<!--			    </form>
<!--
<!--
<!--<?php //endif; ?>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

        <script src="/gestionando/templates/metrouibyernestobonet/js/login.js"></script>
    <!-- jQuery 2.1.3 -->
    <script src="/gestionando/templates/metrouibyernestobonet/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/gestionando/templates/metrouibyernestobonet/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/gestionando/templates/metrouibyernestobonet/assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>