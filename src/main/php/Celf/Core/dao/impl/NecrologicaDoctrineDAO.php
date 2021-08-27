<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\INecrologicaDAO;

use Celf\Core\model\Necrologica;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Necrologica
 *  
 * @author Marcos
 * 
 */
class NecrologicaDoctrineDAO extends CrudDAO implements INecrologicaDAO{
	
	protected function getClazz(){
		return get_class( new Necrologica() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('n'))
	   				->from( $this->getClazz(), "n");
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(n.oid)')
	   				->from( $this->getClazz(), "n");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere("upper(n.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}
		
		$fechaDesde = $criteria->getFechaDesde();
		if( !empty($fechaDesde) ){
			$queryBuilder->andWhere( "n.fecha >= '" . $fechaDesde->format("Y-m-d") . "'");
		}
	
		$fechaHasta = $criteria->getFechaHasta();
		if( !empty($fechaHasta) ){
			$queryBuilder->andWhere( "n.fecha <= '" . $fechaHasta->format("Y-m-d") . "'");
		}
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "n.$name";	
		}	
		
	}	
}