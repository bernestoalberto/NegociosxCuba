    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableRRHH extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

     
        public $id_user;
        public $identificacion;
        public $telefono_fijo;
        public $telefono_movil;
        public $foto;
        public $calle_principal_address;
        public $primera_entrecalle_address;
        public $segundo_entrecalle_address;
        public $id_municipio;
        public $id_provincia;

	function __construct( &$db ) {
        parent::__construct('#__recursos_humanos','id_recurso_humano', $db);
    }


    
 	function loadAll($key=null,$where=null)
    {
        $db=$this->getDbo();
       $query=$db->getQuery(true);
        $query->select($key);
        if(!is_null($where) && !empty($where))
            //$query->where($where);
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
        function loadProyecto($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('*');
            $query->from($this->getTableName());
            $query->where('id_proyecto='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadAssoc();
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
        function loadIdJefeProyecto($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('id_persona');
            $query->from($this->getTableName());
            $query->where('id_proyecto='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadObject();
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


        function loadNombreProyecto($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('titulo_proyecto');
            $query->from($this->getTableName());
            $query->where('id_proyecto='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadObject();
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
