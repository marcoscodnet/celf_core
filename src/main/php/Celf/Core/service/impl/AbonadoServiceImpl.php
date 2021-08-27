<?php
namespace Celf\Core\service\impl;


use Celf\Core\dao\DAOFactory;

use Celf\Core\service\IAbonadoService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;


/**
 * servicio para Abonado
 *  
 * @author Marcos
 * @since 03-05-2018
 *
 */
class AbonadoServiceImpl extends CrudService implements IAbonadoService {

	
	protected function getDAO(){
		return DAOFactory::getAbonadoDAO();
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