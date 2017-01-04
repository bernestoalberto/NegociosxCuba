    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableSolicitud_Consultoria extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */



        public $fecha;
        public $tipo_consultoria;
        public $leido;
        public $id_consultor;
        public $descripcion;
        public $estado;
        public $asunto;
        public $id_usuario;
        public $descripcion_denial_acceptance;
        public $asunto_denial_acceptance;
        public $fecha_asignacion;


	function __construct( &$db ) {
        parent::__construct('#__consultoria','id_consultoria', $db);
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
 	function loadAllSinProcesar()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('list_consultoria_sin_procesar');
        $db->escape($query);
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if(empty($row))
        {
            return false;
        }
        return $row;
    }
        function loadAllConsultoriaAsignadas()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('list_consultoria_asignada');
        $db->escape($query);
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if(empty($row))
        {
            return false;
        }
        return $row;
    }

        function chargeConsultoriatoDelete($key)
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
