<?php namespace Classes\Template;

use Classes\PostType\BasePost;

/**
 * Class Contact: Specific fields only used on Contact-template
 * @package Classes\Template
 */

class Contact extends BasePost
{
    private $phone;
    private $email;

    public function __construct($post)
    {
        parent::__construct($post);
        $this->setPhone($post);
        $this->setEmail($post);
    }


    /**
     * getPhone
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * setPhone
     * @return mixed
     */
    public function setPhone($post)
    {
        $this->phone = get_field('phone', $post);
    }

    /**
     * getEmail
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * setEmail
     * @return mixed
     */
    public function setEmail($post)
    {
        $this->email = get_field('email', $post);
    }
}
