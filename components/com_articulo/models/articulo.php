    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Articulo extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_articulo';
	public $articulotable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->articulotable=JTable::getInstance('Articulo');
    }



    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->articulotable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->articulotable->store();
    }
        



    function  bind($articulo)
    {
        return $this->articulotable->bind($articulo);
    }


     function load($pk)
    {
        $this->articulotable->load($pk);
        $this->clasificacionmodel->load( $this->articulotable->id_clasificacion);
        $this->entidadmodel->load( $this->articulotable->id_entidad);
        $this->programamodel->load( $this->articulotable->id_programa);
        $this->tipo_proyectomodel->load( $this->articulotable->numero);
    }


    function loadAll($key,$where=null)
    {
        return $this->articulotable->loadAll($key,$where);
    }
        function loadIdArticulo($number)
    {
        return $this->articulotable->loadIdArticulo($number);
    }
        function loadArticulo($id)
    {
        return $this->articulotable->loadArticulo($id);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->articulotable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->articulotable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->articulotable->delete($pk);
    }

}
