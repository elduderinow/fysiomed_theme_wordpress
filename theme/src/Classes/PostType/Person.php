<?php

namespace Classes\PostType;

use Classes\General\Image;

class Person extends BasePost
{
    private $department;
    private $function;
    private $phone;
    private $mobile;
    private $email;
    private $avatar;

    public function __construct($post)
    {
        parent::__construct($post);

        $this->setDepartment($post);
        $this->setFunction($post);
        $this->setPhone($post);
        $this->setMobile($post);
        $this->setEmail($post);
        $this->setAvatar($post);
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }
    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $post
     */
    public function setDepartment($post): void
    {
        $this->department = get_field('department', $post);
    }

    /**
     * @param mixed $post
     */
    public function setFunction($post): void
    {
        $this->function = get_field('function', $post);
    }

    /**
     * @param mixed $post
     */
    public function setEmail($post): void
    {
        $this->email = get_field('email', $post);
    }

    /**
     * @param mixed $post
     */
    public function setMobile($post): void
    {
        $this->mobile = get_field('mobile', $post);
    }

    /**
     * @param mixed $post
     */
    public function setPhone($post): void
    {
        $this->phone = get_field('phone', $post);
    }

    /**
     * @param mixed $post
     */
    public function setAvatar($post): void
    {
        if (get_field('avatar', $post) !== null) {
            $this->avatar = new Image(get_field('avatar', $post),'acf');
        }
    }

}