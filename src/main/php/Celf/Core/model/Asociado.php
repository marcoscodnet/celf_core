<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

/**
 * 
 * Representa una persona
 * 
 * @Entity @Table(name="celf_asociado")

 * 
 * 
 * @author Marcos
 * @since 11-05-2020
 */
 class Asociado extends Entity{

	//variables de instancia.

	/**
     * @ManyToOne(targetEntity="Cose\Security\model\User")
     * @JoinColumn(name="usuario_oid", referencedColumnName="oid")
     * 
     * usuario asociado al cliente
     **/
    private $usuario;
	
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
	 * @Column(type="datetime", nullable=true) 
	 **/
	private $fechaAlta;

		
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
	
	
	public function __construct(){
	}
	
	public function __toString(){
		
		$result = $this->getApellido();
		
		
		
		$result .= ", " . $this->getNombre();
			
		return $result;
	}


	

	

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
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

	
	public function getCelular()
	{
	    return $this->celular;
	}

	public function setCelular($celular)
	{
	    $this->celular = $celular;
	}

	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}

	public function getFechaAlta()
	{
	    return $this->fechaAlta;
	}

	public function setFechaAlta($fechaAlta)
	{
	    $this->fechaAlta = $fechaAlta;
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
	
 	public function getDireccion()
	{
	    return $this->getCalle().' '.$this->getNumero().($this->getPiso()?' '.$this->getPiso():'').($this->getDepto()?' '.$this->getDepto():''); 
	}
	
}
?>