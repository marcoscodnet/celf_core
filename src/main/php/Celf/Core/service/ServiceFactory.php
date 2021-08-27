<?php
namespace Celf\Core\service;

/**
 * Factory de servicios
 *  
 *  
 * @author Marcos
 * @since 03-05-2018
 *
 */

use Celf\Core\service\impl\AbonadoServiceImpl;

use Celf\Core\service\impl\NecrologicaServiceImpl;

use Celf\Core\service\impl\CorreoServiceImpl;

use Celf\Core\service\impl\FacturaServiceImpl;

use Celf\Core\service\impl\RegistracionServiceImpl;

use Celf\Core\service\impl\AsociadoServiceImpl;
use Celf\Core\service\impl\NotificacionesServiceImpl;

use Celf\Core\service\impl\AreaServiceImpl;
use Celf\Core\service\impl\TipoReclamoServiceImpl;



use Celf\Core\service\impl\ReclamoServiceImpl;
use Celf\Core\service\impl\EstadoReclamoServiceImpl;
use Celf\Core\service\impl\InstanciaReclamoServiceImpl;
use Celf\Core\service\impl\NovedadReclamoServiceImpl;


class ServiceFactory {


	
	
	
	
	
	
	/**
	 * Service para Abonado.
	 * 
	 * @return IAbonadoService
	 */
	public static function getAbonadoService(){
	
		return new AbonadoServiceImpl();	
	}
	
	
	/**
	 * Service para Necrologica.
	 * 
	 * @return INecrologicaService
	 */
	public static function getNecrologicaService(){
	
		return new NecrologicaServiceImpl();	
	}
	
	/**
	 * Service para Correo.
	 * 
	 * @return ICorreoService
	 */
	public static function getCorreoService(){
	
		return new CorreoServiceImpl();	
	}
	
	/**
	 * Service para Factura.
	 * 
	 * @return IFacturaService
	 */
	public static function getFacturaService(){
	
		return new FacturaServiceImpl();	
	}
	
	/**
	 * Service para Registracion.
	 * 
	 * @return IRegistracionService
	 */
	public static function getRegistracionService(){
	
		return new RegistracionServiceImpl();	
	}
	
	/**
	 * Service para Asociado.
	 * 
	 * @return IAsociadoService
	 */
	public static function getAsociadoService(){
	
		return new AsociadoServiceImpl();	
	}
	
	/**
	 * Service para Notificaciones.
	 * 
	 * @return INotificacionesService
	 */
	public static function getNotificacionesService(){
	
		return new NotificacionesServiceImpl();	
	}
	
	/**
	 * Service para Area.
	 * 
	 * @return IAreaService
	 */
	public static function getAreaService(){
	
		return new AreaServiceImpl();	
	}
	
	/**
	 * Service para TipoReclamo.
	 * 
	 * @return ITipoReclamoService
	 */
	public static function getTipoReclamoService(){
	
		return new TipoReclamoServiceImpl();	
	}
	
	/**
	 * Service para Reclamo.
	 * 
	 * @return IReclamoService
	 */
	public static function getReclamoService(){
	
		return new ReclamoServiceImpl();	
	}
	
	/**
	 * Service para InstanciaReclamo.
	 * 
	 * @return IInstanciaReclamoService
	 */
	public static function getInstanciaReclamoService(){
	
		return new InstanciaReclamoServiceImpl();	
	}
	
	/**
	 * Service para EstadoReclamo.
	 * 
	 * @return IEstadoReclamoService
	 */
	public static function getEstadoReclamoService(){
	
		return new EstadoReclamoServiceImpl();	
	}
	
	/**
	 * Service para NovedadReclamo.
	 * 
	 * @return INovedadReclamoService
	 */
	public static function getNovedadReclamoService(){
	
		return new NovedadReclamoServiceImpl();	
	}
	
}