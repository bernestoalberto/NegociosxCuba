<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

    class NegocioController extends JControllerLegacy
{


     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_negocio';
	public $negociomodel;


	function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->negociomodel=JModelLegacy::getInstance('Negocio');
    }

        public function usuario_json_list()
        {
            header('Content-Type: application/json');
            // Send the response.
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            $this->negociomodel=JModelLegacy::getInstance('negocio');

            $list=$this->negociomodel->loadAllUsers();
            echo json_encode($list);

            JFactory::getApplication()->close();
        }
        public function categoria_json_list()
        {
            header('Content-Type: application/json');
            // Send the response.
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            $this->negociomodel=JModelLegacy::getInstance('negocio');

            $list=$this->negociomodel->loadAllCategories();
            echo json_encode($list);

            JFactory::getApplication()->close();
        }
        public function categoria_combo_json_list()
        {
            header('Content-Type: application/json');
            // Send the response.
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            $this->negociomodel=JModelLegacy::getInstance('negocio');

            $list=$this->negociomodel->loadCategories();
            echo json_encode($list);

            JFactory::getApplication()->close();
        }
    
 public function negocio()
    {
        $base = JFactory::getUri()->base();
        $jss = array(
            '1' =>$base.'/assets/js/tablas/kendo_'.$this->name.'.js',
            '2'=>$base.'/assets/js/tablas/kendo_persona.js'
        );
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('negocio');
        $view->display();
    }


    
public function negocio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->negociomodel=JModelLegacy::getInstance('negocio');

        $list=$this->negociomodel->loadAll('*');
        if($list!=false) {
           for ($i = 0; $i < count($list); $i++) {
                $user = JUser::getInstance($list[$i]->id);

                $list[$i]->usuario = $user->username ;
               $categoria = $this->negociomodel->loadCategory($list[$i]->categoria);
               $list[$i]->category = $categoria->title;
               if($list[$i]->url==null)
                   $list[$i]->url = "no tiene";

                   if($list[$i]->foto1=="")
                       $list[$i]->foto1 = "no tiene";

                       if($list[$i]->foto2=="")
                           $list[$i]->foto2 = "no tiene";

                              if($list[$i]->otro_telefono==null)
                                  $list[$i]->otro_telefono = "no tiene";
               if($list[$i]->cliente_premium==0){
                   $list[$i]->tipo_cliente = "Los 5 primeros";
               }
               else if($list[$i]->cliente_premium==1){
                   $list[$i]->tipo_cliente = "Del 6 al 10";
               }
                  else{
                   $list[$i]->tipo_cliente = "Del 10 en adelante";
               }



            }


            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }
public function negocio_usuario_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->negociomodel=JModelLegacy::getInstance('negocio');
        $list=$this->negociomodel->loadAll('*');
        if($list!=false) {
           for ($i = 0; $i < count($list); $i++) {
                $user = JUser::getInstance($list[$i]->id);

                $list[$i]->usuario = $user->username ;
              $categoria =  $this->negociomodel->loadCategory($list[$i]->categoria);
               $list[$i]->category = $categoria->title;


            }


            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }

        //Check this out
        public function negocio_json_combo_list()
        {
            header('Content-Type: application/json');
            // Send the response.
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            JModelLegacy::addIncludePath(JPATH_COMPONENT.'/components/com_programa/models');
            $this->entidadmodel=JModelLegacy::getInstance('entidad');
            $programamodel = JModelLegacy::getInstance('programa');
            $programas = (object)$programamodel->loadAll('*');
            $list=$this->entidadmodel->loadAll('*');
            $k =0;
            for($i=0;$i<count($list);$i++){
                $entidad = $list[$i];
                $found =false;
                for($j=0;$j<count($programas);$j++){
                    $programa = $programas[$j];
                    if($entidad->id_programa== $programa->id_programa && $programa->id_entidad != 19 ){
                        $found =true;
                    }
                }
                if($found==false) {
                    $lista[$k] = $entidad;
                    $k++;
                }

            }
            echo json_encode($lista);
            JFactory::getApplication()->close();
        }


    
