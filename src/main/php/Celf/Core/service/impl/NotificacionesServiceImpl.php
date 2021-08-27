<?php
namespace Celf\Core\service\impl;






use Celf\Core\model\Registracion;
use Celf\Core\model\Reclamo;


use Celf\Core\utils\CelfUtils;

use Celf\Core\conf\CelfConfig;



use Celf\Core\service\ServiceFactory;

use Celf\Core\service\INotificacionesService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Celf\Core\utils\XTemplate;

use Cose\Security\criteria\UserCriteria;


/**
 * servicio para Notificaciones
 *  
 * @author Marcos
 * @since 11-05-2020
 *
 */
class NotificacionesServiceImpl implements INotificacionesService {

	
	const VALIDAR_REGISTRACION_EMAIL_TEMPLATE = "/../../templates/emailValidarRegistracion.htm";
	const NUEVO_RECLAMO_EMAIL_TEMPLATE = "/../../templates/emailNuevoReclamo.htm";
	const MODIFICACION_RECLAMO_EMAIL_TEMPLATE = "/../../templates/emailModificacionReclamo.htm";
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Celf/Core/service/Celf\Core\service.INotificacionesService::notificarValidarRegistracion()
	 */
	public function notificarValidarRegistracion(Registracion $registracion){
	
		//armamos el email con el código de validación.
		$template = new XTemplate( dirname(__FILE__) . self::VALIDAR_REGISTRACION_EMAIL_TEMPLATE );
		$template->assign("linkValidacion", CelfConfig::getInstance()->getValidarRegistracionLink() . "?codigoValidacion=" . $registracion->getCodigoValidacion() );
		$template->assign("WEBPATH", CelfConfig::getInstance()->getWebPath() );
		CelfUtils::parsearEmailStyles( $template );
		$template->assign("nombre", $registracion->getNombre() );
		$template->parse("main");
		$mensaje = $template->text("main");
		
		$asunto = "Celf - Nuevo Usuario";
		
		//lo enviamos.
		CelfUtils::sendMail($registracion->getNombre(), $registracion->getEmail(), $asunto, $mensaje);
	
	}
	
	public function notificarNuevoReclamo(Reclamo $reclamo){
	
		//armamos el email con el código de validación.
		$template = new XTemplate( dirname(__FILE__) . self::NUEVO_RECLAMO_EMAIL_TEMPLATE );
		
		$template->assign("WEBPATH", CelfConfig::getInstance()->getWebPath() );
		CelfUtils::parsearEmailStyles( $template );
		$template->assign("nombre", $reclamo->getUsuario()->getName() );
		$template->assign("reclamo_oid", $reclamo->getOid() );
		$template->assign("tipo", $reclamo->getTipoReclamo() );
		$template->assign("suministro", $reclamo->getSuministro() );
		$template->assign("telefono", $reclamo->getTelefono() );
		$template->assign("asunto", nl2br($reclamo->getNombre()) );
		$template->parse("main");
		$mensaje = $template->text("main");
		
		$asunto = "Incio de Reclamo";
		
		//lo enviamos.
		CelfUtils::sendMail($reclamo->getUsuario(), $reclamo->getUsuario()->getEmail(), $asunto, $mensaje);
		
		CelfUtils::sendMail($reclamo->getTipoReclamo()->getArea(), $reclamo->getTipoReclamo()->getArea()->getEmail(), $asunto, $mensaje);
		
		$rolAdminOid = CelfUtils::USERGROUP_ADMIN;
		$criteria = new UserCriteria();
		
    	$criteria->setUsergroupIn(array($rolAdminOid));
		
		$service = \Cose\Security\service\ServiceFactory::getUserService();
			
		$usuarios = $service->getList( $criteria );
		
		foreach ($usuarios as $usuario) {
			CelfUtils::sendMail($usuario, $usuario->getEmail(), $asunto, $mensaje);
			//CelfUtils::sendMail(CelfConfig::MAIL_FROM_NAME, CelfConfig::MAIL_FROM, $asunto, $mensaje);
		}
		
		
	}

	public function notificarModificacionReclamo(Reclamo $reclamo){
	
		//armamos el email con el código de validación.
		$template = new XTemplate( dirname(__FILE__) . self::MODIFICACION_RECLAMO_EMAIL_TEMPLATE);
		
		$template->assign("WEBPATH", CelfConfig::getInstance()->getWebPath() );
		CelfUtils::parsearEmailStyles( $template );
		$template->assign("nombre", $reclamo->getUsuario()->getName() );
		$template->assign("reclamo_oid", $reclamo->getOid() );
		$template->assign("tipo", $reclamo->getTipoReclamo() );
		$template->assign("suministro", $reclamo->getSuministro() );
		$template->assign("telefono", $reclamo->getTelefono() );
		$template->assign("estado", $reclamo->getEstadoReclamo() );
		$template->assign("asunto", nl2br($reclamo->getNombre()) );
		$template->parse("main");
		$mensaje = $template->text("main");
		
		$asunto = "Actualización de Reclamo";
		
		//lo enviamos.
		CelfUtils::sendMail($reclamo->getUsuario(), $reclamo->getUsuario()->getEmail(), $asunto, $mensaje);
		CelfUtils::sendMail($reclamo->getTipoReclamo()->getArea(), $reclamo->getTipoReclamo()->getArea()->getEmail(), $asunto, $mensaje);
		$rolAdminOid = CelfUtils::USERGROUP_ADMIN;
		$criteria = new UserCriteria();
		
    	$criteria->setUsergroupIn(array($rolAdminOid));
		
		$service = \Cose\Security\service\ServiceFactory::getUserService();
			
		$usuarios = $service->getList( $criteria );
		
		foreach ($usuarios as $usuario) {
			CelfUtils::sendMail($usuario->getName().' '.$usuario->getLastname(), $usuario->getEmail(), $asunto, $mensaje);
			//CelfUtils::sendMail(CelfConfig::MAIL_FROM_NAME, CelfConfig::MAIL_FROM, $asunto, $mensaje);
		}
	}
	
	
	
	
}	