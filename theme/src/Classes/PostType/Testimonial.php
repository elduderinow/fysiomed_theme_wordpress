<?php
namespace Classes\PostType;

use Classes\Traits\Paragraphs;

class Testimonial extends BasePost
{

    use Paragraphs;

    private $testimonialAuthor;

    public function __construct($post)
    {
        parent::__construct($post);
        $this->setTestimonialAuthor($post);
        $this->setParagraphs($post);
    }

    /**
     * @return mixed
     */
    public function getTestimonialAuthor()
    {
        return $this->testimonialAuthor;
    }

    /**
     * @param mixed $post
     */
    public function setTestimonialAuthor($post): void
    {
        $this->testimonialAuthor = New Person(get_field('author', $post));
    }


}