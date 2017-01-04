<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class Estado_LeyController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_estado_ley';
    public $leymodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->leymodel=JModelLegacy::getInstance('Estado_Ley');
    }



    public function estado_ley()
    {
        $base = JFactory::getUri()->base();
        $jss = $base.'/assets/js/tablas/kendo_estado_ley.js';
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('estado_ley');
        $view->display();
    }


    
public function ley_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->leymodel=JModelLegacy::getInstance('Estado_Ley');

        $list=$this->leymodel->loadAll('*');


            echo json_encode($list);

        JFactory::getApplication()->close();
    }





    
public function ley_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $ley = $this->input->post->get('ley', array(), 'array');
        $this->leymodel=JModelLegacy::getInstance('Estado_Ley');

        $this->leymodel->bind($ley);

        try {
            $this->leymodel->store();
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
                array('com_estado_ley')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_estado_ley');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function ley_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $ley = $this->input->post->get('ley', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $ley['id_ley']=$olditem1->id_ley ;

        $this->leymodel=JModelLegacy::getInstance('Estado_Ley');
        $this->leymodel->bind($ley);

        try {
            $this->leymodel->store();
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
                array('com_estado_ley')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_estado_ley');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function ley_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $ley =  json_decode($array['array']);
         $this->leymodel=JModelLegacy::getInstance('Estado_Ley');
        foreach($ley as $p){
        $this->leymodel->bind($p);
        try {
            $this->leymodel->delete();
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
                array('com_estado_ley')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_estado_ley');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento esta Asociado no es posible su eliminación';
            echo json_encode($response);
            JFactory::getApplication()->close();
       } }

    }


}
