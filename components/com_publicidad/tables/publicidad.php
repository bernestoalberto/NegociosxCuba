    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTablePublicidad extends JTable
{

     /**
     * Constructor
     *
     * @param object Database connector object
     */


        public $id_user;
        public $asunto;
        public $fecha;
        public $fecha_modificacion;
        public $descripcion;
        public $estado;
        public $id_persona;
        public $leido;
        public $descripcion_asig_publicidad;


	function __construct( &$db ) {
        parent::__construct('#__publicidad','id_publicidad', $db);
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
        function loadPublicidadSinProcesar()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('publicidad_sin_procesar');
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if(empty($row))
        {
            return false;
        }
        return $row;
    }
        function loadPublicidadProcesada()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('publicidad_procesada');
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if(empty($row))
        {
            return false;
        }
        return $row;
    }
        function chargeHisPublicity($key)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from($this->getTableName());
        $query->where('asunto='.$key);
        $db->setQuery($query);
        $row=$db->loadObjectList();
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
