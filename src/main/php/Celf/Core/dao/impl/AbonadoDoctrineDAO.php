<?php
namespace Celf\Core\dao\impl;

use Celf\Core\dao\IAbonadoDAO;

use Celf\Core\model\Abonado;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Abonado
 *  
 * @author Marcos
 * 
 */
class AbonadoDoctrineDAO extends CrudDAO implements IAbonadoDAO{
	
	protected function getClazz(){
		return get_class( new Abonado() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('a'))
	   				->from( $this->getClazz(), "a");
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(a.oid)')
	   				->from( $this->getClazz(), "a");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$apellido = $criteria->getApellido();
		if( !empty($apellido) ){
			$queryBuilder->andWhere("upper(a.apellido)  like :apellido");
			$queryBuilder->setParameter( "apellido" , "%$apellido%" );
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere("upper(a.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}
		
		$calle = $criteria->getCalle();
		if( !empty($calle) ){
			$queryBuilder->andWhere("upper(a.calle)  like :calle");
			$queryBuilder->setParameter( "calle" , "%$calle%" );
		}
		
		
		$telefono = $criteria->getTelefono();
		if( !empty($telefono) ){
			$queryBuilder->andWhere("upper(a.telefono)  like :telefono");
			$queryBuilder->setParameter( "telefono" , "%$telefono%" );
		}
		
		$categoriaNot = $criteria->getCategoriaNotEqual();
		if( !empty($categoriaNot) ){
			$queryBuilder->andWhere( "a.categoria != " . $categoriaNot );
		}
		
		$categoria = $criteria->getCategoria();
		if( !empty($categoria) ){
			$queryBuilder->andWhere( "a.categoria = " . $categoria );
		}
		
		$categorias = $criteria->getCategorias();
		if( !empty($categorias) && count( $categorias>0) ){
			
			$strCategorias = implode(",", $categorias );
			
			$queryBuilder->andWhere( $queryBuilder->expr()->in("a.categoria", $strCategorias) );
		}
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "a.$name";	
		}	
		
	}	
}