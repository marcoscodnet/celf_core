<?php
namespace Celf\Core\dao;

use Cose\exception\DAOException;

use Cose\Crud\dao\ICrudDAO;

use Cose\Security\model\User;


/**
 * Interface del DAO de Asociado
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */
interface IAsociadoDAO extends ICrudDAO {

	/**
	 * retorna el cliente asociado al user.
	 * @param User $user
	 */
	public function getByUser(User $user);
}
