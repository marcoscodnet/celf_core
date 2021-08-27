<?php
namespace Celf\Core\service\impl;


use Celf\Core\dao\DAOFactory;

use Celf\Core\service\INecrologicaService;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Celf\Core\utils\CelfUtils;

use Celf\Core\conf\CelfConfig;

use Rasty\utils\Logger;

use Celf\Core\service\ServiceFactory;

use Celf\Core\criteria\CorreoCriteria;
/**
 * servicio para Necrologica
 *  
 * @author Marcos
 * @since 03-05-2018
 *
 */
class NecrologicaServiceImpl extends CrudService implements INecrologicaService {

	
	protected function getDAO(){
		return DAOFactory::getNecrologicaDAO();
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
	
		$correoCriteria = new CorreoCriteria();
		$correoCriteria->setActivo(CelfConfig::CORREO_ACTIVO);
		$correos = ServiceFactory::getCorreoService()->getList($correoCriteria);
					
		foreach ($correos as $correo) {
			
			
			   
			
				
			
				$body = '<HTML><HEAD></HEAD><BODY><P>Se informa desde CELF nueva necrol&oacute;gica:</P>Fecha: '.CelfUtils::formatDateToView($entity->getFecha()).'<br>Nombre y Apellido: '.$entity->getNombre().'<br>'.$entity->getTexto().'	</BODY></HTML>';
				
				
				
				CelfUtils::sendMail($correo->getNombre(), $correo->getEmail(), utf8_encode('CELF - Necrológica: ').$entity->getNombre(), $body);
				
				
	
			
		
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