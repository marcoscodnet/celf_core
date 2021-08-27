<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\IInstanciaReclamoDAO;

use Celf\Core\model\InstanciaReclamo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para InstanciaReclamo
 *  
 *  @author Marcos
 * @since 14-05-2020
 * 
 */
class InstanciaReclamoDoctrineDAO extends CrudDAO implements IInstanciaReclamoDAO{
	
	protected function getClazz(){
		return get_class( new InstanciaReclamo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('ir', 'er', 'u', 'r'))
	   				->from( $this->getClazz(), "ir")
					->leftJoin('ir.estadoReclamo', 'er')
					->leftJoin('ir.reclamo', 'r')
					->leftJoin('ir.usuario', 'u');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(ir.oid)')
	   				->from( $this->getClazz(), "ir")
					->leftJoin('ir.estadoReclamo', 'er')
					->leftJoin('ir.reclamo', 'r')
					->leftJoin('ir.usuario', 'u');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$desde = $criteria->getDesde();
		if( !empty($desde) ){
			$queryBuilder->andWhere( "ir.desde = '" . $desde->format("Y-m-d") . "'");
		}
		
		$desdeDesde = $criteria->getDesdeDesde();
		if( !empty($desdeDesde) ){
			$queryBuilder->andWhere( "ir.desde >= '" . $desdeDesde->format("Y-m-d") . "'");
		}
	
		$desdeHasta = $criteria->getDesdeHasta();
		if( !empty($desdeHasta) ){
			$queryBuilder->andWhere( "ir.desde <= '" . $desdeHasta->format("Y-m-d") . "'");
		}
		
		$hasta = $criteria->getDesde();
		if( !empty($hasta) ){
			$queryBuilder->andWhere( "ir.hasta = '" . $hasta->format("Y-m-d") . "'");
		}
		
		$hastaDesde = $criteria->getHastaDesde();
		if( !empty($hastaDesde) ){
			$queryBuilder->andWhere( "ir.hasta >= '" . $hastaDesde->format("Y-m-d") . "'");
		}
	
		$hastaHasta = $criteria->getHastaHasta();
		if( !empty($hastaHasta) ){
			$queryBuilder->andWhere( "ir.hasta <= '" . $hastaHasta->format("Y-m-d") . "'");
		}
				
		$usuario = $criteria->getUsuario();
		if( !empty($usuario) && $usuario!=null){
			if (is_object($usuario)) {
				$usuarioOid = $usuario->getOid();
				if(!empty($usuarioOid))
					$queryBuilder->andWhere( "u.oid= $usuarioOid" );
			}
			else $queryBuilder->andWhere( "u.nombre like '%$usuario%'");
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
		
		
		

		$estadoNot = $criteria->getEstadoNotEqual();
		if( !empty($estadoNot) ){
			$queryBuilder->andWhere( "ir.estadoReclamo != " . $estadoNot );
		}

		$estado = $criteria->getEstadoReclamo();
		if( !empty($estado) ){
			$queryBuilder->andWhere( "ir.estadoReclamo = " . $estado );
		}

		$estadosNotIn = $criteria->getEstadosNotIn();
		if( !empty($estadosNotIn)){
			
			$oids = implode(",", $estadosNotIn);
			
			$queryBuilder->andWhere("ir.estadoReclamo not in ($oids)");
		}

		$estadosIn = $criteria->getEstadosIn();
		if( !empty($estadosIn)){
			
			$oids = implode(",", $estadosIn);
			
			$queryBuilder->andWhere("ir.estadoReclamo in ($oids)");
		}
		
		$hastaNull = $criteria->getHastaNull();
		if( !empty($hastaNull) ){
			$queryBuilder->andWhere($queryBuilder->expr()->isNull('ir.hasta'));
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "ir.$name";	
		}	
		
	}	
	
	
}