public function negocio_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
       JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));

        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $negocio = $this->input->post->get('negocio', array(), 'array');
        $negocio['id']= $negocio['id_usuario'];
        $this->negociomodel=JModelLegacy::getInstance('negocio');


        $file =  $_FILES['negocio'];
        $name = $file['name']['foto'];

        $name1 =  $file['name']['foto1'];
        $name2 =  $file['name']['foto2'];
        if($name1 != "" ) {
            $tmp_name1 = $file['tmp_name']['foto1'];
            $error1 = $file['error']['foto1'];
            $path1 = JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$name1;
            $path1 = JPath::clean($path1);
            if($name2 !=""){
                $tmp_name2=$file['tmp_name']['foto2'];
                $error2 = $file['error']['foto2'];
                $path2 = JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$name2;
                $path2=JPath::clean($path2);
            }
        }


        $tmp_name=$file['tmp_name']['foto'];
        $error = $file['error']['foto'];
        $path = JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$name;
        $path=JPath::clean($path);
        if ($error == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r= JFile::upload($tmp_name,$path,false,true);
            if( $r==true)
                $negocio['foto']=$name ;

            if($error1 == UPLOAD_ERR_OK) {
                $r1 = JFile::upload($tmp_name1, $path1, false, true);
                if ($r1 == true)
                    $negocio['foto1'] = $name1;
            }
            if($error2 == UPLOAD_ERR_OK){
                $r2= JFile::upload($tmp_name2,$path2,false,true);
                if( $r2==true)
                    $negocio['foto2']=$name2 ;


            }
        }



        $this->negociomodel->bind($negocio);

        try {
            $result=   $this->negociomodel->store();
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
                array('com_negocio')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_negocio');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function negocio_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');


        $negocio = $this->input->post->get('negocio', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $negocio['id_negocio']=$olditem1->id_negocio ;
        $negocio['id']= $negocio['id_usuario'] ;

        $file =  $_FILES['negocio'];
        $name = $file['name']['foto'];

        $name1 =  $file['name']['foto1'];
        $name2 =  $file['name']['foto2'];
        if($name1 != "" ) {
            $tmp_name1 = $file['tmp_name']['foto1'];
            $error1 = $file['error']['foto1'];
            $path1 = JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$name1;
            $path1 = JPath::clean($path1);
            if($name2 !=""){
                $tmp_name2=$file['tmp_name']['foto2'];
                $error2 = $file['error']['foto2'];
                $path2 = JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$name2;
                $path2=JPath::clean($path2);
            }
        }


        $tmp_name=$file['tmp_name']['foto'];
        $error = $file['error']['foto'];
        $path = JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$name;
        $path=JPath::clean($path);
        if ($error == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r= JFile::upload($tmp_name,$path,false,true);
            if( $r==true)
                $negocio['foto']=$name ;

            if($error1 == UPLOAD_ERR_OK) {
                $r1 = JFile::upload($tmp_name1, $path1, false, true);
                if ($r1 == true)
                    $negocio['foto1'] = $name1;
            }
            if($error2 == UPLOAD_ERR_OK){
                $r2= JFile::upload($tmp_name2,$path2,false,true);
                if( $r2==true)
                    $negocio['foto2']=$name2 ;


            }
        }


        $this->negociomodel=JModelLegacy::getInstance('negocio');

        $this->negociomodel->bind($negocio);

        try {
                $result=  $this->negociomodel->store();
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
                array('com_negocio')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_negocio');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }


    
public function negocio_delete_one()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_publicidad/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_solicitud/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_solicitud_consultoria/models');
        header('Content-Type: application/json');
        $array = $this->input->post->getArray();
        $negocios =  json_decode($array['array']);
         $this->negociomodel=JModelLegacy::getInstance('Negocio');
     /*   $publicidadmodel = JModelLegacy::getInstance('Publicidad');
        $consultoriamodel = JModelLegacy::getInstance('Solicitud_Consultoria');
        $solicitudmodel = JModelLegacy::getInstance('Solicitud');*/
        foreach($negocios as $p){
          /*  $this->negociomodel->bind($p);
            $publicity =   $this->negociomodel->chargePublicidadtoDelete($p->id_negocio);
            if($publicity!=false){
            foreach($publicity as $pub){
                $publicidadmodel->bind($pub);
                $publicidadmodel->delete();
            }

            }
            $consultoria =   $consultoriamodel->chargeConsultoriatoDelete($p->id_negocio);
            if($consultoria!=false){
                foreach($consultoria as $cons){
                    $consultoriamodel->bind($cons);
                    $consultoriamodel->delete();
                }

            }
            $solicitud =   $solicitudmodel->chargeSolicitudtoDelete($p->id_negocio);
            $solicitudmodel->bind($solicitud);
            $solicitudmodel->delete();*/


        try {
            jimport('joomla.filesystem.file');
            $path =JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$p->foto;
            $path1=JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$p->foto1;
            $path2=JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$p->foto2;
            $r = JFile::exists($path);
            if($r!=false)
               JFile::delete($path);
            $r1 = JFile::exists($path);
            if($r1!=false)
               JFile::delete($path1);
            $r2 = JFile::exists($path2);
            if($r2!=false)
               JFile::delete($path2);

            $result = $this->negociomodel->delete($p->id_negocio,$p);
            $array = array('success' => $result);
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
                array('com_negocio')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_negocio');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento esta Asociado no es posible su eliminación';
            echo json_encode($response);
            JFactory::getApplication()->close();
       } }

    }


}
