<?php
namespace Celf\Core\dao\impl;

use Cose\Security\utils\SecurityUtils;

use Celf\Core\dao\IEstadoReclamoDAO;

use Celf\Core\model\EstadoReclamo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
use Cose\Security\model\User;

/**
 * dao para EstadoReclamo
 *  
 * @author Marcos
 * @since 14-05-2020
 * 
 */
class EstadoReclamoDoctrineDAO extends CrudDAO implements IEstadoReclamoDAO{
	
	protected function getClazz(){
		return get_class( new EstadoReclamo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('er'))
	   				->from( $this->getClazz(), "er");
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(er.oid)')
	   				->from( $this->getClazz(), "er");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		
		
		
		
		
	
		
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "er.nombre like :nombre");
			$queryBuilder->setParameter("nombre", "%$nombre%" );
		}
		
		
		
		
				
		
	}	
	
	
	
	protected function getFieldName($name){

		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "er.$name";	
		}	
		
	}

	
}