<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class ArticuloController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_articulo';
    public $datamodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->articulomodel=JModelLegacy::getInstance('Articulo');
    }



    public function articulo()
    {
        $base = JFactory::getUri()->base();
        $jss = $base.'/assets/js/tablas/kendo_'.$this->name.'.js';
        array_push(JFactory::getDocument()->_script,$jss);
        $view = $this->getView('Articulo');
        $view->display();
    }
    public function articulo_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_persona/models');
        JModelLegacy::addIncludePath( JPATH_ROOT.'/components/com_negocio/models');


        $this->articulomodel=JModelLegacy::getInstance('Articulo');
        $negociomodel = JModelLegacy::getInstance('Negocio');
        $personamodel = JModelLegacy::getInstance('Persona');
        $list=$this->articulomodel->loadAll('*');
        if($list!=false) {
            for($i=0;$i<count($list); $i++){
                $articulo = $this->articulomodel->loadArticulo($list[$i]->id_articulo);


                $list[$i]->titulo = $articulo->title;
                $list[$i]->editor = $articulo->title;

                $list[$i]->categoria = $articulo->catid;
                $categoria = $negociomodel->loadCategory($articulo->catid);
                $list[$i]->category =$categoria->title ;

                $list[$i]->state = $articulo->state;
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

                $list[$i]->acceso = $articulo->access;
                $categoria = $personamodel->LoadAcceso($articulo->access);
                $list[$i]->access = $categoria->title;


                $usuario = JUser::getInstance($articulo->created_by);
                $list[$i]->autor =$articulo->created_by;
                $list[$i]->author =$usuario->username;
                $list[$i]->palabras_claves =$articulo->metakey;

                if($list[$i]->fotografo != null) {
                    $user = JUser::getInstance($list[$i]->fotografo);
                    $list[$i]->fotograph = $user->username;
                }
                else{
                    $list[$i]->fotograph = "no tiene";
                }

                $list[$i]->inicio_publicacion =$articulo->publish_up;
                $list[$i]->fin_publicacion =$articulo->publish_down;
                $list[$i]->numerito =$articulo->numerito;
                $list[$i]->asset_id =$articulo->asset_id;

            }

            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }
    public function negocio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_ROOT.'/com_articulo/models');
        $datamodel=JModelLegacy::getInstance('Articulo');
        $list=$datamodel->loadNegocios();
        if($list!=false) {

            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }
    public function articulo_add()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_content/models');

        $data = $this->input->post->get('articulo', array(), 'array');
        $articledata=JModelLegacy::getInstance('Article', 'ContentModel');

        $images = array(
            'image_intro' => "",
            'float_intro' => "",
            'image_intro_alt' =>"",
            'image_intro_caption' => "",
            'image_fulltext'=> "",
            'float_fulltext' => "",
            'image_fulltext_alt' => "",
            'image_fulltext_caption' => ""

        );

        $urls = array(
            'urla' => false,
            'urlatex' => "",
            'targeta' => "",
            'urlb' => false,
            'urlbtext' => "",
            'targetb' => "",
            'urlc' => false,
            'urlctext' => "",
            'targetc' => ""
        );
        $metadata = array(
            'robots' => "",
            'author' => "",
            'rights' => "",
            'xreference' => ""

        );
        $attribs = array(
            "show_title"=>""
        ,"link_titles"=>""
        ,"show_intro"=>""
        ,"show_category"=>"",
            "link_category"=>""
        ,"show_parent_category"=>"",
            "link_parent_category"=>"",
            "show_author"=>"",
            "link_author"=>"",
            "show_create_date"=>""
        ,"show_modify_date"=>"",
            "show_publish_date"=>"",
            "show_item_navigation"=>"",
            "show_icons"=>"",
            "show_print_icon"=>"",
            "show_email_icon"=>"",
            "show_vote"=>"",
            "show_hits"=>"",
            "show_noauth"=>"",
            "alternative_readmore"=>"",
            "article_layout"=>"",
            "show_publishing_options"=>"",
            "show_article_options"=>"",
            "show_urls_images_backend"=>"",
            "show_urls_images_frontend"=>""
        );
        if($data['state']=="" || $data['state']==null)
            $data['state']=1;

        $data['title']=$data['titulo_articulo'];
        $data['introtext']=$data['titulo_articulo'];
        $data['catid']=$data['id_categoria'];
        $data['access']=$data['acceso'];
        $data['alias']=lcfirst($data['titulo_articulo']);
        $data['articletext']=$data['editor'];
        $data['created_by']=$data['autor'];
        $data['created_by_alias']="nesty-ClimbX";
        $data['metakey']=$data['palabras_claves'];
        $data['metadesc']=$data['metakey'];
        $data['language']='*';
        $data['featured']=0;
        $data['publish_up']=$data['inicio_publicacion'];
        $data['publish_down']=$data['fin_publicacion'];
        $data['ordering']=0;
        $data['ui']='true';
        $data['images']= $images;
        $data['metadata']= $metadata;
        $data['urls']= $urls;
        $data['attribs']= $attribs;
        $data['numerito']=rand(1,50000);

        if($data['pagina_principal']==null)
            $data['pagina_principal']= 'no';




        try {
            $result =  $articledata->save($data);
            $array=array('success'=>$result);
            echo json_encode($array);
            JFactory::getApplication()->close();
        }
        catch(Exception $e)
        {
            JLog::addLogger(
                array(
                    // Sets file name
                    'text_file' => 'logs.php'
                ),
                // Sets messages of all log levels to be sent to the file
                JLog::ALL,
                array('com_Publicidad')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_articulo');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento no es posible añadirlo';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }
    public function articulo_update()
    {
        // Check for ajax request.
        JSession::isAjaxRequest('server') or  jexit(JText::_('JINVALID_REQUEST'));
        // Check for request forgeries.
        JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        header('Content-Type: application/json');
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_content/models');

        $images = array(
            'image_intro' => "",
            'float_intro' => "",
            'image_intro_alt' =>"",
            'image_intro_caption' => "",
            'image_fulltext'=> "",
            'float_fulltext' => "",
            'image_fulltext_alt' => "",
            'image_fulltext_caption' => ""

        );

        $urls = array(
            'urla' => false,
            'urlatex' => "",
            'targeta' => "",
            'urlb' => false,
            'urlbtext' => "",
            'targetb' => "",
            'urlc' => false,
            'urlctext' => "",
            'targetc' => ""
        );
        $metadata = array(
            'robots' => "",
            'author' => "",
            'rights' => "",
            'xreference' => ""

        );

        $attribs = array(
            "show_title"=>""
        ,"link_titles"=>""
        ,"show_intro"=>""
        ,"show_category"=>"",
            "link_category"=>""
        ,"show_parent_category"=>"",
            "link_parent_category"=>"",
            "show_author"=>"",
            "link_author"=>"",
            "show_create_date"=>""
        ,"show_modify_date"=>"",
            "show_publish_date"=>"",
            "show_item_navigation"=>"",
            "show_icons"=>"",
            "show_print_icon"=>"",
            "show_email_icon"=>"",
            "show_vote"=>"",
            "show_hits"=>"",
            "show_noauth"=>"",
            "alternative_readmore"=>"",
            "article_layout"=>"",
            "show_publishing_options"=>"",
            "show_article_options"=>"",
            "show_urls_images_backend"=>"",
            "show_urls_images_frontend"=>""
        );

        $data = $this->input->post->get('articulo', array(), 'array');
        $olditem = $this->input->post->get('olditem',array(),'array') ;
        $olditem1 =json_decode($olditem[0]);
        $data['id_articulo']=$olditem1->id_articulo ;
        $data['numerito']=$olditem1->numerito ;
        $data['id']=$olditem1->id_articulo ;
        $data['asset_id']=$olditem1->asset_id ;

        $articledata=JModelLegacy::getInstance('Article', 'ContentModel');
        $data['title']=$data['titulo_articulo'];
        $data['catid']=$data['id_categoria'];
        $data['access']=$data['acceso'];
        $data['articletext']=$data['editor'];
        $data['created_by']=$data['autor'];
        $data['metakey']=$data['palabras_claves'];
        $data['metadesc']=$data['metakey'];
        $data['publish_up']=$data['inicio_publicacion'];
        $data['publish_down']=$data['fin_publicacion'];
        $data['ui']='true';
        $data['images']= $images;
        $data['metadata']= $metadata;
        $data['urls']= $urls;
        $data['attribs']= $attribs;

        if($data['state']=="" || $data['state']==null)
            $data['state']=1;

        if($data['pagina_principal']==null)
            $data['pagina_principal']= 'no';




        try {
            $result =  $articledata->save($data);
            $array=array('success'=>$result);
            echo json_encode($array);
            JFactory::getApplication()->close();
        }
        catch(Exception $e)
        {
            JLog::addLogger(
                array(
                    // Sets file name
                    'text_file' => 'logs.php'
                ),
                // Sets messages of all log levels to be sent to the file
                JLog::ALL,
                array('com_Publicidad')
            );
            JLog::add($e->getMessage(),JLog::ERROR, 'com_articulo');
            $response= new stdClass();
            $response->success=false;
            $response->message='Este elemento  no es posible su modificación';
            echo json_encode($response);
            JFactory::getApplication()->close();
        }

    }
    public function articulo_delete()
    {
        // Check for request forgeries.
        //JSession::checkToken('post') or jexit(JText::_('JINVALID_TOKEN'));
        JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR.'/components/com_content/models');
        header('Content-Type: application/json');
        $arreglo = $this->input->post->getArray();
        $data =  json_decode($arreglo['array']);
        $articledata=JModelLegacy::getInstance('Article', 'ContentModel');

        foreach($data as $p){
            try {
                $result =  $articledata->delete($p);
                $array=array('success'=>$result);
                echo json_encode($array);

            }
            catch(Exception $e)
            {
                JLog::addLogger(
                    array(
                        // Sets file name
                        'text_file' => 'logs.php'
                    ),
                    // Sets messages of all log levels to be sent to the file
                    JLog::ALL,
                    array('com_Publicidad')
                );
                JLog::add($e->getMessage(),JLog::ERROR, 'com_articulo');
                $response= new stdClass();
                $response->success=false;
                $response->message='Este elemento esta Asociado no es posible su eliminación';
                echo json_encode($response);
                JFactory::getApplication()->close();
            } }

    }


}
