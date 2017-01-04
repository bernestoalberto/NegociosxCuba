    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableComentario extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */


        public $title;
        public $fecha;
        public $id_categoria;
        public $id_user;
        public $comentario;


	function __construct( &$db ) {
        parent::__construct('#__comentarios','id_comentario', $db);
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
        function loadNegocios()
    {
        $fields = array(
            'id_negocio',
            'nombre_negocio'
        );
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select($fields);
           $query->from('#__negocio');
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
        function getidRRHH($id_negocio)
    {

        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('id');
           $query->from('#__negocio');
           $query->where('id_negocio='.$id_negocio);
        $db->setQuery($query);
        $row=$db->loadObject();

        $correo = $this->loadCorreo($row->id);
        return $correo->email;
    }

        function loadCorreo($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('email');
            $query->from('#__users');
            $query->where('id='.$pk);
            $db->setQuery($query);
            $row=$db->loadObject();
                  if(empty($row))
            {
                return false;
            }
            return $row;
        }

        function loadSolicitud($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('*');
            $query->from($this->getTableName());
            $query->where('id_solicitud='.$pk);
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
        function loadIdSolicitud($pk){
            $db=$this->getDbo();
            $query=$db->getQuery(true);
            $query->select('id_persona');
            $query->from($this->getTableName());
            $query->where('id_solicitud='.$pk);
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
