    
<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class RRHH extends JModelLegacy
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_rrhh';
	public $rrhhtable;

	function __construct( &$db ) {

        $path=FOFPlatform::getInstance()->getComponentBaseDirs($this->name_component);
        JTable::addIncludePath( $path['site'].'/tables');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $this->rrhhtable=JTable::getInstance('RRHH');
    }
        function loadPerfilProyecto($pk){
            return $this->rrhhtable->loadProyecto($pk);
        }
        function loadIdJefeProyecto($pk){

            return $this->rrhhtable->loadIdJefeProyecto($pk);
        }

 function is_null()    
{
        return $this->rrhhtable->id_proyecto==null;
    }


    function  store()
    {
        //Crear traza
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->rrhhtable->getTableName();
        $trazamodel->CreateTrace($accion,$entidad,$nombre);
        return $this->rrhhtable->store();
    }
        function loadNombreProyecto($pk){
            return $this->rrhhtable->loadNombreProyecto($pk);
        }

        function loadProyecto($pk){
            return $this->rrhhtable->loadProyecto($pk);
        }


    function  bind($rrhh)
    {
        return $this->rrhhtable->bind($rrhh);
    }


     function load($pk)
    {
        $this->rrhhtable->load($pk);
        $this->clasificacionmodel->load( $this->rrhhtable->id_clasificacion);
        $this->entidadmodel->load( $this->rrhhtable->id_entidad);
        $this->programamodel->load( $this->rrhhtable->id_programa);
        $this->tipo_proyectomodel->load( $this->rrhhtable->numero);
    }


    function loadAll($key,$where=null)
    {
        return $this->rrhhtable->loadAll($key,$where);
    }


    function loadAllOr($key,$where=null)
    {
        return $this->rrhhtable->loadAllOr($key,$where);
    }


    function  delete($pk=null)
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_traza/models');
        $trazamodel = JModelLegacy::getInstance('Traza');
        $accion= $_GET['task'];
        $entidad = $_REQUEST['view'];
        $nombre = $this->rrhhtable->nombre;
        $trazamodel->CreateTrace($accion,$entidad,$this->name_component ,$nombre);
        return $this->rrhhtable->delete($pk);
    }


    function loadAllItem($key,$where=null)
    {
        $modellist=array();
        $lista=$this->rrhhtable->loadAll($key,$where);
        foreach($lista as $item)
        {
          	 $pk= array(
          	 	'id_proyecto'=>$item->id_proyecto

          	 );

            $rrhhitem=JModelLegacy::getInstance('Perfil_proyecto');
            $rrhhitem->load($pk);
            array_push($modellist,$rrhhitem);
        }
        return $modellist;
    }




   function getPerfil_proyectoModelArray($condition)    {
       $rrhharraymodel= array();
       $rrhhlist=$this->loadAll('*',$condition);
		if(!$rrhhlist)
           return $rrhharraymodel;
        foreach($rrhhlist as $item)
        {
          	 $rrhhpk= array(
          	 	'id_proyecto'=>$item->id_proyecto

          	 );
            $item=JModelLegacy::getInstance('Perfil_proyecto');
          	 $item->load($rrhhpk);
            array_push($rrhharraymodel,$item);
        }
        return $rrhharraymodel;
    }


     function load_dependences()
    {
        
        //Dependencia con la tabla Dictamen_eval_perfil_proy
        $path=FOFPlatform::getInstance()->getComponentBaseDirs('com_dictamen_eval_perfil_proy');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $condition=array(
          	 	'0'=>'id_proyecto='.$this->rrhhtable->id_proyecto
        	);
        $dictamen_eval_perfil_proy=JModelLegacy::getInstance('Dictamen_eval_perfil_proy');
        $this->dictamen_eval_perfil_proyarray_model=$dictamen_eval_perfil_proy->getDictamen_eval_perfil_proyModelArray($condition);
        
        //Dependencia con la tabla Jefeproyecto
        $path=FOFPlatform::getInstance()->getComponentBaseDirs('com_jefeproyecto');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $condition=array(
          	 	'0'=>'id_proyecto='.$this->rrhhtable->id_proyecto
        	);
        $jefeproyecto=JModelLegacy::getInstance('Jefeproyecto');
        $this->jefeproyectoarray_model=$jefeproyecto->getJefeproyectoModelArray($condition);
        
        //Dependencia con la tabla Proyecto
        $path=FOFPlatform::getInstance()->getComponentBaseDirs('com_proyecto');
        JModelLegacy::addIncludePath( $path['site'].'/models');
        $condition=array(
          	 	'0'=>'id_proyecto='.$this->rrhhtable->id_proyecto
        	);
        $proyecto=JModelLegacy::getInstance('Proyecto');
        $this->proyectoarray_model=$proyecto->getProyectoModelArray($condition);

    }


}
