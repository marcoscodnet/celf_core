<?php
namespace Celf\Core\dao;

use Cose\exception\DAOException;

use Cose\Crud\dao\ICrudDAO;

/**
 * Interface del DAO de Registracion
 *  
 * @author Marcos
 * @since 09-05-2020
 *
 */
interface IRegistracionDAO extends ICrudDAO {

	/**
	 * elimina todas las registraciones expiradas.
	 */
	function borrarExpiradas();
}
