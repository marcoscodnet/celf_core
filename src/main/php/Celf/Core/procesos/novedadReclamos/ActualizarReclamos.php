<?php
namespace Celf\Core\procesos\novedadReclamos;

use Celf\Core\conf\CelfConfig;

use Celf\Core\procesos\ProcesoCelf;

use Celf\Core\utils\CelfUtils;

use Celf\Core\criteria\NovedadReclamoCriteria;

use Celf\Core\service\ServiceFactory;

use Cose\Security\model\Usergroup;
use Cose\Security\model\User;

use Cose\utils\CoseUtils;
use Cose\utils\Logger;
use Cose\persistence\PersistenceContext;

/**
 * Proceso para actualizar reclamos desde el sistema local.
 *
 * @author Marcos
 * @since 17-07-2020
 */
class ActualizarReclamos extends ProcesoCelf{

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/procesos/Celf\Core\procesos.ProcesoCelf::init()
	 */
	protected function init($cronPath){
	
		parent::init($cronPath);
		
		CelfConfig::getInstance()->initLogger( $this->getLogPath() .  "/logActualizarReclamos.xml");
		
	}
	
	public function getNovedadesNoProcesadas(){
	
		$novedadCriteria = new NovedadReclamoCriteria();
		$novedadCriteria->setProcesado(CelfConfig::NOVEDAD_NO_PROCESADA);
	
		return ServiceFactory::getNovedadReclamoService()->getList($novedadCriteria);
	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/procesos/Celf\Core\procesos.ProcesoCelf::doProcess()
	 */
	protected function doProcess(){
		
		
		//1- tomar los procesos de pagos que se encuentran en ejecución.
		
		$novedades = $this->getNovedadesNoProcesadas();
		
		if(is_array($novedades) && count($novedades)>0)
		
		//2- recibimos las notificaciones de los pagos
		foreach ($novedades as $novedad) {
			
			$persistenceContext =  PersistenceContext::getInstance();
			
			//generamos una transacción por novedad.
			$persistenceContext->beginTransaction();

			try {
				
				$service = ServiceFactory::getNovedadReclamoService();
				
				$service->actualizarReclamo($novedad);
								
				$persistenceContext->commit();
		
			} catch (Exception $e) {
				
				$persistenceContext->rollback();
				CelfUtils::log($e->getMessage(), __CLASS__);
				
			} catch (\Exception $e) {
				
				$persistenceContext->rollback();
				CelfUtils::log($e->getMessage(), __CLASS__);
				
			}
			
		}
		
	}
	
	/**
	 * TODO interfaz con gateway de pagos.
	 */
	public function processPagoValidaciones(){
	
		
	}

	/**
	 * TODO interfaz con gateway de pagos.
	 */
	public function processTransferencias(){
	
		
	}
}
