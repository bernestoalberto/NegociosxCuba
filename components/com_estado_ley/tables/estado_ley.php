    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableEstado_Ley extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */


        public $estado;

	function __construct( &$db ) {
        parent::__construct('#__estado_ley','id_estado_ley', $db);
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
        function loadEstado($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('estado');
            $query->from($this->getTableName());
            $query->where('id_estado_ley='.$pk);
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
