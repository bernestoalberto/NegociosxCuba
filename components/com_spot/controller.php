<?php 
 defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');


    class SpotController extends JControllerLegacy
{


     /**
     * Constructor
     *
     * @param object Database connector object
     */

	public $name_component='com_spot';
	public $spotmodel;


	function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->spotmodel=JModelLegacy::getInstance('spot');
    }


    
 public function spot()
    {
 $base = JFactory::getUri()->base();
  $url= $base.'/assets/js/tablas/kendo_banners.js';
  array_push(JFactory::getDocument()->_script,$url);
        $view = $this->getView('spot');
        $view->display();
    }


    
public function spot_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->spotmodel=JModelLegacy::getInstance('spot');
        $list=$this->spotmodel->loadAll();
     for($i=0;$i<count($list);$i++){
         switch($list[$i]->state){
             case 0:
                 $list[$i]->estado="oculto";
                 break;
             case 1:
                 $list[$i]->estado="publicado";
                 break;
             case 2:
                 $list[$i]->estado="archivado";
                 break;
             case -2:
                 $list[$i]->estado="eliminado";
                 break;
         }

     }
        echo json_encode($list);
        JFactory::getApplication()->close();
    }

        public function spot_delete_one()
        {
            // Check for request forgeries.
            //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
            JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
            $array = $this->input->post->getArray();
            $spot =  json_decode($array['array']);
            $this->spotmodel=JModelLegacy::getInstance('spot');
            foreach($spot as $t){
                $this->spotmodel->bind($t);
                try {
                    $this->spotmodel->delete();
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    JFactory::getApplication()->close();
                } }

        }






}
