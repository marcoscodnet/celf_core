<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Celf\Core\service\ServiceFactory;

/**
 * 
 * Representa una persona
 * 
 * @Entity @Table(name="celf_reclamo")

 * 
 * 
 * @author Marcos
 * @since 14-05-2020
 */
 class Reclamo extends Entity{

	//variables de instancia.

	
	 /**
     * @var string|null
     *
     * @Column(type="text", nullable=true)
     */
	private $nombre;
	

	
	
	
	/**
     * @ManyToOne(targetEntity="TipoReclamo",cascade={"merge"})
     * @JoinColumn(name="tipoReclamo_oid", referencedColumnName="oid")
     * @var TipoReclamo
     **/
	private $tipoReclamo;
	
	
	/** 
	 * @Column(type="datetime", nullable=true) 
	 **/
	private $fecha;
	
	/**
     * @ManyToOne(targetEntity="Cose\Security\model\User")
     * @JoinColumn(name="usuario_oid", referencedColumnName="oid")
     * 
     * usuario asociado al cliente
     **/
    private $usuario;
    
      /**
     * @var \Estado
     *
     * @ManyToOne(targetEntity="EstadoReclamo")
     * @JoinColumns({
     *   @JoinColumn(name="estado_oid", referencedColumnName="oid")
     * })
     */
    private $estadoReclamo;
    
    /**
     * @OneToMany(targetEntity="InstanciaReclamo", mappedBy="reclamo", cascade={"remove"})
     **/
    private $instanciaReclamos;
    
    /**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $telefono;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $suministro;
	
	public function __construct(){
	}
	
	
 	public function __toString(){
		 return $this->getUsuario().' - '.$this->getTipoReclamo();
	}

 	public function getDireccion()
	{
	    $asociado = ServiceFactory::getAsociadoService()->getByUser($this->getUsuario());
		
		return ($asociado)?$asociado->getDireccion():'';
	}
	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getTipoReclamo()
	{
	    return $this->tipoReclamo;
	}

	public function setTipoReclamo($tipoReclamo)
	{
	    $this->tipoReclamo = $tipoReclamo;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}



	public function getEstadoReclamo()
	{
	    return $this->estadoReclamo;
	}

	public function setEstadoReclamo($estadoReclamo)
	{
	    $this->estadoReclamo = $estadoReclamo;
	}

	public function getInstanciaReclamos()
	{
	    return $this->instanciaReclamos;
	}

	public function setInstanciaReclamos($instanciaReclamos)
	{
	    $this->instanciaReclamos = $instanciaReclamos;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getSuministro()
	{
	    return $this->suministro;
	}

	public function setSuministro($suministro)
	{
	    $this->suministro = $suministro;
	}
}
?>