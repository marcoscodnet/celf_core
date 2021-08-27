<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\IReclamoDAO;

use Celf\Core\model\Reclamo;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para Reclamo
 *  
 *  @author Marcos
 * @since 14-05-2020
 * 
 */
class ReclamoDoctrineDAO extends CrudDAO implements IReclamoDAO{
	
	protected function getClazz(){
		return get_class( new Reclamo() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('r', 'tr', 'u','e'))
	   				->from( $this->getClazz(), "r")
					->leftJoin('r.tipoReclamo', 'tr')
					->leftJoin('r.estadoReclamo', 'e')
					->leftJoin('r.usuario', 'u');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(r.oid)')
	   				->from( $this->getClazz(), "r")
					->leftJoin('r.tipoReclamo', 'tr')
					->leftJoin('r.estadoReclamo', 'e')
					->leftJoin('r.usuario', 'u');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$fecha = $criteria->getFecha();
		if( !empty($fecha) ){
			$queryBuilder->andWhere( "r.fecha = '" . $fecha->format("Y-m-d") . "'");
		}
		
		$fechaDesde = $criteria->getFechaDesde();
		if( !empty($fechaDesde) ){
			$queryBuilder->andWhere( "r.fecha >= '" . $fechaDesde->format("Y-m-d") . "'");
		}
	
		$fechaHasta = $criteria->getFechaHasta();
		if( !empty($fechaHasta) ){
			$queryBuilder->andWhere( "r.fecha <= '" . $fechaHasta->format("Y-m-d") . "'");
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
		
		$tipoReclamo = $criteria->getTipoReclamo();
		if( !empty($tipoReclamo) && $tipoReclamo!=null){
			if (is_object($tipoReclamo)) {
				$tipoReclamoOid = $tipoReclamo->getOid();
				if(!empty($tipoReclamoOid))
					$queryBuilder->andWhere( "tr.oid= $tipoReclamoOid" );
			}
			else $queryBuilder->andWhere( "tr.nombre like '%$tipoReclamo%'");
		}
		

		$estadoNot = $criteria->getEstadoNotEqual();
		if( !empty($estadoNot) ){
			$queryBuilder->andWhere( "r.estadoReclamo != " . $estadoNot );
		}

		$estado = $criteria->getEstado();
		if( !empty($estado) ){
			$queryBuilder->andWhere( "r.estadoReclamo = " . $estado );
		}

		$estadosNotIn = $criteria->getEstadosNotIn();
		if( !empty($estadosNotIn)){
			
			$oids = implode(",", $estadosNotIn);
			
			$queryBuilder->andWhere("r.estadoReclamo not in ($oids)");
		}

		$estadosIn = $criteria->getEstadosIn();
		if( !empty($estadosIn)){
			
			$oids = implode(",", $estadosIn);
			
			$queryBuilder->andWhere("r.estadoReclamo in ($oids)");
		}
		
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "r.$name";	
		}	
		
	}	
	
	
}