<?php
namespace Celf\Core\service;


use Celf\Core\model\Asociado;

use Cose\Crud\service\ICrudService;
use Cose\Security\model\User;

/**
 * interfaz para el servicio de Asociado
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */
interface IAsociadoService extends ICrudService {

	
	
	/**
	 * Retorna true si existe un cliente dado un tipo y número de documento. 
	 * @param TipoDocumento $tipo
	 * @param string $numero
	 */
	function existsByDocumento($numero, $oid=null);
	
	/**
	 * Retorna true si existe un cliente para el mismo email
	 * @param string $email
	 */
	function existsByEmail( $email, $oid=null);
	
	/**
	 * Retorna el cliente asociado a un usuario.
	 * @param User $user
	 */
	function getByUser(User $user);
	
	
		
	
}