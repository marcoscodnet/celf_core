<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\IRegistracionDAO;

use Celf\Core\model\Registracion;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Registracion
 *  
 * @author Marcos
 * @since 09-05-2020
 * 
 */
class RegistracionDoctrineDAO extends CrudDAO implements IRegistracionDAO{
	
	protected function getClazz(){
		return get_class( new Registracion() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('reg'))
	   				->from( $this->getClazz(), "reg");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(reg.oid)')
	   				->from( $this->getClazz(), "reg");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$oid = $criteria->getOidNotEqual();
		if( !empty($oid) ){
			$queryBuilder->andWhere( "reg.oid <> $oid");
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere( "reg.nombre like '%$nombre%'");
		}
		
		$email = $criteria->getEmail();
		if( !empty($email) ){
			$queryBuilder->andWhere( "reg.email = '$email'");
		}
		
		$documento = $criteria->getDocumento();
		if( !empty($documento) ){
			$queryBuilder->andWhere( "reg.documento = '$documento'");
		}
		
		
		
		$codigoValidacion = $criteria->getCodigoValidacion();
		if( !empty($codigoValidacion) ){
			$queryBuilder->andWhere( "reg.codigoValidacion = '$codigoValidacion'");
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "reg.$name";	
		}	
		
	}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/dao/Celf\Core\dao.IRegistracionDAO::borrarExpiradas()
	 */
	function borrarExpiradas(){

		$hoy = new \DateTime();
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		$queryBuilder->delete($this->getClazz(), "reg");
		$queryBuilder->andWhere( "reg.fechaExpiracion <= '" . $hoy->format("Y-m-d h:i:s") . "'");

		$q = $queryBuilder->getQuery();
		$q->execute();
		
	}
}