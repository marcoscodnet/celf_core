<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\INovedadReclamoDAO;

use Celf\Core\model\NovedadReclamo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para NovedadReclamo
 *  
 *  @author Marcos
 * @since 17-07-2020
 * 
 */
class NovedadReclamoDoctrineDAO extends CrudDAO implements INovedadReclamoDAO{
	
	protected function getClazz(){
		return get_class( new NovedadReclamo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('nr', 'er', 'r'))
	   				->from( $this->getClazz(), "nr")
					->leftJoin('nr.estadoReclamo', 'er')
					->leftJoin('nr.reclamo', 'r');
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(nr.oid)')
	   				->from( $this->getClazz(), "nr")
					->leftJoin('nr.estadoReclamo', 'er')
					->leftJoin('nr.reclamo', 'r');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$fecha = $criteria->getFecha();
		if( !empty($fecha) ){
			$queryBuilder->andWhere( "nr.fecha = '" . $fecha->format("Y-m-d") . "'");
		}
		
		
		$reclamo = $criteria->getReclamo();
		if( !empty($reclamo) && $reclamo!=null){
			if (is_object($reclamo)) {
				$reclamoOid = $reclamo->getOid();
				if(!empty($reclamoOid))
					$queryBuilder->andWhere( "r.oid= $reclamoOid" );
			}
			else $queryBuilder->andWhere( "r.nombre like '%$reclamo%'");
		}
		
		
		

		

		/*$estado = $criteria->getEstadoReclamo();
		if( !empty($estado) ){
			$queryBuilder->andWhere( "nr.estadoReclamo = " . $estado );
		}*/

		$procesado = $criteria->getProcesado();
		if( !empty($procesado) ){
			if ($procesado == 2) {
				$queryBuilder->andWhere("upper(nr.procesado)  = 1");
			}
			else 
				$queryBuilder->andWhere("upper(nr.procesado)  = 0");
		}
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "nr.$name";	
		}	
		
	}	
	
	
}