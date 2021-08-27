<?php
namespace Celf\Core\service\impl;



use Celf\Core\service\ServiceFactory;

use Celf\Core\conf\CelfConfig;

use Celf\Core\utils\XTemplate;

use Celf\Core\utils\CelfUtils;

use Celf\Core\criteria\RegistracionCriteria;

use Celf\Core\service\IRegistracionService;

use Celf\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\utils\Logger;

use Cose\Security\model\User;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para Registracion
 *  
 * @author Marcos
 * @since 09-05-2020
 *
 */
class RegistracionServiceImpl extends CrudService implements IRegistracionService {

	const VALIDAR_REGISTRACION_EMAIL_TEMPLATE = "/../../templates/emailValidarRegistracion.htm";
	
	
	
	protected function getDAO(){
		return DAOFactory::getRegistracionDAO();
	}
	
	/**
	 * redefino el add para generar el código de validación y su fecha
	 * de expiración.
	 * 
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){
		
		$fechaExpiracion = new \DateTime();
		$fechaExpiracion->modify("+1 day");
		$entity->setFechaExpiracion( $fechaExpiracion );
		$entity->setCodigoValidacion( md5(uniqid(rand())) );
		
		Logger::log( "agregando registración" , __CLASS__);
		
		//agregamos la registración.
		parent::add($entity);

		//notificamos al usuario para que valide su registración.
		ServiceFactory::getNotificacionesService()->notificarValidarRegistracion($entity);
		
	}
	
	function validateOnAdd( $entity ){
	
	
		
			
		//que tenga nombre
		$nombre = $entity->getNombre();
		if( empty($nombre) )
			throw new ServiceException("registracion.nombre.requerido");

		//que tenga primer apellido
		$apellido = $entity->getApellido();
		if( empty($apellido) )
			throw new ServiceException("registracion.apellido.requerido");

		//que tenga email
		$email = $entity->getEmail();
		if( empty($email) )
			throw new ServiceException("registracion.email.requerido");

		
						
		//que tenga tipo documento
		$documento = $entity->getDocumento();
		if( empty($documento) )
			throw new ServiceException("registracion.documento.requerido");
						
		//unicidad (email )
		if( $this->existsByEmail($email, $entity->getOid()) )
			throw new DuplicatedEntityException("registracion.email.repetido");	

		//unicidad (tipo + nro odc )
		if( $this->existsByDocumento($documento, $entity->getOid()) )
			throw new DuplicatedEntityException("registracion.documento.repetido");
			
			
		//chequear la unicidad contra los asociados	
		//unicidad (email )
		if( ServiceFactory::getAsociadoService()->existsByEmail($email) )
			throw new DuplicatedEntityException("registracion.email.repetido");	

		//unicidad (tipo + nro odc )
		if( ServiceFactory::getAsociadoService()->existsByDocumento($documento) )
			throw new DuplicatedEntityException("registracion.documento.repetido");

					
	}
		
	/**
	 * Retorna true si existe una registración para el mismo email
	 * @param string $email
	 */
	private function existsByEmail( $email, $oid=null){
	
		$criteria = new RegistracionCriteria();
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
	 * Retorna true si existe una registración dado un tipo y número de documento. 
	 * @param TipoDocumento $tipo
	 * @param string $numero
	 */
	private function existsByDocumento($numero, $oid=null){
	
		$criteria = new RegistracionCriteria();
		$criteria->setDocumento($numero);
		$criteria->setOidNotEqual($oid);
		
		$exists = false;
		
		try{
			
			$asociado = $this->getSingleResult( $criteria );
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
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/service/Celf\Core\service.IRegistracionService::getByCodigoValidacion()
	 */
	function getByCodigoValidacion($codigoValidacion){
	
		$criteria = new RegistracionCriteria();
		$criteria->setCodigoValidacion($codigoValidacion);
		
		$reg = false;
		
		try{
			
			$reg = $this->getSingleResult( $criteria );
			
		}catch (ServiceNonUniqueResultException $ex){
			\Logger::getLogger(__CLASS__)->info( $ex->getMessage());
		
		}catch (ServiceException $ex){
		
		}catch (\Exception $ex){
			\Logger::getLogger(__CLASS__)->info("error buscando por código de validación. " . $ex->getMessage());
		}
		
		//$reg->decrypt();
		
		return $reg;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/service/Celf\Core\service.IRegistracionService::confirmar()
	 */
	function confirmar($codigoValidacion){
	
		//recuperamos la registración.
		$reg = $this->getByCodigoValidacion($codigoValidacion);
		
		if( !$reg )
			throw new ServiceException("registracion.confirmar.codigoInvalido");
		
		//chequeamos que no esté expirada.
		$hoy = new \DateTime();
		
		if( $reg->getFechaExpiracion() < $hoy ){
			throw new ServiceException("registracion.confirmar.codigoExpirado");
		}
		
		$reg->decrypt();

		
		
		//creamos el usuario a partir de la registración.
		$usuario = new User(); 
		$usuario->setName( $reg->getNombre() );
		$usuario->setLastName( trim($reg->getApellido()));
		$usuario->setUsername( $reg->getEmail() );
		$usuario->setEmail( $reg->getEmail() );
		$usuario->setPassword( $reg->getClave() );
		$usuario->setLogged( false );
		
		//le asignamos el perfil reclamo.
		$userGroupService = \Cose\Security\service\ServiceFactory::getUserGroupService();
		$perfilReclamos = $userGroupService->get( CelfUtils::USERGROUP_RECLAMOS );
		$groups = array( $perfilReclamos );
		$usuario->setGroups( $groups );
		
		$userService = \Cose\Security\service\ServiceFactory::getUserService();
		$userService->add( $usuario );
		
		$reg->encrypt();
		
		//creamos el asociado a partir de la registración
		//y le asignamos el usuario.
		$asociado = $reg->buildAsociado();
		
		$asociado->setUsuario( $usuario );
		ServiceFactory::getAsociadoService()->add( $asociado );
		
		
		
		return $asociado;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/service/Celf\Core\service.IRegistracionService::borrarExpiradas()
	 */
	function borrarExpiradas(){
	
		$this->getDAO()	->borrarExpiradas();
	
	}
}