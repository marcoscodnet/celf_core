<?php
namespace Celf\Core\service\impl;


use Celf\Core\dao\DAOFactory;

use Celf\Core\service\IInstanciaReclamoService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Celf\Core\criteria\InstanciaReclamoCriteria;


use Celf\Core\service\ServiceFactory;



use Celf\Core\utils\CelfUtils;
/**
 * servicio para InstanciaReclamo
 *  
 * @author Marcos
 * @since 13-05-2020
 *
 */
class InstanciaReclamoServiceImpl extends CrudService implements IInstanciaReclamoService {

	
	protected function getDAO(){
		return DAOFactory::getInstanciaReclamoDAO();
	}
	
	
	/**
	 * redefino el add para agregar funcionalidad
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){

		/*
		 * Hacemos lo que queremos con la estado. 
		 * Por ejemplo, enviar un email al usuario.
		 */
		
		try{
			
			$criteria = new InstanciaReclamoCriteria();
			$criteria->setReclamo($entity->getReclamo());
			$criteria->setHastaNull(1);
			
			//Logger::logObject($entity->getIntegrante());
			
			$instanciaReclamoAnterior = ServiceFactory::getInstanciaReclamoService()->getSingleResult( $criteria );
			
		} catch (\Exception $e) {
			
			//throw new RastyException($e->getMessage());
			
		}
		
		
		
		
		$estadoAnterior=0;
		if ($instanciaReclamoAnterior) {
			$estadoAnterior=$instanciaReclamoAnterior->getEstadoReclamo()->getOid();
			if($estadoAnterior!=$entity->getEstadoReclamo()->getOid()){
				$instanciaReclamoAnterior->setHasta(new \Datetime());
			
				$this->update( $instanciaReclamoAnterior );
			}
		}
		
		//$entity->setObservaciones($user);
		
	
		$entity->setUsuario($entity->getUsuario());
		$entity->setDesde( new \Datetime() );
		
		
		
		if($estadoAnterior!=$entity->getEstadoReclamo()->getOid()){
			
			parent::add($entity);
			return true;
		}
		else return false;
		
		
		
		
	}	
	
	function validateOnAdd( $entity ){
	
		/*
		 * Realizamos validaciones sobre la estado. 
		 * Por ejemplo, campos obligatorios.
		 */		
	}
		
	
	function validateOnUpdate( $entity ){
	
		/*
		 * Validaciones como en el add pero 
		 * las necesarias para modificar.
		 */
		
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){
	
		/*
		 * validaciones al borrar una estado.
		 */
	}

	
	
	
}	