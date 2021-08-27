<?php
namespace Waliba\Core\dao;

use Cose\exception\DAOException;

use Cose\Crud\dao\ICrudDAO;

/**
 * Interface del DAO de Registracion
 *  
 * @author Bernardo
 * @since 31-12-2014
 *
 */
interface IRegistracionDAO extends ICrudDAO {

	/**
	 * elimina todas las registraciones expiradas.
	 */
	function borrarExpiradas();
}
