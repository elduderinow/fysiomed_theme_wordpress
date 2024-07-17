<?php
namespace Classes\PostType;

use Classes\Traits\Paragraphs;

class Project extends BasePost
{
    use Paragraphs;

    private $reference;
    private $client;
    private $location;

    public function __construct($post)
    {
        parent::__construct($post);
        $this->setReference($post);
        $this->setLocation($post);
        $this->setClient($post);

        $this->setParagraphs($post);
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }
    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
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
    public function setReference($post): void
    {
        $this->reference = get_field('reference', $post);
    }
    /**
     * @param mixed $post
     */
    public function setClient($post): void
    {
        if (get_field('client', $post)) {
            $this->client = new Company(get_field('client', $post));
        }
    }
    /**
     * @param mixed $post
     */
    public function setLocation($post): void
    {
        if (get_field('location', $post)) {
            $this->location = new Location(get_field('location', $post));
        }
    }
}