    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Publicidad extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_publicidad';
	public $publicidadtable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->publicidadtable=JTable::getInstance('Publicidad');
    }



    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->publicidadtable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->publicidadtable->store();
    }
        



    function  bind($publicidad)
    {
        return $this->publicidadtable->bind($publicidad);
    }


     function load($pk)
    {
        $this->publicidadtable->load($pk);
        $this->clasificacionmodel->load( $this->publicidadtable->id_clasificacion);
        $this->entidadmodel->load( $this->publicidadtable->id_entidad);
        $this->programamodel->load( $this->publicidadtable->id_programa);
        $this->tipo_proyectomodel->load( $this->publicidadtable->numero);
    }


    function loadAll($key,$where=null)
    {
        return $this->publicidadtable->loadAll($key,$where);
    }

        function loadPublicidadSinProcesar()
    {
        return $this->publicidadtable->loadPublicidadSinProcesar();
    }
        function loadPublicidadProcesada()
    {
        return $this->publicidadtable->loadPublicidadProcesada();
    }
        function chargeHisPublicity($key)
    {
        return $this->publicidadtable->chargeHisPublicity($key);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->publicidadtable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->publicidadtable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->publicidadtable->delete($pk);
    }

}
