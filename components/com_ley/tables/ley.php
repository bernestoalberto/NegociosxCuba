
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableLey extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */
        public $numero_gaceta;
        public $palabras_claves_general;
        public $acceso;
        public $id_estado_ley;
        public $documento;
        public $imagen;
        public $incluir_pagina_principal;
        public $inicio_publicacion;
        public $fin_publicacion;
        public $autor;
        public $bajante;
        public $anuncio;
        public $palabras_claves_info;
        public $tipo_ley;
        public $numero_ley;
        public $anyo_ley;
         public $anyo_gaceta;
         public $organismo;
         public $epigrafe;


	function __construct( &$db ) {
        parent::__construct('#__ley','id_ley', $db);
    }


    
 	function loadAll($key=null,$where=null)
    {
        $db=$this->getDbo();
       $query=$db->getQuery(true);
        $query->select($key);
        $query->from($this->getTableName());
        if(!is_null($where) && !empty($where))
            $query->where($where);
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
        function loadMinLey()
    {
        $db=$this->getDbo();
       $query=$db->getQuery(true);
        $query->select('id_ley,numero_gaceta,anyo_gaceta');
        $query->from($this->getTableName());
        $db->setQuery($query);
        $row=$db->loadObjectList();
        if(empty($row))
        {
            return false;
        }
        return $row;
    }
        function loadAllUsers()
    {
        $db=$this->getDbo();
       $query=$db->getQuery(true);
        $query->select('*');
        $query->from('view_user_bussines');
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
        function loadCategories()
    {
        $fields = array(
            'id',
            'title'
        );
        $db=$this->getDbo();
       $query=$db->getQuery(true);
        $query->select($fields);
        $query->from('#__categories');
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
        function loadCategory($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('title');
            $query->from('#__categories');
            $query->where('id='.$pk);
            $db->setQuery($query);
            $row=$db->loadObject();
            if(empty($row))
            {
                return false;
            }
            return $row;
        }
        function loadNegocio($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('*');
            $query->from($this->getTableName());
            $query->where('id_negocio='.$pk);
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
            $query->where('id_negocio='.$pk);
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


        function loadNombreNegocio($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('nombre_negocio');
            $query->from($this->getTableName());
            $query->where('id_negocio='.$pk);
            $db->escape($query);
            $db->setQuery($query);
            $row=$db->loadObject();

            if(empty($row))
            {
                return false;
            }
            return $row->nombre_negocio;
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
        function chargeHisBussines($where)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from($this->getTableName());
        $query->where($where);
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
 	function deleteNegociosAsociados($where)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->delete($this->getTableName());
        $query->where($where);
        $db->escape($query);
        $db->setQuery($query);
        $row=$db->getAffectedRows();
        if($db->getErrorNum())
        {            $this->setError($db->getErrorMsg());
            return false;
        }

        return $row;
    }




}
