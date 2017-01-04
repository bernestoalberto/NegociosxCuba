<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

    class LeyController extends JControllerLegacy
{


     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_ley';
	public $leymodel;


	function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->leymodel=JModelLegacy::getInstance('Ley');
    }

        public function usuario_json_list()
        {
            header('Content-Type: application/json');
            // Send the response.
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            $this->leymodel=JModelLegacy::getInstance('ley');

            $list=$this->leymodel->loadAllUsers();
            echo json_encode($list);

            JFactory::getApplication()->close();
        }
        public function categoria_json_list()
        {
            header('Content-Type: application/json');
            // Send the response.
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            $this->leymodel=JModelLegacy::getInstance('ley');

            $list=$this->leymodel->loadCategories();
            echo json_encode($list);

            JFactory::getApplication()->close();
        }
    
 public function ley()
    {
        $base = JFactory::getUri()->base();
        $jss = $base.'/assets/js/tablas/kendo_'.$this->name.'.js';

        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('ley');
        $view->display();
    }


    
public function ley_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_estado_ley/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_persona/models');


        $this->leymodel=JModelLegacy::getInstance('ley');
        $estadoleymodel=JModelLegacy::getInstance('Estado_Ley');
        $accesomodel=JModelLegacy::getInstance('Persona');

        $list=$this->leymodel->loadAll('*');
        if($list!=false) {
           for ($i = 0; $i < count($list); $i++) {
                $user = JUser::getInstance($list[$i]->autor);
                $list[$i]->author = $user->username ;

               $acceso =   $accesomodel->loadRoleName($list[$i]->acceso);
               $list[$i]->acces = $acceso->title;

               if($list[$i]->id_estado_ley != null){
               $estado = $estadoleymodel->loadEstado($list[$i]->id_estado_ley);
               $list[$i]->state = $estado->estado;
               }
               else{
                   $list[$i]->state = "Sin estado";
               }

               if( $list[$i]->epigrafe == null)
                   $list[$i]->epigrafe = "No tiene";


               $list[$i]->gaceta = $list[$i]->numero_gaceta.'/'.$list[$i]->anyo_gaceta;

               switch($list[$i]->tipo_ley){
                   case 0:
                       $list[$i]->type ="ley";
                       break;
                   case 1:
                       $list[$i]->type ="Decreto Ley";
                       break;
                   case 2:
                       $list[$i]->type ="Decreto";
                       break;
                   case 3:
                       $list[$i]->type ="Resolución";
                       break;

               }


               $list[$i]->tipo = $list[$i]->type.'_'.$list[$i]->numero_ley.'/'.$list[$i]->anyo_ley;

               switch($list[$i]->organismo){
                   case 0:
                       $list[$i]->organism ="No Tiene";
                       break;
                   case 1:
                       $list[$i]->organism ="MINAGRI";
                       break;
                   case 2:
                       $list[$i]->organism ="MICOM";
                       break;
                   case 3:
                       $list[$i]->organism ="MINSAP";
                       break;
                   case 4:
                       $list[$i]->organism ="MINTUR";
                       break;
                   case 5:
                       $list[$i]->organism ="MINED";
                       break;
                    case 6:
                       $list[$i]->organism ="MINREX";
                       break;
                   case 7:
                       $list[$i]->organism ="MINBAS";
                       break;
                   case 8:
                       $list[$i]->organism ="MITRANS";
                       break;
                   case 9:
                       $list[$i]->organism ="MINFP";
                       break;
                   case 10:
                       $list[$i]->organism ="MICONS";
                       break;
                   case 11:
                       $list[$i]->organism ="MINFAR";
                       break;
                   case 12:
                       $list[$i]->organism ="MININT";
                       break;
                   case 13:
                       $list[$i]->organism ="MINJUS";
                       break;

               }


            }

            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }

public function ley_combo_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->leymodel=JModelLegacy::getInstance('ley');

        $list=$this->leymodel->loadMinLey();
        for($i=0;$i<count($list);$i++){
            $list[$i]->gaceta = $list[$i]->numero_gaceta.'/'.$list[$i]->anyo_gaceta;
        }

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

        $file =  $_FILES['ley'];

        $name_doc = $file['name']['documento'];
        $tmp_name_doc=$file['tmp_name']['documento'];
       $error_doc = $file['error']['documento'];
        $path_doc = JPATH_UPLOAD_DOC.DIRECTORY_SEPARATOR.$name_doc;
        $path_doc=JPath::clean($path_doc);
        if ($error_doc == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r = JFile::upload($tmp_name_doc, $path_doc, false, true);
            if ($r == true)
                $ley['documento'] = $name_doc;
        }


        $name_img = $file['name']['imagen'];
        $tmp_name_img=$file['tmp_name']['imagen'];
        $error_img = $file['error']['imagen'];
        $path_img = JPATH_IMG_UPLOAD_LEY.DIRECTORY_SEPARATOR.$name_img;
        $path_img=JPath::clean($path_img);
        if ($error_img == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r = JFile::upload($tmp_name_img, $path_img, false, true);
            if ($r == true)
                $ley['imagen'] = $name_img;
        }

        $this->leymodel=JModelLegacy::getInstance('ley');

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
                array('com_ley')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_ley');
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

        $file =  $_FILES['ley'];

        $name_doc = $file['name']['documento'];
        $tmp_name_doc=$file['tmp_name']['documento'];
        $error_doc = $file['error']['documento'];
        $path_doc = JPATH_UPLOAD_DOC.DIRECTORY_SEPARATOR.$name_doc;
        $path_doc=JPath::clean($path_doc);


        if ($error_doc == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r = JFile::upload($tmp_name_doc, $path_doc, false, true);
            if ($r == true)
                $ley['documento'] = $name_doc;
        }


        $name_img = $file['name']['imagen'];
        $tmp_name_img=$file['tmp_name']['imagen'];
        $error_img = $file['error']['imagen'];
        $path_img = JPATH_IMG_UPLOAD_LEY.DIRECTORY_SEPARATOR.$name_img;
        $path_img=JPath::clean($path_img);
        if ($error_img == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r = JFile::upload($tmp_name_img, $path_img, false, true);
            if ($r == true)
                $ley['imagen'] = $name_img;
        }

        $this->leymodel=JModelLegacy::getInstance('ley');

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
                array('com_ley')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_ley');
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
         $this->leymodel=JModelLegacy::getInstance('ley');
        foreach($ley as $p){
        $this->leymodel->bind($p);
        try {
            jimport('joomla.filesystem.file');
            $path =JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$p->documento;
            $path1 =JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$p->imagen;
            $r = JFile::exists($path);
            if($r!=false)
                JFile::delete($path);
            $r1 = JFile::exists($path1);
            if($r1!=false)
                JFile::delete($path1);

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
                array('com_ley')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_ley');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento esta Asociado no es posible su eliminación';
            echo json_encode($response);
            JFactory::getApplication()->close();
       } }

    }


}
