<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderStatusRepository")
 */
class OrderStatus
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
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $statusDatetime;
    
    /**
     * @var \AppBundle\Entity\Order
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Order", inversedBy="orderStatuses")
     */
    private $order;
    
    /**
     * @var \AppBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status", inversedBy="orderStatuses")
     */
    private $status;

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
     * Set statusDatetime
     *
     * @param \DateTime $statusDatetime
     * @return OrderStatus
     */
    public function setStatusDatetime($statusDatetime)
    {
        $this->statusDatetime = $statusDatetime;

        return $this;
    }

    /**
     * Get statusDatetime
     *
     * @return \DateTime 
     */
    public function getStatusDatetime()
    {
        return $this->statusDatetime;
    }

    /**
     * Set order
     *
     * @param \AppBundle\Entity\Order $order
     * @return OrderStatus
     */
    public function setOrder(\AppBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \AppBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     * @return OrderStatus
     */
    public function setStatus(\AppBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
