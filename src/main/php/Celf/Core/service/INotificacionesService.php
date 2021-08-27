<?php
namespace Celf\Core\service;


/**
 * interfaz para el servicio de Notificaciones
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */


use Celf\Core\model\Registracion;
use Celf\Core\model\Reclamo;


interface INotificacionesService {
	
	/**
	 * se envía un email al usuario que se está registrando
	 * para que valide su registración
	 * @param $registracion
	 */
	function notificarValidarRegistracion(Registracion $registracion);
	
	function notificarNuevoReclamo(Reclamo $reclamo);
	
	function notificarModificacionReclamo(Reclamo $reclamo);
	
	
}