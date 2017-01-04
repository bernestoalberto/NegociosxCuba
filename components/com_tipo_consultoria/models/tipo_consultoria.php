    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Tipo_Consultoria extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_tipo_consultoria';
	public $tipo_consultoriatable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->tipo_consultoriatable=JTable::getInstance('Tipo_Consultoria');
    }


 function is_null()    
{
        return $this->tipo_consultoriatable->id_proyecto==null;
    }


    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->tipo_consultoriatable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->tipo_consultoriatable->store();
    }



    function  bind($tipo_consultoria)
    {
        return $this->tipo_consultoriatable->bind($tipo_consultoria);
    }
    function  loadTipoNombre($id)
    {
        return $this->tipo_consultoriatable->loadTipoNombre($id);
    }


     function load($pk)
    {
        $this->tipo_consultoriatable->load($pk);
        $this->clasificacionmodel->load( $this->tipo_consultoriatable->id_clasificacion);
        $this->entidadmodel->load( $this->tipo_consultoriatable->id_entidad);
        $this->programamodel->load( $this->tipo_consultoriatable->id_programa);
        $this->tipo_proyectomodel->load( $this->tipo_consultoriatable->numero);
    }


    function loadAll($key,$where=null)
    {
        return $this->tipo_consultoriatable->loadAll($key,$where);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->tipo_consultoriatable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->tipo_consultoriatable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->tipo_consultoriatable->delete($pk);
    }




}
