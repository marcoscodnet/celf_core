<?php
namespace Celf\Core\service\impl;


use Celf\Core\dao\DAOFactory;

use Celf\Core\service\INovedadReclamoService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Celf\Core\criteria\NovedadReclamoCriteria;

use Cose\Security\model\User;

use Celf\Core\service\ServiceFactory;

use Rasty\security\RastySecurityContext;

use Celf\Core\utils\CelfUtils;
use Celf\Core\conf\CelfConfig;


/**
 * servicio para NovedadReclamo
 *  
 * @author Marcos
 * @since 17-07-2020
 *
 */
class NovedadReclamoServiceImpl extends CrudService implements INovedadReclamoService {

	
	protected function getDAO(){
		return DAOFactory::getNovedadReclamoDAO();
	}
	
	
	/**
	 * redefino el add para agregar funcionalidad
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){

			parent::add($entity);
		
	}	
	
	public function update($entity){

		
		
		parent::update($entity);
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

	function actualizarReclamo( $entity ){
		//obtenemos la reclamo.
		$reclamo = ServiceFactory::getReclamoService()->get($entity->getReclamo()->getOid() );
		$reclamo->setNombre($entity->getObservaciones());
		$reclamo->setEstadoReclamo($entity->getEstadoReclamo());
		
		ServiceFactory::getReclamoService()->update( $reclamo );
		
		$entity->setProcesado(1);
		
		$this->update($entity);
		
	}
	
	
}	