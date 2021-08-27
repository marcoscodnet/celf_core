<?php

namespace Celf\Core\model;

use Cose\Security\utils\SecurityUtils;

use Cose\model\impl\Entity;

/**
 * Registracion
 * 
 * @Entity @Table(name="celf_registracion")
 * 
 * @author Marcos
 * @since 08-05-2020
 */

class Registracion extends Entity{

	//variables de instancia.

	
	
	/**
	 * @Column(type="string")
	 * @var integer
	 */
	private $documento;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $apellido;
	
	
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $email;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $clave;
	
	
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $calle;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $numero;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $piso;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $depto;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $celular;

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $codigoValidacion;
	
	/** 
	 * @Column(type="date")
	 *  
	 **/
	private $fechaExpiracion;
	
	
	
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getNombre();
	}



	

	
	
	
	
	
	public function doEncrypt(){
		
		$this->setClave( SecurityUtils::aesEncrypt( $this->getClave() ) );
		
	}
	
	public function doDecrypt(){
		
		$this->setClave( SecurityUtils::aesDecrypt( $this->getClave() ) );
		
	}

	

	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getClave()
	{
	    return $this->clave;
	}

	public function setClave($clave)
	{
	    $this->clave = $clave;
	}

	public function getCalle()
	{
	    return $this->calle;
	}

	public function setCalle($calle)
	{
	    $this->calle = $calle;
	}

	public function getNumero()
	{
	    return $this->numero;
	}

	public function setNumero($numero)
	{
	    $this->numero = $numero;
	}

	public function getPiso()
	{
	    return $this->piso;
	}

	public function setPiso($piso)
	{
	    $this->piso = $piso;
	}

	public function getDepto()
	{
	    return $this->depto;
	}

	public function setDepto($depto)
	{
	    $this->depto = $depto;
	}

	public function getCodigoValidacion()
	{
	    return $this->codigoValidacion;
	}

	public function setCodigoValidacion($codigoValidacion)
	{
	    $this->codigoValidacion = $codigoValidacion;
	}

	public function getFechaExpiracion()
	{
	    return $this->fechaExpiracion;
	}

	public function setFechaExpiracion($fechaExpiracion)
	{
	    $this->fechaExpiracion = $fechaExpiracion;
	}

	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}

	public function getCelular()
	{
	    return $this->celular;
	}

	public function setCelular($celular)
	{
	    $this->celular = $celular;
	}
	
	public function buildAsociado(){
		
		$asociado = new Asociado();
		
		
		$asociado->setDocumento( $this->getDocumento() );
		$asociado->setNombre( $this->getNombre() );
		$asociado->setApellido( $this->getApellido() );
		
		
		$asociado->setEmail( $this->getEmail() );
		$asociado->setCelular( $this->getCelular() );
		$asociado->setCalle( $this->getCalle() );
		$asociado->setNumero( $this->getNumero() );
		$asociado->setPiso( $this->getPiso() );
		$asociado->setDepto( $this->getDepto() );
		
		
		
		return $asociado;
	}
}
?>