<?php

namespace Classes\PostType;

use Classes\Traits\Paragraphs;
use Classes\General\Link;

class Event extends BasePost
{
   use Paragraphs;

    private $startdate;
    private $enddate;
    private $starttime;
    private $endtime;
    private $link;
    private $location;
    private $contact;

    public function __construct($post)
    {
        parent::__construct($post);

        $this->setStartdate($post);
        $this->setEnddate($post);
        $this->setStarttime($post);
        $this->setEndtime($post);
        $this->setLink($post);
        $this->setLocation($post);
        $this->setContact($post);

        $this->setParagraphs($post);
    }

    /**
     * @return mixed
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * @param mixed $post
     */
    public function setStartdate($post): void
    {
        $this->startdate = get_field('startdate', $post);
    }

    /**
     * @return mixed
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param mixed $post
     */
    public function setEnddate($post): void
    {
        $this->enddate = get_field('enddate', $post);
    }

    /**
     * @return mixed
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * @param mixed $post
     */
    public function setStarttime($post): void
    {
        $this->starttime = get_field('starttime', $post);
    }

    /**
     * @return mixed
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * @param mixed $post
     */
    public function setEndtime($post): void
    {
        $this->endtime = get_field('endtime', $post);
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $post
     */
    public function setLink($post): void
    {
        if (get_field('link', $post) !== null) {
            $this->link = new Link(get_field('link', $post));
        }
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $post
     */
    public function setLocation($post): void
    {
        if (get_field('location', $post) !== null) {
            $this->location = new Location(get_field('location', $post));
        }
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($post): void
    {
        if (get_field('contact', $post) !== null) {
            $this->contact = new Person (get_field('contact', $post));
        }
    }

}