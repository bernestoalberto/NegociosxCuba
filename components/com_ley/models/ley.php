    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class Ley extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_ley';
	public $negociotable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->negociotable=JTable::getInstance('Ley');
    }
        function loadLey($pk){
            return $this->negociotable->loadLey($pk);
        }
        function loadMinLey(){
            return $this->negociotable->loadMinLey();
        }
        function loadIdLey($pk){

            return $this->negociotable->loadIdLey($pk);
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
        function loadNombreLey($pk){
            return $this->negociotable->loadNombreLey($pk);
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

        function loadAllUsers()
    {

        return $this->negociotable->loadAllUsers();
    }
        function loadCategories()
    {

        return $this->negociotable->loadCategories();
    }
        function loadCategory($id)
    {

        return $this->negociotable->loadCategory($id);
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
        function  deleteLeysAsociados($pk)
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
        return $this->negociotable->deleteLeysAsociados($where);
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




   function getPerfil_proyectoModelArray($condition)    {
       $perfil_proyectoarraymodel= array();
       $perfil_proyectolist=$this->loadAll('*',$condition);
		if(!$perfil_proyectolist)
           return $perfil_proyectoarraymodel;
        foreach($perfil_proyectolist as $item)
        {
          	 $perfil_proyectopk= array(
          	 	'id_proyecto'=>$item->id_proyecto

          	 );
            $item=JModelLegacy::getInstance('Perfil_proyecto');
          	 $item->load($perfil_proyectopk);
            array_push($perfil_proyectoarraymodel,$item);
        }
        return $perfil_proyectoarraymodel;
    }


     function load_dependences()
    {
        
        //Dependencia con la tabla Dictamen_eval_perfil_proy
        $path=FOFPlatform::getInstance()->getComponentBaseDirs('com_dictamen_eval_perfil_proy');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $condition=array(
          	 	'0'=>'id_proyecto='.$this->negociotable->id_proyecto
        	);
        $dictamen_eval_perfil_proy=JModelLegacy::getInstance('Dictamen_eval_perfil_proy');
        $this->dictamen_eval_perfil_proyarray_model=$dictamen_eval_perfil_proy->getDictamen_eval_perfil_proyModelArray($condition);
        
        //Dependencia con la tabla Jefeproyecto
        $path=FOFPlatform::getInstance()->getComponentBaseDirs('com_jefeproyecto');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $condition=array(
          	 	'0'=>'id_proyecto='.$this->negociotable->id_proyecto
        	);
        $jefeproyecto=JModelLegacy::getInstance('Jefeproyecto');
        $this->jefeproyectoarray_model=$jefeproyecto->getJefeproyectoModelArray($condition);
        
        //Dependencia con la tabla Proyecto
        $path=FOFPlatform::getInstance()->getComponentBaseDirs('com_proyecto');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $condition=array(
          	 	'0'=>'id_proyecto='.$this->negociotable->id_proyecto
        	);
        $proyecto=JModelLegacy::getInstance('Proyecto');
        $this->proyectoarray_model=$proyecto->getProyectoModelArray($condition);

    }


}
