<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class Solicitud_ConsultoriaController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_solicitud_consultoria';
    public $consultoriamodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->consultoriamodel=JModelLegacy::getInstance('Solicitud_Consultoria');
    }
    public function consultoria()
    {
        $base = JFactory::getUri()->base();
        $jss = array(
            '1'=>   $base.'/assets/js/tablas/kendo_'.$this->name.'.js',
            '2'=>   $base.'/assets/js/tablas/kendo_solicitud_consultoria_asignada.js'
        );
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('solicitud_consultoria');
        $view->display();
    }
    public function consultoria_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_tipo_consultoria/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_persona/models');

        $this->consultoriamodel=JModelLegacy::getInstance('Solicitud_Consultoria');
        $tipomodel = JModelLegacy::getInstance('Tipo_Consultoria');
        $personamodel = JModelLegacy::getInstance('persona');
        $list=$this->consultoriamodel->loadAllSinProcesar();
        if($list!=false) {
            for($i=0;$i<count($list); $i++){
                $user = JUser::getInstance($list[$i]->id_usuario);
                $persona = $personamodel->loadPersona($list[$i]->id_usuario);
                $tipo = $tipomodel->loadTipoNombre($list[$i]->tipo_consultoria);
                $list[$i]->consultoria = $tipo->consultoria;
                $list[$i]->nombre_usuario = $user->name;


                $list[$i]->foto_perfil = $persona->foto;
            }




        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function consultoria_asiganda_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_tipo_consultoria/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_persona/models');

        $this->consultoriamodel=JModelLegacy::getInstance('Solicitud_Consultoria');
        $tipomodel = JModelLegacy::getInstance('Tipo_Consultoria');
        $personamodel = JModelLegacy::getInstance('persona');
        $list=$this->consultoriamodel->loadAllConsultoriaAsignadas();
        if($list!=false) {
            for($i=0;$i<count($list); $i++){
                $user = JUser::getInstance($list[$i]->id_usuario);
                $persona = $personamodel->loadPersona($list[$i]->id_usuario);

                $list[$i]->foto_perfil = $persona->foto;
                $tipo = $tipomodel->loadTipoNombre($list[$i]->tipo_consultoria);
                $list[$i]->consultoria = $tipo->consultoria;
                $list[$i]->nombre_usuario = $user->name;
                $consultor= JUser::getInstance($list[$i]->id_consultor);
                $list[$i]->consultor = $consultor->username;



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
        JModelLegacy::addIncludePath( JPATH_ROOT.'/com_solicitud/models');
        $consultoriamodel=JModelLegacy::getInstance('solicitud');
        $list=$consultoriamodel->loadNegocios();
        if($list!=false) {


        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function consulting_aceptar()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));

        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $consultoria = $this->input->post->get('solicitud_consulting', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);

        $consultoria['id_consultoria']=$olditem1->id_consultoria ;
        $consultoria['id_consultor']=$consultoria['id_consultor_asig'] ;
        $consultoria['descripcion_denial_acceptance']=$consultoria['descripcion_write'] ;
        $consultoria['descripcion']=$olditem1->descripcion ;
        $consultoria['id_usuario']=$olditem1->id_usuario ;
        $consultoria['leido']=$olditem1->leido ;
        $consultoria['estado']=1 ;
        $consultoria['asunto_denial_acceptance']=$consultoria['asunto_consulting'] ;
        $consultoria['asunto']=$consultoria['asunto_consulting'] ;
        $consultoria['fecha_asignacion']= JFactory::getDate()->format("Y-m-d H:i:s");

        $this->consultoriamodel=JModelLegacy::getInstance('Solicitud_Consultoria');
          $user = JUser::getInstance($consultoria['id_consultor']);
          $correoReceptor=$user->email;
        $this->consultoriamodel->SendEmailtoEmprendedor($correoReceptor, "aceptada",$consultoria['descripcion']);

        $this->consultoriamodel->bind($consultoria);

        try {
            $result =   $this->consultoriamodel->store();
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
                array('com_solicitud_consultoria')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_solicitud_consultoria');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }
    public function consulting_denegar()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');

        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');


        $consultoria = $this->input->post->get('solcitud_denial', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $consultoria['id_consultoria']=$olditem1->id_consultoria ;
        $consultoria['estado']=2 ;
        $consultoria['descripcion']=$olditem1->descripcion ;
        $consultoria['id_usuario']=$olditem1->id_usuario ;
        $consultoria['leido']=$olditem1->leido ;
        $consultoria['asunto_denial_acceptance']=$consultoria['asunto'] ;
        $consultoria['asunto']=$consultoria['asunto'] ;
        $consultoria['fecha']=$olditem1->fecha;
        $consultoria['tipo_consultoria']=$olditem1->tipo_consultoria;


        $user = JUser::getInstance($consultoria['id_usuario']);

        $correoReceptor=$user->email;
        $this->consultoriamodel->SendEmailtoEmprendedor($correoReceptor,"rechazada",$consultoria['descripcion']);

        $this->consultoriamodel=JModelLegacy::getInstance('Solicitud_Consultoria');
        $this->consultoriamodel->bind($consultoria);

        try {
            $result =    $this->consultoriamodel->store();
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
                array('com_solicitud_consultoria')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_solicitud_consultoria');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }
    public function consulting_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $consultoria =  json_decode($array['array']);
        $this->consultoriamodel=JModelLegacy::getInstance('Solicitud_Consultoria');
        foreach($consultoria as $p){
            $this->consultoriamodel->bind($p);
            try {
                $this->consultoriamodel->delete();
                $array=array('success'=>true);
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
                    array('com_solicitud_consultoria')
                );
                JLog::add($e->getMessage(),JLog::ERROR, 'com_solicitud_consultoria');
                $response= new stdClass();
                $response->success=false;
                $response->message='Este elemento esta Asociado no es posible su eliminación';
                echo json_encode($response);
                JFactory::getApplication()->close();
            } }

    }


}
