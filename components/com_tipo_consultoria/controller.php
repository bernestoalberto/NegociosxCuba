<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class Tipo_ConsultoriaController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_tipo_consultoria';
    public $tipomodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->tipomodel=JModelLegacy::getInstance('Tipo_Consultoria');
    }



    public function tipo_consultoria()
    {
        $base = JFactory::getUri()->base();
        $jss = $base.'/assets/js/tablas/kendo_'.$this->name.'.js';
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('tipo_consultoria');
        $view->display();
    }


    
public function tipo_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->tipomodel=JModelLegacy::getInstance('Tipo_Consultoria');
        $list=$this->tipomodel->loadAll('*');
            echo json_encode($list);

        JFactory::getApplication()->close();
    }




    
public function tipo_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $tipo = $this->input->post->get('type_consulting', array(), 'array');
        $this->tipomodel=JModelLegacy::getInstance('Tipo_Consultoria');

        $this->tipomodel->bind($tipo);

        try {
            $this->tipomodel->store();
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
                array('com_tipo_solicitud')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_tipo_solicitud');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function tipo_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $tipo = $this->input->post->get('type_consulting', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $tipo['id_tipo_consultoria']=$olditem1->id_tipo_consultoria ;


        $this->tipomodel=JModelLegacy::getInstance('Tipo_Consultoria');
        $this->tipomodel->bind($tipo);

        try {
            $this->tipomodel->store();
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
                array('com_tipo_solicitud')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_tipo_solicitud');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function tipo_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $tipo =  json_decode($array['array']);
         $this->tipomodel=JModelLegacy::getInstance('Tipo_Consultoria');
        foreach($tipo as $p){
        $this->tipomodel->bind($p);
        try {
            $this->tipomodel->delete();
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
                array('com_tipo_solicitud')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_tipo_solicitud');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento esta Asociado no es posible su eliminación';
            echo json_encode($response);
            JFactory::getApplication()->close();
       }
            $array=array('success'=>true);
            echo json_encode($array);
        }

    }


}
