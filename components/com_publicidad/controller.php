<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class PublicidadController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_publicidad';
    public $publicidadmodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->publicidadmodel=JModelLegacy::getInstance('Publicidad');
    }



    public function publicidad()
    {
        $base = JFactory::getUri()->base();
        $jss = array(
        '1'=>$base.'/assets/js/tablas/kendo_'.$this->name.'.js',
          '2'=>$base.'/assets/js/tablas/kendo_publicidad_atendida.js'
        );
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('Publicidad');
        $view->display();
    }


    
public function publicidad_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $this->publicidadmodel=JModelLegacy::getInstance('Publicidad');

        $list=$this->publicidadmodel->loadPublicidadSinProcesar();
        if($list!=false) {
            for($i=0;$i<count($list); $i++){

                $usuario = JUser::getInstance($list[$i]->id_user);
                $asignado = JUser::getInstance($list[$i]->id_persona);
                $list[$i]->usuario =$usuario->username;
                if($asignado->username!= null){
                    $list[$i]->persona=$asignado->username;
                }
                else{
                    $list[$i]->persona="no tiene";
                }


               }


        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }

    public function publicidad_atendida_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->publicidadmodel=JModelLegacy::getInstance('Publicidad');
        $list=$this->publicidadmodel->loadPublicidadProcesada();
        if($list!=false) {
            for($i=0;$i<count($list); $i++){
                $usuario = JUser::getInstance($list[$i]->id_user);
                $asignado = JUser::getInstance($list[$i]->id_persona);
                $list[$i]->usuario =$usuario->username;
                if($asignado->username!= null){
                    $list[$i]->persona=$asignado->username;
                }
                else{
                    $list[$i]->persona="no tiene";
                }

                if( $list[$i]->estado == 0){
                    $list[$i]->state="sin procesar";
                }
                elseif($list[$i]->estado == 1){
                    $list[$i]->state = "aceptada";
                }
                else{
                    $list[$i]->state ="rechazada";
                }

                if($list[$i]->leido==0)
                    $list[$i]->leer="no";
                    else
                        $list[$i]->leer="si";
               }


        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }


public function negocio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_ROOT.'/com_publicidad/models');
        $publicidadmodel=JModelLegacy::getInstance('publicidad');
        $list=$publicidadmodel->loadNegocios();
        if($list!=false) {


        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }


/*

public function publicidad_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $publicidad = $this->input->post->get('publicidad', array(), 'array');

        $this->publicidadmodel=JModelLegacy::getInstance('Publicidad');
        $publicidad['id_user'] = JFactory::getUser()->id;
        $publicidad['fecha'] = JFactory::getDate()->format("Y-m-d H:i:s");



        $this->publicidadmodel->bind($publicidad);

        try {
            $result = $this->publicidadmodel->store();
            $array=array('success'=>$result);
            echo json_encode($array);
            JFactory::getApplication()->close();
        }
        catch(Exception $e)
        {
            JLog::addLogger(
                array(
                    // Sets file name
                    'text_file' => 'logs.php'
                ),
                // Sets messages of all log levels to be sent to the file
                JLog::ALL,
                array('com_Publicidad')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_Publicidad');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }*/


    
public function publicidad_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_solicitud/models');


        $publicidad = $this->input->post->get('asignar_publicidad', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $user = JUser::getInstance($publicidad['id_persona']);
        $publicidad['id_publicidad']=$olditem1->id_publicidad ;
        $publicidad['fecha_modificacion'] = JFactory::getDate()->format("Y-m-d H:i:s");
        $publicidad['id_user'] = $publicidad['id_persona'];
        $publicidad['estado'] = $publicidad['stato'];
        if( $publicidad['estado']==1){
            $estado_literal = "aceptada";
        }
        else{
            $estado_literal = "rechazada";
        }

        $solicitudmodel = JModelLegacy::getInstance('solicitud');

           $correoReceptor=$user->email;
        $solicitudmodel->SendEmailtoEmprendedor($correoReceptor,$estado_literal,$publicidad['descripcion_asig_publicidad']);


        $this->publicidadmodel=JModelLegacy::getInstance('Publicidad');
        $this->publicidadmodel->bind($publicidad);

        try {
            $result =   $this->publicidadmodel->store();
            $array=array('success'=>$result);
            echo json_encode($array);
            JFactory::getApplication()->close();
        }
        catch(Exception $e)
        {
            JLog::addLogger(
                array(
                    // Sets file name
                    'text_file' => 'logs.php'
                ),
                // Sets messages of all log levels to be sent to the file
                JLog::ALL,
                array('com_Publicidad')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_Publicidad');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }

/*

public function publicidad_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $publicidad =  json_decode($array['array']);
         $this->publicidadmodel=JModelLegacy::getInstance('Publicidad');
        foreach($publicidad as $p){
        $this->publicidadmodel->bind($p);
        try {
           $result = $this->publicidadmodel->delete();
            $array=array('success'=>$result);
            echo json_encode($array);

        }
        catch(Exception $e)
        {
            JLog::addLogger(
                array(
                    // Sets file name
                    'text_file' => 'logs.php'
                ),
                // Sets messages of all log levels to be sent to the file
                JLog::ALL,
                array('com_Publicidad')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_Publicidad');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento esta Asociado no es posible su eliminación';
            echo json_encode($response);
            JFactory::getApplication()->close();
       } }

    }*/


}
