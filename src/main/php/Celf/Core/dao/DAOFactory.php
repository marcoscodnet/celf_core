<?php
namespace Celf\Core\dao;

/**
 * Factory de DAOs
 *  
 * @author Marcos
 *
 */

use Celf\Core\dao\impl\AbonadoDoctrineDAO;



use Celf\Core\dao\impl\NecrologicaDoctrineDAO;

use Celf\Core\dao\impl\CorreoDoctrineDAO;

use Celf\Core\dao\impl\RegistracionDoctrineDAO;

use Celf\Core\dao\impl\AsociadoDoctrineDAO;

use Celf\Core\dao\impl\AreaDoctrineDAO;

use Celf\Core\dao\impl\TipoReclamoDoctrineDAO;

use Celf\Core\dao\impl\ReclamoDoctrineDAO;

use Celf\Core\dao\impl\InstanciaReclamoDoctrineDAO;

use Celf\Core\dao\impl\EstadoReclamoDoctrineDAO;

use Celf\Core\dao\impl\NovedadReclamoDoctrineDAO;


class DAOFactory {

	

	
	
	/**
	 * DAO para Abonado.
	 * 
	 * @return IAbonado
	 */
	public static function getAbonadoDAO(){
	
		return new AbonadoDoctrineDAO();	
	}
	
		
	
	
	/**
	 * DAO para Necrologica.
	 * 
	 * @return INecrologica
	 */
	public static function getNecrologicaDAO(){
	
		return new NecrologicaDoctrineDAO();	
	}
	
	/**
	 * DAO para Correo.
	 * 
	 * @return ICorreo
	 */
	public static function getCorreoDAO(){
	
		return new CorreoDoctrineDAO();	
	}
	
	/**
	 * DAO para Registracion.
	 * 
	 * @return IRegistracion
	 */
	public static function getRegistracionDAO(){
	
		return new RegistracionDoctrineDAO();	
	}
	
	/**
	 * DAO para Asociado.
	 * 
	 * @return IAsociado
	 */
	public static function getAsociadoDAO(){
	
		return new AsociadoDoctrineDAO();	
	}
	
	/**
	 * DAO para Area.
	 * 
	 * @return IArea
	 */
	public static function getAreaDAO(){
	
		return new AreaDoctrineDAO();	
	}
	
	/**
	 * DAO para TipoReclamo.
	 * 
	 * @return ITipoReclamo
	 */
	public static function getTipoReclamoDAO(){
	
		return new TipoReclamoDoctrineDAO();	
	}
	
	/**
	 * DAO para Reclamo.
	 * 
	 * @return IReclamo
	 */
	public static function getReclamoDAO(){
	
		return new ReclamoDoctrineDAO();	
	}
	
	/**
	 * DAO para EstadoReclamo.
	 * 
	 * @return IEstadoReclamo
	 */
	public static function getEstadoReclamoDAO(){
	
		return new EstadoReclamoDoctrineDAO();	
	}
	
	/**
	 * DAO para InstanciaReclamo.
	 * 
	 * @return IInstanciaReclamo
	 */
	public static function getInstanciaReclamoDAO(){
	
		return new InstanciaReclamoDoctrineDAO();	
	}
	
	/**
	 * DAO para NovedadReclamo.
	 * 
	 * @return INovedadReclamo
	 */
	public static function getNovedadReclamoDAO(){
	
		return new NovedadReclamoDoctrineDAO();	
	}

	
}
