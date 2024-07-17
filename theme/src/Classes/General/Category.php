<?php
namespace Classes\General;

class Category
{
    private $id;
    private $name;
    private $title;
    private $slug;
    private $parent;
    private $description;
    private $excerpt;
    private $link;
    private $image;


    /**
     * @param $term
     */
    public function __construct($term){
        $this->setId($term->term_id);
        $this->setTitle($term->name);
        $this->setName($term->name);
        $this->setSlug($term->slug);
        $this->setParent($term->parent);
        $this->setDescription($term->description);
        $this->setExcerpt();
        $this->setLink($term);
    }

    /**
     * getId
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * getTitle
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * getName
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * getSlug
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * getParent
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * getDescription
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * getExcerpt
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }
    /**
     * getLink
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
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
     * setId
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * setTitle
     * @param mixed $name
     */
    public function setTitle($name)
    {
        $this->title = $name;
    }
    /**
     * setName
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * setSlug
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
    /**
     * setParent
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    /**
     * setDescription
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * setExcerpt
     * @param mixed $excerpt
     */
    public function setExcerpt($length = 30, $tags = '<a><em><strong>', $extra = '...')
    {
        if (isset($this->description)) {
            $the_excerpt = $this->description;

            //met of zonder markup.
            if ($tags == 'strip_all') {
                $the_excerpt = strip_shortcodes(strip_tags($the_excerpt));
            } else {
                $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
            }

            //opsplitsen in woorden
            $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
            $excerpt_waste = array_pop($the_excerpt);
            $the_excerpt = implode($the_excerpt);
            $the_excerpt .= $extra;

            //met of zonder <p>
            if ($tags == 'strip_all') {
                $this->excerpt = $the_excerpt;
            } else {
                $this->excerpt = apply_filters('the_content', $the_excerpt);
            }
        }
    }
    /**
     * setLink
     * @param mixed $link
     */
    public function setLink($term)
    {
        $this->link = get_term_link($term);
    }
    /**
     * setImage
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = new Image($image, "acf");
    }

}
