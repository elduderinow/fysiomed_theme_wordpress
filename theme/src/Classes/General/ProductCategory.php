<?php
namespace Classes\General;

class ProductCategory extends Category
{

    private $image;

    public function __construct($term){
	    parent::__construct($term);
		$this->setImage($term);
    }

    /**
     * getImageOverview
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * setImage
     * @param mixed $image
     */
    public function setImage($term)
    {
        $this->image = new Image($term, "woo-term");
    }

}
