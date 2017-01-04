    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableTraza extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

//	public $id_traza;
	public $usuario;
	public $accion;
	public $componente;
	public $fecha;

	function __construct( &$db ) {
        parent::__construct('#__traza','id_traza', $db);
    }

   function insert($traza){
       $db=$this->getDbo();
       $query=$db->getQuery(true);
       $query->insert($this->getTableName())->columns('usuario,accion,componente,fecha')->values($traza);
       $db->escape($query);
       $db->setQuery($query);
       $row=$db->getAffectedRows();
        if(empty($row))
       {
           return false;
       }
       return true;

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
