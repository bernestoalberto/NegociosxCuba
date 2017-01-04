    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Persona extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_persona';
	public $personatable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->personatable=JTable::getInstance('Persona');

        $this->ejecutorarray_model=array();
        $this->jefeprogramaarray_model=array();
        $this->jefeproyectoarray_model=array();
        $this->secretario_programaarray_model=array();
    }


 function is_null()    
{
        return $this->personatable->id_persona==null;
    }

        function getMunicipio($id){
            return $this->personatable->loadMunicipio($id);
        }
        function getNombreMunicipio($id){
            return $this->personatable->loadNombreMunicipio($id);
        }
        function getProvincia($id){
            return $this->personatable->loadProvincia($id);
        }
        function getNombreProvincia($id){
            return $this->personatable->loadNombreProvincia($id);
        }


    function  store()
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->personatable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->personatable->store();
    }


    function  bind($persona)
    {
        return $this->personatable->bind($persona);
    }


     function load($pk)
    {
        $this->personatable->load($pk);
    }


        function loadAllConsultors(){
        return $this->personatable->loadAllConsultors();
    }
        function loadConsultor($pk){
        return $this->personatable->loadConsultor($pk);
    }

    function loadPersona($pk){
        return $this->personatable->loadPersona($pk);
    }
        function loadPersonaFoto($pk){
        return $this->personatable->loadPersonaFoto($pk);
    }
        function usuario_detalles($pk){
        return $this->personatable->usuario_detalles($pk);
    }
    function loadAll($key,$where=null)
    {
        return $this->personatable->loadAll($key,$where);
    }
        function loadRoles()
    {
        return $this->personatable->loadRoles();
    }

        function LoadAcceso($id)
    {
        return $this->personatable->LoadAcceso($id);
    }
        function loadRoleName($pk)
    {
        return $this->personatable->loadRoleName($pk);
    }
        function LoadRolbyUserID($pk)
    {
        return $this->personatable->LoadRolbyUserID($pk);
    }
        function loadProvincias()
    {
        return $this->personatable->loadProvincias();
    }
        function loadMunicipios()
    {
        return $this->personatable->loadMunicipios();
    }


    function loadAllOr($key,$where=null)
    {
        return $this->personatable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->personatable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->personatable->delete($pk);
    }


    function loadAllItem($key,$where=null)
    {
        $modellist=array();
        $lista=$this->personatable->loadAll($key,$where);
        foreach($lista as $item)
        {
          	 $pk= array(
          	 	'id_persona'=>$item->id_persona

          	 );

            $personaitem=JModelLegacy::getInstance('Persona');
            $personaitem->load($pk);
            array_push($modellist,$personaitem);
        }
        return $modellist;
    }

}
