<?php

namespace Classes\PostType;

use Classes\General\Image;

class Company extends BasePost
{
    private $logo;
    private $website;

    public function __construct($post)
    {
        parent::__construct($post);

        $this->setLogo($post);
        $this->setWebsite($post);
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }
    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }
    /**
     * @param mixed $post
     */
    public function setLogo($post): void
    {
        $this->logo = new Image(get_field('logo', $post),'acf');
    }

    /**
     * @param mixed $post
     */
    public function setWebsite($post): void
    {
        $this->website = get_field('website', $post);
    }


}
