<?php

namespace AppBundle\Entity;

use AppBundle\Entity\LocalBusiness\ClosingRulesTrait;
use Doctrine\Common\Collections\ArrayCollection;

class Hub
{
    use ClosingRulesTrait;

    private $id;
    private $name;
    private $address;
    private $restaurants;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
        $this->closingRules = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRestaurants()
    {
        return $this->restaurants;
    }

    /**
     * @param mixed $restaurants
     *
     * @return self
     */
    public function setRestaurants($restaurants)
    {
        $this->restaurants = $restaurants;

        return $this;
    }

    /**
     * @param mixed $restaurant
     */
    public function addRestaurant($restaurant)
    {
        $this->restaurants->add($restaurant);
    }
}
