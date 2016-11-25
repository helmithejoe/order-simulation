<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatusRepository")
 */
class Status
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $code;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $description;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderStatus", mappedBy="status")
     */
    private $orderStatuses;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderStatuses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Status
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Status
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add orderStatuses
     *
     * @param \AppBundle\Entity\OrderStatus $orderStatuses
     * @return Status
     */
    public function addOrderStatus(\AppBundle\Entity\OrderStatus $orderStatuses)
    {
        $this->orderStatuses[] = $orderStatuses;

        return $this;
    }

    /**
     * Remove orderStatuses
     *
     * @param \AppBundle\Entity\OrderStatus $orderStatuses
     */
    public function removeOrderStatus(\AppBundle\Entity\OrderStatus $orderStatuses)
    {
        $this->orderStatuses->removeElement($orderStatuses);
    }

    /**
     * Get orderStatuses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderStatuses()
    {
        return $this->orderStatuses;
    }
}
