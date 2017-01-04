    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Solicitud_Consultoria extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_solicitud_consultoria';
	public $solicitud_consultoriatable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->solicitud_consultoriatable=JTable::getInstance('Solicitud_Consultoria');
    }



    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->solicitud_consultoriatable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->solicitud_consultoriatable->store();
    }
        function loadNombreProyecto($pk){
            return $this->solicitud_consultoriatable->loadNombreProyecto($pk);
        }

        function loadProyecto($pk){
            return $this->solicitud_consultoriatable->loadProyecto($pk);
        }
        function loadAllSinProcesar(){
            return $this->solicitud_consultoriatable->loadAllSinProcesar();
        }
       function loadAllConsultoriaAsignadas(){
            return $this->solicitud_consultoriatable->loadAllConsultoriaAsignadas();
        }


    function  bind($perfil_proyecto)
    {
        return $this->solicitud_consultoriatable->bind($perfil_proyecto);
    }
   function  chargeConsultoriatoDelete($key)
    {
        return $this->solicitud_consultoriatable->chargeConsultoriatoDelete($key);
    }


     function load($pk)
    {
        $this->solicitud_consultoriatable->load($pk);
        $this->clasificacionmodel->load( $this->solicitud_consultoriatable->id_clasificacion);
        $this->entidadmodel->load( $this->solicitud_consultoriatable->id_entidad);
        $this->programamodel->load( $this->solicitud_consultoriatable->id_programa);
        $this->tipo_proyectomodel->load( $this->solicitud_consultoriatable->numero);
    }


    function loadAll($key,$where=null)
    {
        return $this->solicitud_consultoriatable->loadAll($key,$where);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->solicitud_consultoriatable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->solicitud_consultoriatable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->solicitud_consultoriatable->delete($pk);
    }

}
