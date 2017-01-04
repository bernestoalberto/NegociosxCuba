<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class SolicitudController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_solicitud';
    public $solicitudmodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->solicitudmodel=JModelLegacy::getInstance('Solicitud');
    }
    public function solicitud()
    {
        $base = JFactory::getUri()->base();
        $jss = array(
            '1'=> $base.'assets/js/tablas/kendo_'.$this->name.'.js',
            '2'=> $base.'assets/js/tablas/kendo_solicitud_negocio_procesada.js',
            '3'=> $base.'assets/js/tablas/kendo_negocio_list.js'

        );

        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('solicitud');
        $view->display();
    }
    
    public function   negocios_by_user_solicitud_json_list(){
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_negocio/models');
        $bussinesmodel=  JModelLegacy::getInstance('Negocio');

            $list = $this->solicitudmodel->solicitudes_sin_procesar_por_usuario($_POST['user']);

        if ($list != false) {
            for ($i = 0; $i < count($list); $i++) {
                $user = JUser::getInstance($list[$i]->id_usuario);

                $list[$i]->usuario = $user->username;
                $categoria = $bussinesmodel->loadCategory($list[$i]->categoria);
                $list[$i]->category = $categoria->title;


            }



        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    
    public function solicitud_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_persona/models');


        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');

        $personamodel = JModelLegacy::getInstance('persona');
        $list=$this->solicitudmodel->solicitudes_sin_procesar();
        if($list!=false) {
            for($i=0;$i<count($list); $i++){
                $user=    JUser::getInstance($list[$i]->id_usuario);
                $list[$i]->nombre = $user->name;
                $list[$i]->correo = $user->email;
                $persona = $personamodel->loadPersona($list[$i]->id_usuario);
                $list[$i]->identificacion = $persona->identificacion;
                $list[$i]->telefono = $persona->telefono_fijo;
                $list[$i]->foto_perfil = $persona->foto;
                $list[$i]->direccion = $persona->calle_principal_address.  $persona->primera_entrecalle_address.  $persona->segundo_entrecalle_address;

            }


        }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function solicitud_procesadas_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_negocio/models');

        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');
        $negociomodel = JModelLegacy::getInstance('negocio');
        $list=$this->solicitudmodel->solicitudes_procesadas();
        if($list!=false){
            for($i=0;$i<count($list); $i++) {
                $list[$i]->category = $list[$i]->categoria;
                    $categoria = $negociomodel->loadCategory($list[$i]->categoria);
             $user =   JFactory::getUser($list[$i]->id_usuario);
                    $list[$i]->categoria = $categoria->title;
                    $list[$i]->nombre = $list[$i]->nombre_negocio;
                    $list[$i]->direccion = $list[$i]->direccion_negocio;
                    $list[$i]->descripcion = $list[$i]->resenya_negocio;
                    $list[$i]->telefono = $list[$i]->telefono_fijo;
                    $list[$i]->foto = $list[$i]->foto;
                    $list[$i]->foto1 = $list[$i]->foto1;
                    $list[$i]->foto2 = $list[$i]->foto2;
                    $list[$i]->nombre_usuario = $user->name;


            }


    }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function negocio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');
        $list=$this->solicitudmodel->loadNegocios();
        if($list!=false) {

            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }
    public function solicitud_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $solicitud = $this->input->post->get('solicitud', array(), 'array');
        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');
        $solicitud['fecha'] = JFactory::getDate()->format("Y-m-d H:i:s");
        $correoReceptor=$this->solicitudmodel->getidRRHH($solicitud['asunto']);
        if($solicitud['estado']==1 || $solicitud['estado']==2 )
            $this->solicitudmodel->SendEmailtoEmprendedor($correoReceptor, 'negociosxcuba@localhost', 'negociosXCuba',$solicitud['estado'],$solicitud['descripcion']);


            $this->solicitudmodel->bind($solicitud);

        try {
            $this->solicitudmodel->store();
            $array=array('success'=>true);
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
                array('com_solicitud')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_solicitud');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }
    public function procesar_solicitud()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        // JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        $solicitud = $_GET['fd'];
        $solicitud = json_decode($solicitud);
        $lista_accepted = $solicitud->acepted;
        $lista_canceled = $solicitud->canceled;
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');
        $correoReceptor= $solicitud->user->correo;
//        $this->solicitudmodel->getidRRHH($solicitud['asunto']);
         $this->solicitudmodel->SendEmailtoEmprendedor($correoReceptor,$solicitud->asunto,$solicitud->descripcion);
        for($i = 0;$i<count($lista_accepted);$i++) {
            $lista_accepted[$i]->estado =1;
            $this->solicitudmodel->bind($lista_accepted[$i]);

            try {
                $result = $this->solicitudmodel->store();
                if ($i == count($lista_accepted)) {
                    $array = array('success' => $result);
                    echo json_encode($array);
                }

            }
            catch (Exception $e) {
                JLog::addLogger(
                    array(
                        // Sets file name
                        'text_file' => 'logs.php'
                    ),
                    // Sets messages of all log levels to be sent to the file
                    JLog::ALL,
                    array('com_solicitud')
                );
                JLog::add($e->getMessage(), JLog::ERROR, 'com_solicitud');
                $response = new stdClass();
                $response->success = false;
                $response->message = 'Este elemento no es posible añadirlo';
                echo json_encode($response);
                JFactory::getApplication()->close();
            }
        }
        for($j = 0;$j<count($lista_canceled);$j++) {
            $lista_canceled[$j]->estado =2;
            $this->solicitudmodel->bind($lista_canceled[$j]);

            try {
              $result =  $this->solicitudmodel->store();
                if ($j == count($lista_canceled)) {
                $array = array('success' => $result);
                echo json_encode($array);
            }

            }
            catch (Exception $e) {
                JLog::addLogger(
                    array(
                        // Sets file name
                        'text_file' => 'logs.php'
                    ),
                    // Sets messages of all log levels to be sent to the file
                    JLog::ALL,
                    array('com_solicitud')
                );
                JLog::add($e->getMessage(), JLog::ERROR, 'com_solicitud');
                $response = new stdClass();
                $response->success = false;
                $response->message = 'Este elemento no es posible añadirlo';
                echo json_encode($response);
                JFactory::getApplication()->close();
            }

        }
    }
    public function solicitud_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $solicitud = $this->input->post->get('solicitud', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $solicitud['id_solicitud']=$olditem1->id_solicitud ;
        $solicitud['fecha'] = JFactory::getDate()->format("Y-m-d H:i:s");
        $correoReceptor=$this->solicitudmodel->getidRRHH($solicitud['asunto']);
        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');


        if($solicitud['estado']!=$solicitud['old_subject'])
             $this->solicitudmodel->SendEmailtoEmprendedor($correoReceptor,$solicitud['estado'],$solicitud['descripcion']);


        $this->solicitudmodel->bind($solicitud);

        try {
            $this->solicitudmodel->store();
            $array=array('success'=>true);
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
                array('com_solicitud')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_solicitud');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }
    public function solicitud_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $solicitud =  json_decode($array['array']);
        $this->solicitudmodel=JModelLegacy::getInstance('solicitud');
        foreach($solicitud as $p){
            $this->solicitudmodel->bind($p);
            try {
                $this->solicitudmodel->delete();
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
                    array('com_solicitud')
                );
                JLog::add($e->getMessage(),JLog::ERROR, 'com_solicitud');
                $response= new stdClass();
                $response->success=false;
                $response->message='Este elemento esta Asociado no es posible su eliminación';
                echo json_encode($response);
                JFactory::getApplication()->close();
            } }

    }


}
