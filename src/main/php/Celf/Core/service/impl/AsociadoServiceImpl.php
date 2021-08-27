<?php
namespace Celf\Core\service\impl;

use Celf\Core\conf\CelfConfig;



use Celf\Core\model\Asociado;



use Celf\Core\service\ServiceFactory;

use Celf\Core\utils\CelfUtils;

use Celf\Core\criteria\AsociadoCriteria;

use Celf\Core\service\IAsociadoService;

use Celf\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;
use Cose\Security\model\User;

use Celf\Core\utils\XTemplate;

/**
 * servicio para cliente
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */
class AsociadoServiceImpl extends CrudService implements IAsociadoService {

	

	
	/**
	 * redefino el add para agregar la cuenta corriente al
	 * cliente.
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){
		$entity->setFechaAlta( new \Datetime() );

		
		
		//agregamos el cliente.
		parent::add($entity);
		
		return $entity;
	}
	
	
	protected function getDAO(){
		return DAOFactory::getAsociadoDAO();
	}
	
	
	function validateOnAdd( $entity ){
	
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException("cliente.nombre.requerido");

		//que tenga primer apellido
		$apellido = $entity->getApellido();
		if( empty($apellido) )
			throw new ServiceException("cliente.apellido.requerido");

		//que tenga email
		$email = $entity->getEmail();
		if( empty($email) )
			throw new ServiceException("cliente.email.requerido");

		
						
		//que tenga tipo documento
		$documento = $entity->getDocumento();
		if( empty($documento) )
			throw new ServiceException("cliente.documento.requerido");
						
		//unicidad (email )
		if( $this->existsByEmail($email, $entity->getOid()) )
			throw new DuplicatedEntityException("cliente.email.repetido");	

		//unicidad (tipo + nro odc )
		if( $this->existsByDocumento($documento, $entity->getOid()) )
			throw new DuplicatedEntityException("cliente.documento.repetido");

			
		
		
	}
		
	function validateOnUpdate( $entity ){
	
		//$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/service/Celf\Core\service.IAsociadoService::existsByEmail()
	 */
	function existsByEmail( $email, $oid=null){
	
		$criteria = new AsociadoCriteria();
		$criteria->setEmail($email);
		$criteria->setOidNotEqual($oid);
	
		$exists = false;
		
		try{
			
			$reg = $this->getSingleResult( $criteria );
			
			$exists = true;
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = true;
		
		}catch (ServiceException $ex){
			//\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = false;
		
		}catch (\Exception $ex){
			$exists = false;
		}
		return $exists;
	}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/service/Celf\Core\service.IAsociadoService::existsByDocumento()
	 */
	function existsByDocumento($numero, $oid=null){
	
		$criteria = new AsociadoCriteria();
		$criteria->setDocumento($numero);
		
		$criteria->setOidNotEqual($oid);
		
		$exists = false;
		
		try{
			
			$cliente = $this->getSingleResult( $criteria );
			$exists = true;
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = true;
		
		}catch (ServiceException $ex){
			//\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
			$exists = false;
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por documento. " . $ex->getMessage());
			$exists = false;
		}
		return $exists;
	}

	function getByUser(User $user){
	
		try {
			
			$c = $this->getDAO()->getByUser($user);
			
			$c->decrypt();
			
			return $c;	
			
		} catch (DAOException $e) {

			//throw new ServiceException( $e->getMessage() );
			
		} catch (Exception $e) {
				
			//throw new ServiceException( $e->getMessage() );
		}
		
		
	}
	
	
}	