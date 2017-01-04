    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTablePersona extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */

      //  public $id_persona;
        public $id_user;
        public $identificacion;
        public $direccion;
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
        function usuario_detalles($key)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from($this->getTableName());
        $query->where("id_user=".$key);
        $db->escape($query);
        $db->setQuery($query);
        $row=$db->loadObject();

        if(empty($row))
        {
            return false;
        }
        return $row;
    }
 	function loadRoles()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('view_roles');
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
        function loadRoleName($pk)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('title');
        $query->from('#__usergroups');
        $query->where('id='.$pk);

        $db->setQuery($query);
        $row=$db->loadObject();
        if(empty($row))
        {
            return false;
        }
        return $row;
    }
        function loadAllConsultors()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('view_consultor');
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
        function loadProvincias()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('#__provincia');
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
        function loadMunicipios()
    {

        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('#__municipio');
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

        function LoadAcceso($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('title');
            $query->from('#__usergroups');
            $query->where('id='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadObject();
            if(empty($row))
            {
                return false;
            }
            return $row;
        }
        function loadPersonaFoto($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('foto');
            $query->from('#__recursos_humanos');
            $query->where('id_user='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadObject();
            if(empty($row))
            {
                return false;
            }
            return $row;
        }
        function LoadRolbyUserID($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('group_id');
            $query->from('#__user_usergroup_map');
            $query->where('user_id='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadObject();
            if(empty($row))
            {
                return false;
            }
            return $row->group_id;
        }

        function loadNombreMunicipio($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('nombre_municipio');
            $query->from('#__municipio');
            $query->where('id_municipio='.$pk);
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
        function loadNombreProvincia($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('nombre_provincia');
            $query->from('#__provincia');
            $query->where('id_provincia='.$pk);
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


        function loadPersona($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('*');
            $query->from($this->getTableName());
           // $query->where('id_persona='.$pk);
            $query->where('id_user='.$pk);
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
        function loadConsultor($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('username');
            $query->from('#__users');
            $query->where('id='.$pk);
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
        function loadMunicipio($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('*');
            $query->from('#__municipio');
            $query->where('id_municipio='.$pk);
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
        function loadProvincia($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('*');
            $query->from('#__provincia');
            $query->where('id_provincia='.$pk);
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
