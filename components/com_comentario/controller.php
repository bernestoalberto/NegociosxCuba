<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

    class ComentarioController extends JControllerLegacy
{


     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_comentario';
	public $comentariomodel;


	function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->comentariomodel=JModelLegacy::getInstance('Comentario');
    }


    
 public function comentario()
    {
        $base = JFactory::getUri()->base();
        $jss = $base.'/assets/js/tablas/kendo_'.$this->name.'.js';

        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('comentario');
        $view->display();
    }


    
public function comentario_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_negocio/models');
        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_content/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_persona/models');


        $articulomodel = JModelLegacy::getInstance('Article','ContentModel');

        $this->comentariomodel=JModelLegacy::getInstance('comentario');
        $negociomodel = JModelLegacy::getInstance('negocio');
        $personamodel = JModelLegacy::getInstance('persona');
        $list=$this->comentariomodel->loadAll('*');
        if($list!=false) {
            for($i=0;$i<count($list); $i++) {
                $foto = $personamodel->loadPersonaFoto($list[$i]->id_user);
                $user = JUser::getInstance($list[$i]->id_user);
                $list[$i]->usuario = $user->username;
                $list[$i]->foto_profile = $foto->foto;
                $articulo = $articulomodel->getItem($list[$i]->id_articulo);

                $list[$i]->titulo = $articulo->title;
                $list[$i]->id_categoria = $articulo->catid;
                $categoria = $negociomodel->loadCategory($articulo->catid);
                $list[$i]->categoria = $categoria->title;
                

                echo json_encode($list);
            }
        }
        JFactory::getApplication()->close();
    }


public function negocio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->comentariomodel=JModelLegacy::getInstance('comentario');
        $list=$this->comentariomodel->loadNegocios();
        if($list!=false) {

            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }



    
public function comentario_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $comentario = $this->input->post->get('comentario', array(), 'array');
        $this->comentariomodel=JModelLegacy::getInstance('comentario');
        $comentario['fecha'] = JFactory::getDate()->format("Y-m-d H:i:s");
        $comentario['id_user']= JFactory::getUser()->id  ;

        $this->comentariomodel->bind($comentario);

        try {
            $this->comentariomodel->store();
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
                array('com_comentario')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_comentario');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function comentario_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');

        $comentario = $this->input->post->get('comentario', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $comentario['id_comentario']=$olditem1->id_comentario ;
        $comentario['id_user']= JFactory::getUser()->id  ;

        $comentario['fecha'] = JFactory::getDate()->format("Y-m-d H:i:s");


        $this->comentariomodel=JModelLegacy::getInstance('comentario');
        $this->comentariomodel->bind($comentario);

        try {
            $this->comentariomodel->store();
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
                array('com_comentario')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_comentario');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function comentario_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $comentario =  json_decode($array['array']);
         $this->comentariomodel=JModelLegacy::getInstance('comentario');
        foreach($comentario as $p){
        $this->comentariomodel->bind($p);
        try {
            $this->comentariomodel->delete();
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
                array('com_comentario')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_comentario');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento esta Asociado no es posible su eliminación';
            echo json_encode($response);
            JFactory::getApplication()->close();
       } }

    }


}
