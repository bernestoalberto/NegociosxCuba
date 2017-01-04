    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Estado_Ley extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_estado_ley';
	public $estado_leytable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->estado_leytable=JTable::getInstance('Estado_Ley');
    }


 function is_null()    
{
        return $this->estado_leytable->id_proyecto==null;
    }


    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->estado_leytable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->estado_leytable->store();
    }


        function loadEstado($pk){
            return $this->estado_leytable->loadEstado($pk);
        }


    function  bind($estado_ley)
    {
        return $this->estado_leytable->bind($estado_ley);
    }


     function load($pk)
    {
        $this->estado_leytable->load($pk);
        $this->clasificacionmodel->load( $this->estado_leytable->id_clasificacion);
        $this->entidadmodel->load( $this->estado_leytable->id_entidad);
        $this->programamodel->load( $this->estado_leytable->id_programa);
        $this->tipo_proyectomodel->load( $this->estado_leytable->numero);
    }


    function loadAll($key,$where=null)
    {
        return $this->estado_leytable->loadAll($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->estado_leytable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->estado_leytable->delete($pk);
    }






}
