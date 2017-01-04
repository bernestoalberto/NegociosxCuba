<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.log.log');

class RRHHController extends JControllerLegacy
{


    /**
     * Constructor
     *
     * @param object Database connector object
     */

    public $name_component='com_rrhh';
    public $rrhhmodel;


    function __construct() {

        parent::__construct();
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        $this->rrhhmodel=JModelLegacy::getInstance('RRHH');
    }



    public function negocio()
    {
        $base = JFactory::getUri()->base();
        $view = $this->getView('rrhh');
        $view->display();
    }
    public function negocio_json_list()
    {
        header('Content-Type: application/json');
        // Send the response.
        JModelLegacy::addIncludePath( JPATH_COMPONENT.'/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_entidad/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_prioridad/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_programa/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_persona/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_tipo_proyecto/models');
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_clasificacion/models');
        $this->rrhhmodel=JModelLegacy::getInstance('perfil_proyecto');
        $entidadmodel = JModelLegacy::getInstance('entidad');
        $prioridadmodel = JModelLegacy::getInstance('prioridad');
        $programamodel = JModelLegacy::getInstance('programa');
        $tipoproyectomodel = JModelLegacy::getInstance('tipo_proyecto');
        $jefeproyectomodel = JModelLegacy::getInstance('persona');
        $clasificacionmodel = JModelLegacy::getInstance('clasificacion');
        $list=$this->rrhhmodel->loadAll('*');
        if($list!=false) {
            for ($i = 0; $i < count($list); $i++) {
                $entidad = (object)$entidadmodel->loadNombreEntidad($list[$i]->id_entidad);

                if($list[$i]->id_programa==0) {
                    $list[$i]->nombre_programa = '---';

                }
                else{
                    $programa = (object)$programamodel->loadNombrePrograma($list[$i]->id_programa);
                    $list[$i]->nombre_programa =$programa->nombre;
                }
                if($list[$i]->otra_institucion==null)
                    $list[$i]->otra_institucion='---';
                $tipo_proyecto = (object)$tipoproyectomodel->loadNombreTipoProyecto($list[$i]->id_tipo_proyecto);
                $clasificacion = (object)$clasificacionmodel->loadNombreClasificacion($list[$i]->id_clasificacion);
                $jefeproyecto = (object)$jefeproyectomodel->loadNombreJefePersona($list[$i]->id_persona);
                $list[$i]->nombre_entidad = $entidad->nombre;
                $list[$i]->tipo_proyecto = $tipo_proyecto->tipo;
                $list[$i]->nombre_clasificacion = $clasificacion->nombre_clasificacion;
                $list[$i]->nombre_persona = $jefeproyecto->nombre;
                if( $list[$i]->id_prioridad== 0 ||  $list[$i]->id_prioridad == null){
                    $list[$i]->problema = "El problema esta asociado al programa";

                }
                else{
                    $prioridad =  (object) $prioridadmodel->loadProblema($list[$i]->id_prioridad);
                    $list[$i]->problema=$prioridad->problema;
                }
            }


            echo json_encode($list);
        }
        JFactory::getApplication()->close();
    }




}
