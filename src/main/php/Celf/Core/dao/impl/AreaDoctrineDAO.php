<?php
namespace Celf\Core\dao\impl;

use Cose\Security\utils\SecurityUtils;

use Celf\Core\dao\IAreaDAO;

use Celf\Core\model\Area;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
use Cose\Security\model\User;

/**
 * dao para Area
 *  
 * @author Marcos
 * @since 12-05-2020
 * 
 */
class AreaDoctrineDAO extends CrudDAO implements IAreaDAO{
	
	protected function getClazz(){
		return get_class( new Area() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('c'))
	   				->from( $this->getClazz(), "c");
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(c.oid)')
	   				->from( $this->getClazz(), "c");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		
		
		
		$email = $criteria->getEmail();
		if( !empty($email) ){
			$queryBuilder->andWhere( "c.email = :email");
			$queryBuilder->setParameter("email", $email );
		}
		
	
		
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "c.nombre like :nombre");
			$queryBuilder->setParameter("nombre", "%$nombre%" );
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