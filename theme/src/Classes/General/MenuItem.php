<?php
namespace Classes\General;

class MenuItem
{

    private $label;
    private $url;
	private $target;
    private $isChild;

    public function __construct($object) {
        $this->setMenuItem($object);
    }
    public function getLabel() {
        return $this->label;
    }
    public function getUrl() {
        return $this->url;
    }
    public function getIsChild() {
        return $this->isChild;
    }
	public function getTarget() {
		return $this->target;
	}
    public function setMenuItem($object){
        $this->label = $object->title;
        $this->url = $object->url;
	    $this->target = $object->target;
        if ($object->menu_item_parent == 0) {
            $this->isChild = 0;
        }
        else {
            $this->isChild = 1;
        }
    }
}