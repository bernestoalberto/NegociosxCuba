    
<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
    class JTableSpot extends JTable
{



     /**
     * Constructor
     *
     * @param object Database connector object
     */



	function __construct( &$db ) {
            parent::__construct('list_banners','', $db);
    }


    
 	function loadAll()
    {
        $db=$this->getDbo();
        $query=$db->getQuery(true);
        $query->select('*');
        $query->from($this->getTableName());
        $db->setQuery($query);
        $row=$db->loadObjectList();
            if(empty($row))
        {
            return false;
        }
        return $row;
    }


    





}
