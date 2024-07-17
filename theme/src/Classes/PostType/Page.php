<?php

namespace Classes\PostType;

use Classes\Traits\Paragraphs;

class Page extends BasePost
{
    use Paragraphs;

    private $template;
    private $subtitle;
    private $buttons;

    public function __construct($post)
    {
        parent::__construct($post);

        $this->setTemplate($post);
        $this->setSubtitle($post);
        $this->setParagraphs($post);
        $this->setButtons($post);
    }

    /**
     * getTemplate
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @return string
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * setTemplate
     * @param mixed $post
     */
    public function setTemplate($post)
    {
        $this->template = get_page_template_slug($post->ID);
    }

    /**
     * @param mixed $post
     */
    public function setSubtitle($post): void
    {
        $this->subtitle = get_field('subtitle', $post->ID);
    }

    /**
     * @param mixed $post
     */
    public function setButtons($post): void
    {
        $this->buttons = get_field('buttons', $post->ID);
    }
}
