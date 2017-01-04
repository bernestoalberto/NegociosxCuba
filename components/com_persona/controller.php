<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');


class PersonaController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_persona';
    public $personamodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
    }
    public function persona()
    {
        $base = JFactory::getUri()->base();
        $jss = array(
            '1' =>$base.'/assets/js/tablas/kendo_'.$this->name.'.js',
            '2'=>$base.'/assets/js/tablas/kendo_negocio.js'
        );
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('persona');
        $view->display();
    }
    public function   user_json_list(){
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
        $usuario= new stdClass();
        $usuar = $this->personamodel->usuario_detalles($_POST['user']);
        $rol = $this->personamodel->LoadRolbyUserID($usuar->id_user);
        $usuar->rol = $rol;
        $rolname = $this->personamodel->loadRoleName($rol);
       $user = JFactory::getUser($_POST['user']);

        $usuario->rollon = $rolname->title;
        $usuario->name = $user->name;
        $usuario->telefono_fijo = $usuar->telefono_fijo;
        $usuario->telefono_movil = $usuar->telefono_movil;
        $usuario->calle_principal_address = $usuar->calle_principal_address;
        $usuario->primera_entrecalle_address = $usuar->primera_entrecalle_address;
        $usuario->segundo_entrecalle_address = $usuar->segundo_entrecalle_address;
        $provincia = $this->personamodel->getNombreProvincia($usuar->id_provincia);
        $usuario->provincia = $provincia->nombre_provincia;
        $municipio =$this->personamodel->getNombreMunicipio($usuar->id_municipio);
        $usuario->municipio =  $municipio->nombre_municipio;

        echo json_encode($usuario);
        JFactory::getApplication()->close();
    }
    public function persona_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
        $list=$this->personamodel->loadAll('*');

        if($list!=false)
            for($i=0;$i<count($list);$i++){
                $user =   JUser::getInstance($list[$i]->id_user);
                $municipio = $this->personamodel->getNombreMunicipio($list[$i]->id_municipio);
                $provincia = $this->personamodel->getNombreProvincia($list[$i]->id_provincia);
                $list[$i]->municipio = $municipio->nombre_municipio;
                $list[$i]->provincia = $provincia->nombre_provincia;
                $list[$i]->username = $user->username;
                $rol = $this->personamodel->LoadRolbyUserID($list[$i]->id_user);
                $list[$i]->rol = $rol;
                $rolname = $this->personamodel->loadRoleName($rol);
                $list[$i]->rollon = $rolname->title;

                $list[$i]->password = $user->password;
                $list[$i]->email= $user->email;
                $list[$i]->name = $user->name;
                $list[$i]->telefono_fijo_rh =  $list[$i]->telefono_fijo;

                if($list[$i]->telefono_movil==null)
                    $list[$i]->telefono_movil = "no tiene";

            }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function consultor_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
        $list=$this->personamodel->loadAllConsultors('*');

        echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function rol_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
        $list=$this->personamodel->loadRoles();

        if($list!=false)
            echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function municipio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
        $list=$this->personamodel->loadMunicipios();

        if($list!=false)
            echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function provincia_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->personamodel=JModelLegacy::getInstance('persona');
        $list=$this->personamodel->loadProvincias();

        if($list!=false)
            echo json_encode($list);
        JFactory::getApplication()->close();
    }
    public function persona_add()
    {

        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));

        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_users/models');
        $data = $this->input->post->get('emprendedor', array(), 'array');
        $userdata=JModelLegacy::getInstance('User', 'UsersModel');


        $groups[0] = $data['rol'];

        $data['registerDate']="";
        $data['lastvisitDate']="";
        $data['lastResetTime']="";
        $data['resentCount']=0;
        $data['sendEmail']=0;
        $data['block']=0;
        $data['requireReset']=0;
        $data['id']=0;
        $data['groups']= $groups;
        $data['tags'];
        $data['land_phone1_rh'];
        $data['ui']=true;

        if($data['password']=="")
            $data['password']= "87654321";
        $data['password2']= "87654321";

        $file =  $_FILES['emprendedor'];
        $name = $file['name']['foto_e'];
        $tmp_name=$file['tmp_name']['foto_e'];
        $error = $file['error']['foto_e'];
        $path = JPATH_IMG_UPLOAD_PROFILE.DIRECTORY_SEPARATOR.$name;
        $path=JPath::clean($path);
        if ($error == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r = JFile::upload($tmp_name, $path, false, true);
            if ($r == true)
                $data['foto_perfil'] = $name;
        }

        try {
            $result =  $userdata->save($data);
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
                array('com_persona')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_persona');
            echo $e->getMessage();
            JFactory::getApplication()->close();
        }

    }
    public function persona_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_users/models');
        $data = $this->input->post->get('emprendedor', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $data['id_recurso_humano']=$olditem1->id_recurso_humano ;
        $data['id']=$olditem1->id_user ;

        if($data['password']=="") {
            $data['password'] = $olditem1->password;
            $data['password2'] = $olditem1->password;
        }

        if($data['land_phone_rh']=="")
            $data['land_phone_rh']= $olditem1->telefono_fijo;




        $userdata=JModelLegacy::getInstance('User', 'UsersModel');


        $groups[0] = $data['rol'];

        $data['registerDate']="";
        $data['lastvisitDate']="";
        $data['lastResetTime']="";
        $data['resentCount']=0;
        $data['sendEmail']=0;
        $data['block']=0;
        $data['requireReset']=0;
        $data['groups']= $groups;
        $data['tags'];
        $data['land_phone1_rh'];
        $data['ui']=true;

        $file =  $_FILES['emprendedor'];
        $name = $file['name']['foto_e'];
        $tmp_name=$file['tmp_name']['foto_e'];
        $error = $file['error']['foto_e'];
        $path = JPATH_IMG_UPLOAD_PROFILE.DIRECTORY_SEPARATOR.$name;
        $path=JPath::clean($path);
        if ($error == UPLOAD_ERR_OK) {
            jimport('joomla.filesystem.file');
            $r = JFile::upload($tmp_name, $path, false, true);
            if ($r == true)
                $data['foto_perfil'] = $name;
        }
        if($data['foto_perfil']=="")
            $data['foto_perfil']= $olditem1->foto;

        try {
            $result =  $userdata->save($data);
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
                array('com_persona')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_persona');
            echo $e->getMessage();
            JFactory::getApplication()->close();
        }


    }
    public function persona_delete_one()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        // JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_users/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_negocio/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_publicidad/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_solicitud/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_solicitud_consultoria/models');

        $array = $this->input->post->getArray();
        $persona = json_decode($array['array']) ;
        $userdata=JModelLegacy::getInstance('User', 'UsersModel');
