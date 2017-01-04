    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Negocio extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_negocio';
	public $negociotable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->negociotable=JTable::getInstance('Negocio');
    }
        function loadNegocio($pk){
            return $this->negociotable->loadNegocio($pk);
        }
        function loadIdNegocio($pk){

            return $this->negociotable->loadIdNegocio($pk);
        }
     function loadNegociobyIdEmprendedor($pk){

            return $this->negociotable->loadNegociobyIdEmprendedor($pk);
        }

 function is_null()    
{
        return $this->negociotable->id_negocio==null;
    }


    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_POST['task'];
        $entidad = $_REQUEST['option'];
        $nombre = $this->negociotable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->negociotable->store();
    }
        function loadNombreNegocio($pk){
            return $this->negociotable->loadNombreNegocio($pk);
        }




    function  bind($negocio)
    {
        return $this->negociotable->bind($negocio);
    }


     function load($pk)
    {
        $this->negociotable->load($pk);
         }


    function loadAll($key,$where=null)
    {
        return $this->negociotable->loadAll($key,$where);
    }
        function loadAllBussinesfromUser($key)
    {
        return $this->negociotable->loadAllBussinesfromUser($key);
    }

        function loadAllUsers()
    {

        return $this->negociotable->loadAllUsers();
    }
        function loadCategories()
    {

        return $this->negociotable->loadCategories();
    }
        function loadAllCategories()
    {

        return $this->negociotable->loadAllCategories();
    }
        function loadCategory($id)
    {

        return $this->negociotable->loadCategory($id);
    }
        function chargePublicidadtoDelete($id)
    {

        return $this->negociotable->chargePublicidadtoDelete($id);
    }

        function chargeHisBussines($pk)
    {
        $where = array(
            'id='.$pk
        );
        return $this->negociotable->chargeHisBussines($where);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->negociotable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->negociotable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->negociotable->delete($pk);
    }
        function  deleteNegociosAsociados($pk)
    {
        $where = array(
            'id'=>$pk
        );
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->negociotable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->negociotable->deleteNegociosAsociados($where);
    }


    function loadAllItem($key,$where=null)
    {
        $modellist=array();
        $lista=$this->negociotable->loadAll($key,$where);
        foreach($lista as $item)
        {
          	 $pk= array(
          	 	'id_proyecto'=>$item->id_proyecto

          	 );

            $perfil_proyectoitem=JModelLegacy::getInstance('Perfil_proyecto');
            $perfil_proyectoitem->load($pk);
            array_push($modellist,$perfil_proyectoitem);
        }
        return $modellist;
    }





}
