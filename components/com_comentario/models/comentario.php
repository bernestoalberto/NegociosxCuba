    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Comentario extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_comentario';
	public $solicitudtable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->solicitudtable=JTable::getInstance('Comentario');
    }
        function loadSolicitud($pk){
            return $this->solicitudtable->loadSolicitud($pk);
        }




    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->solicitudtable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->solicitudtable->store();
    }




    function  bind($perfil_proyecto)
    {
        return $this->solicitudtable->bind($perfil_proyecto);
    }


     function load($pk)
    {
        $this->solicitudtable->load($pk);
        $this->clasificacionmodel->load( $this->solicitudtable->id_clasificacion);
        $this->entidadmodel->load( $this->solicitudtable->id_entidad);
        $this->programamodel->load( $this->solicitudtable->id_programa);
        $this->tipo_proyectomodel->load( $this->solicitudtable->numero);
    }

        function SendEmailtoEmprendedor($correoReceptor, $correoRemitente, $nombreRemitente,$estado,$descripcion){
            $mailer = JFactory::getMailer();
            $mailer->setSender( array( $correoRemitente, $nombreRemitente ) );
            $mailer->addRecipient( $correoReceptor );
            $mailer->setSubject( 'Estado de su solicitud en NegociosXCuba' );
            if($estado==1)
            $mailer->setBody('Su solcitud de engocio ha sido el aceptada');
            else
                $mailer->setBody('Su solcitud de engocio ha sido rechazada. Presenta la siguiente descripcion'.
                    $descripcion);
            $mailer->Send();
        }

    function loadAll($key,$where=null)
    {
        return $this->solicitudtable->loadAll($key,$where);
    }
        function loadNegocios()
    {
        return $this->solicitudtable->loadNegocios();
    }
        function getidRRHH($id_neogcio)
    {
        return $this->solicitudtable->getidRRHH($id_neogcio);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->solicitudtable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->solicitudtable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->solicitudtable->delete($pk);
    }


    function loadAllItem($key,$where=null)
    {
        $modellist=array();
        $lista=$this->solicitudtable->loadAll($key,$where);
        foreach($lista as $item)
        {
          	 $pk= array(
          	 	'id_proyecto'=>$item->id_proyecto

          	 );

            $solicituditem=JModelLegacy::getInstance('Solicitud');
            $solicituditem->load($pk);
            array_push($modellist,$solicituditem);
        }
        return $modellist;
    }







}
