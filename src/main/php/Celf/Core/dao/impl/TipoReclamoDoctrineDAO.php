<?php
namespace Celf\Core\dao\impl;

use Cose\Security\utils\SecurityUtils;

use Celf\Core\dao\ITipoReclamoDAO;

use Celf\Core\model\TipoReclamo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
use Cose\Security\model\User;

/**
 * dao para TipoReclamo
 *  
 * @author Marcos
 * @since 12-05-2020
 * 
 */
class TipoReclamoDoctrineDAO extends CrudDAO implements ITipoReclamoDAO{
	
	protected function getClazz(){
		return get_class( new TipoReclamo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('tr', 'a'))
	   				->from( $this->getClazz(), "tr")
	   				->leftJoin('tr.area', 'a');
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(tr.oid)')
	   				->from( $this->getClazz(), "tr")
	   				->leftJoin('tr.area', 'a');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		
		
		
		
		
	
		
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "tr.nombre like :nombre");
			$queryBuilder->setParameter("nombre", "%$nombre%" );
		}
		
		
		$area = $criteria->getArea();
		if( !empty($area) && $area!=null){
			if (is_object($area)) {
				$areaOid = $area->getOid();
				if(!empty($areaOid))
					$queryBuilder->andWhere( "a.oid= $areaOid" );
			}
			else $queryBuilder->andWhere( "a.nombre like '%$area%'");
		}
		
				
		
	}	
	
	
	
	protected function getFieldName($name){

		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "tr.$name";	
		}	
		
	}

	
}