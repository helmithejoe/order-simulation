<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orderdata")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
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
    private $address;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $receivedBy;
    
    /**
     * @var \AppBundle\Entity\Item
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item", inversedBy="orders")
     */
    private $item;
    
    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
     */
    private $user;
    
    /**
     * @var \AppBundle\Entity\Driver
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Driver", inversedBy="orders")
     */
    private $driver;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderStatus", mappedBy="order")
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
     * Set address
     *
     * @param string $address
     * @return Order
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set receivedBy
     *
     * @param string $receivedBy
     * @return Order
     */
    public function setReceivedBy($receivedBy)
    {
        $this->receivedBy = $receivedBy;

        return $this;
    }

    /**
     * Get receivedBy
     *
     * @return string 
     */
    public function getReceivedBy()
    {
        return $this->receivedBy;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set driver
     *
     * @param \AppBundle\Entity\Driver $driver
     * @return Order
     */
    public function setDriver(\AppBundle\Entity\Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \AppBundle\Entity\Driver 
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Add orderStatuses
     *
     * @param \AppBundle\Entity\OrderStatus $orderStatuses
     * @return Order
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

    /**
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     * @return Order
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}
