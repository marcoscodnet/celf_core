<?php
namespace Celf\Core\dao\impl;

use Cose\Security\utils\SecurityUtils;

use Celf\Core\dao\IAsociadoDAO;

use Celf\Core\model\Asociado;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
use Cose\Security\model\User;

/**
 * dao para Asociado
 *  
 * @author Marcos
 * @since 11-05-2020
 * 
 */
class AsociadoDoctrineDAO extends CrudDAO implements IAsociadoDAO{
	
	protected function getClazz(){
		return get_class( new Asociado() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('c','u'))
	   				->from( $this->getClazz(), "c")
	   				->leftJoin('c.usuario', 'u');
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(c.oid)')
	   				->from( $this->getClazz(), "c")
	   				->leftJoin('c.usuario', 'u');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "c.oid <> :oid");
			$queryBuilder->setParameter("oid", $oid );
			
		}
		
		
		$email = $criteria->getEmail();
		if( !empty($email) ){
			$queryBuilder->andWhere( "c.email = :email");
			$queryBuilder->setParameter("email", $email );
		}
		
	
		$nombreApellido = $criteria->getNombreApellido();
		if( !empty($nombreApellido) ){
			$queryBuilder->andWhere( "concat(c.nombre,' ', c.apellido) like :nombreApellido");
			$queryBuilder->setParameter("nombreApellido", "%$nombreApellido%" );
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "c.nombre like :nombre");
			$queryBuilder->setParameter("nombre", "%$nombre%" );
		}
		
		$apellido = $criteria->getApellido();
		if( !empty($apellido) ){
			$queryBuilder->andWhere( "c.apellido like :apellido");
			$queryBuilder->setParameter("nombre", "%$apellido%" );
		}
		
		$nombreEq = $criteria->getNombreEqual();
		if( !empty($nombreEq) ){
			$queryBuilder->andWhere("c.nombre = :nombreEq");
			$queryBuilder->setParameter("nombreEq", $nombreEq );
		}
		

		$documento = $criteria->getDocumento();
		if( !empty($documento) ){
			//$documento = SecurityUtils::aesEncrypt($documento);
			$queryBuilder->andWhere( "c.documento = :documento");
			$queryBuilder->setParameter("documento", $documento );
		}

		$usuario = $criteria->getUsuario();
		if( !empty($usuario) && $usuario!=null){
			if (is_object($usuario)) {
				$usuarioOid = $usuario->getOid();
				if(!empty($usuarioOid))
					$queryBuilder->andWhere( "u.oid= $usuarioOid" );
			}
			else $queryBuilder->andWhere( "u.username like '%$usuario%'");
		}
				
		
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/dao/Celf\Core\dao.IAsociadoDAO::getByUser()
	 */
	public function getByUser(User $user){
	
		try {
			$qb = $this->getEntityManager()->createQueryBuilder();
			
			$qb->select(array('c', 'u'))
	   				->from( $this->getClazz(), "c")
					->leftJoin('c.usuario', 'u');
	   
			$qb->where( "u.oid= :oid");
			$qb->setParameter( "oid", $user->getOid() );
			
			$q = $qb->getQuery();
			
			return $q->getSingleResult();
				
		} catch(\Doctrine\ORM\NoResultException $e){
			throw new DAOException( $e->getMessage() );
			
		} catch (Exception $e) {
			throw new DAOException( $e->getMessage() );
		}
	
		
	}
	
	protected function getFieldName($name){

		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "c.$name";	
		}	
		
	}

	
}