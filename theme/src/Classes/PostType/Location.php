<?php

namespace Classes\PostType;

class Location extends BasePost
{
    private $street;
    private $housenumber;
    private $zipcode;
    private $city ;
    private $coordinates;
    private $email;
    private $phone;
    private $headquarters = false;

    public function __construct($post)
    {
        parent::__construct($post);

        $this->setStreet($post);
        $this->setHousenumber($post);
        $this->setZipcode($post);
        $this->setCity($post);
        $this->setCoordinates($post);
        $this->setEmail($post);
        $this->setPhone($post);
        $this->setHeadquarters($post);
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }
    /**
     * @return string
     */
    public function getHousenumber()
    {
        return $this->housenumber;
    }
    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }
    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * @return string
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * @return bool
     */
    public function isHeadquarters()
    {
        return $this->headquarters;
    }


    /**
     * @param object $post
     */
    public function setStreet(object $post): void
    {
        $this->street = get_field('street', $post);
    }
    /**
     * @param object $post
     */
    public function setHousenumber(object $post): void
    {
        $this->housenumber = get_field('housenumber', $post);
    }
    /**
     * @param object $post
     */
    public function setZipcode(object $post): void
    {
        $this->zipcode = get_field('zipcode', $post);
    }
    /**
     * @param object $post
     */
    public function setCity(object $post): void
    {
        $this->city = get_field('city', $post);
    }
    /**
     * @param object $post
     */
    public function setCoordinates(object $post): void
    {
        $this->coordinates = get_field('coordinates', $post);
    }
    /**
     * @param object $post
     */
    public function setEmail(object $post): void
    {
        $this->email = get_field('email', $post);
    }
    /**
     * @param object $post
     */
    public function setPhone(object $post): void
    {
        $this->phone = get_field('phone', $post);
    }
    /**
     * @param object $post
     */
    public function setHeadquarters(object $post): void
    {
        if (get_field('headquarters', $post) !== null) {
            $this->headquarters = get_field('headquarters', $post);
        }

    }
}
