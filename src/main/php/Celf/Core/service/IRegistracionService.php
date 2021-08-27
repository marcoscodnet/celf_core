<?php
namespace Celf\Core\service;


use Cose\Crud\service\ICrudService;
use Celf\Core\model\Registracion;

/**
 * interfaz para el servicio de Registracion
 *  
 * @author Marcos
 * @since 09-05-2020
 *
 */
interface IRegistracionService extends ICrudService {
	/**
	 * retorna una registración dado su código de validación.
	 * @param $codigoValidacion
	 * @return Registracion
	 */
	function getByCodigoValidacion( $codigoValidacion );

	/**
	 * confirmar una registración pendiente creando el usuario
	 * asociado.
	 * @param string $codigoValidacion
	 * @return User
	 */
	function confirmar( $codigoValidacion );
	
	/**
	 * se eliminan todas las registraciones expiradas.
	 */
	function borrarExpiradas();
}