<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\ICorreoDAO;

use Celf\Core\model\Correo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Correo
 *  
 * @author Marcos
 * 
 */
class CorreoDoctrineDAO extends CrudDAO implements ICorreoDAO{
	
	protected function getClazz(){
		return get_class( new Correo() );
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
	
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere("upper(c.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}
		
		$email = $criteria->getEmail();
		if( !empty($email) ){
			$queryBuilder->andWhere("upper(c.email)  like :email");
			$queryBuilder->setParameter( "email" , "%$email%" );
		}
		
		
		
		$activo = $criteria->getActivo();
		if( !empty($activo) ){
			if ($activo == 2) {
				$queryBuilder->andWhere("upper(c.activo)  = 1");
			}
			else 
				$queryBuilder->andWhere("upper(c.activo)  = 0");
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