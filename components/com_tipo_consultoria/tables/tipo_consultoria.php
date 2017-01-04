    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableTipo_Consultoria extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */



        public $consultoria;

	function __construct( &$db ) {
        parent::__construct('#__tipo_consultoria','id_tipo_consultoria', $db);
    }


    
 	function loadAll($key=null,$where=null)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select($key);
        if(!is_null($where) && !empty($where))
            $query->where($where);
        $query->from($this->getTableName());
        $db->escape($query);
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if($db->getErrorNum())
        {            $this->setError($db->getErrorMsg());
            return false;
        }

        if(empty($row))
        {
            return false;
        }
        return $row;
    }

   function loadTipoNombre($id){
       $db=$this->getDbo();
       $query=$db->getQuery(true);
       $query->select('*');
       $query->from($this->getTableName());
       $query->where('id_tipo_consultoria='.$id);
       $db->setQuery($query);
       $row=$db->loadObject();
       if(empty($row))
       {
           return false;
       }
       return $row;
   }
    
 	function loadAllOr($key=null,$where=null)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select($key);
        if(!is_null($where) && !empty($where))
            $query->where($where,'OR');
        $query->from($this->getTableName());
        $db->escape($query);
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if($db->getErrorNum())
        {            $this->setError($db->getErrorMsg());
            return false;
        }

        if(empty($row))
        {
            return false;
        }
        return $row;
    }




}
