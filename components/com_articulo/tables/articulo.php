    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableArticulo extends JTable
{

     /**
     * Constructor
     *
     * @param object Database connector object
     */


        public $id_articulo;
        public $epigrafe;
        public $bajante;
        public $anuncio;
        public $fotografo;
        public $ley_asociada;
        public $pagina_principal;



	function __construct( &$db ) {
        parent::__construct('#__articulo','id_articulo', $db);
        $this->_autoincrement=false;
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
 	function loadIdArticulo($number)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('id');
        $query->from('#__content');
        $query->where('numerito='.$number);
        $db->setQuery($query);
        $row=$db->loadObject();


        if(empty($row))
        {
            return false;
        }
        return $row;
    }
        function loadArticulo($id)
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from('#__content');
        $query->where('id='.$id);
        $db->setQuery($query);
        $row=$db->loadObject();


        if(empty($row))
        {
            return false;
        }
        return $row;
    }





}
