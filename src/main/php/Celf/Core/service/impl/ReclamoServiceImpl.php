<?php
namespace Celf\Core\service\impl;


use Celf\Core\dao\DAOFactory;

use Celf\Core\service\IReclamoService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Celf\Core\model\InstanciaReclamo;

use Cose\Security\model\User;

use Celf\Core\service\ServiceFactory;



use Celf\Core\utils\CelfUtils;

/**
 * servicio para Reclamo
 *  
 * @author Marcos
 * @since 14-05-2020
 *
 */
class ReclamoServiceImpl extends CrudService implements IReclamoService {

	
	protected function getDAO(){
		return DAOFactory::getReclamoDAO();
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
		
		//agregamos la estado.
		parent::add($entity);
		
		//creo una instancia 
		$instanciaReclamo = new InstanciaReclamo();
		$instanciaReclamo->setReclamo($entity);
		
		
		$instanciaReclamo->setObservaciones($entity->getNombre());	
		$instanciaReclamo->setEstadoReclamo($entity->getEstadoReclamo());
		$instanciaReclamo->setUsuario($entity->getUsuario());
		
		ServiceFactory::getInstanciaReclamoService()->add( $instanciaReclamo );
		
		//notificamos al usuario y a la cooperativa que hay nuevo reclamo.
		ServiceFactory::getNotificacionesService()->notificarNuevoReclamo($entity);
		
		
		
	}	
	
	public function update($entity){

		
		
		parent::update($entity);
		
		
		//creo una instancia 
		$instanciaReclamo = new InstanciaReclamo();
		$instanciaReclamo->setReclamo($entity);
		$instanciaReclamo->setObservaciones($entity->getNombre());
		
			
		$instanciaReclamo->setEstadoReclamo($entity->getEstadoReclamo());
		
		$SecurityContext=SecurityContext::getInstance();
		$user = $SecurityContext->getUser();
		//print_r($SecurityContext->getUser());
		if ($user) {
			
			$user = CelfUtils::getUserByUsername($user->getUsername());
		}
		else{
			$user = CelfUtils::getUserByUsername(CelfUtils::USERNAME_EXTERNO);
		}
		$instanciaReclamo->setUsuario($user);
		
		$insertado=ServiceFactory::getInstanciaReclamoService()->add( $instanciaReclamo );
		
		if ($insertado) {
			//notificamos al usuario que se actualizó el reclamo.
			ServiceFactory::getNotificacionesService()->notificarModificacionReclamo($entity);
		}
		
		
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