/*        $negocio = JModelLegacy::getInstance('Negocio');
        $publicidad = JModelLegacy::getInstance('Publicidad');
        $consultoriamodel = JModelLegacy::getInstance('Solicitud_Consultoria');
        $solicitudmodel = JModelLegacy::getInstance('Solicitud');*/
        foreach($persona as $p){

            /*
                         $listado_negocios =   $negocio->chargeHisBussines($p->id_user);
                        foreach ($listado_negocios as $bussines){

                            $consultoria =   $consultoriamodel->chargeConsultoriatoDelete($bussines->id_negocio);
                            if($consultoria!=false){
                                foreach($consultoria as $cons){
                                    $consultoriamodel->bind($cons);
                                    $consultoriamodel->delete();
                                }

                            }
                            $solicitud =   $solicitudmodel->chargeSolicitudtoDelete($bussines->id_negocio);
                            $solicitudmodel->bind($solicitud);
                            $solicitudmodel->delete();

                            $listado_publicidad =   $publicidad->chargeHisPublicity($bussines->id_negocio);
                            foreach ($listado_publicidad as $pub){
                                $publicidad->bind($pub);
                                $publicidad->delete();
                            }

                            jimport('joomla.filesystem.file');
                            $path =JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$bussines->foto;
                            $path1=JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$bussines->foto1;
                            $path2=JPATH_IMG_UPLOAD.DIRECTORY_SEPARATOR.$bussines->foto2;
                            $r = JFile::exists($path);
                            if($r!=false)
                                JFile::delete($path);
                            $r1 = JFile::exists($path);
                            if($r1!=false)
                                JFile::delete($path1);
                            $r2 = JFile::exists($path2);
                            if($r2!=false)
                                JFile::delete($path2);

                            $negocio->bind($bussines);
                            $negocio->delete();
                        }*/

            try {

                $result =   $userdata->delete($p->id_user,$p);
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
                    array('com_persona')
                );
                JLog::add($e->getMessage(),JLog::ERROR, 'com_persona');
                echo $e->getMessage();
                JFactory::getApplication()->close();
            }
        }

    }


}
