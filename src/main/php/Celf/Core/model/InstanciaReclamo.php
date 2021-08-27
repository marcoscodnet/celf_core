<?php
namespace Celf\Core\model;

use Cose\model\impl\Entity;
use Celf\Core\utils\CelfUtils;

use Cose\Security\model\User;
/**
 * Instancia Reclamo
 *
 * @Entity @Table(name="celf_instancia_reclamo")
 */
class InstanciaReclamo extends Entity{
   

   

   
    
    /**
     * @var \DateTime|null
     *
     * @Column(name="desde", type="datetime", nullable=true)
     */
    private $desde;
    
     /**
     * @var \DateTime|null
     *
     * @Column(name="hasta", type="datetime", nullable=true)
     */
    private $hasta;
    
    /**
     * @var string|null
     *
     * @Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;
    
   

    /**
     * @var \Reclamo
     *
     * @ManyToOne(targetEntity="Reclamo", cascade={"remove"})
     * @JoinColumns({
     *   @JoinColumn(name="reclamo_oid", referencedColumnName="oid")
     * })
     */
    private $reclamo;

   
    
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
     * @ManyToOne(targetEntity="Cose\Security\model\User",cascade={"merge"})
     * @JoinColumn(name="usuario_oid", referencedColumnName="oid")
     * 
     * usuario q generó la operación
     **/
    private $usuario;

	public function __construct(){
	}

	

    
    

	

	public function getDesde()
	{
	    return $this->desde;
	}

	public function setDesde($desde)
	{
	    $this->desde = $desde;
	}

	public function getHasta()
	{
	    return $this->hasta;
	}

	public function setHasta($hasta)
	{
	    $this->hasta = $hasta;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getReclamo()
	{
	    return $this->reclamo;
	}

	public function setReclamo($reclamo)
	{
	    $this->reclamo = $reclamo;
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
}
