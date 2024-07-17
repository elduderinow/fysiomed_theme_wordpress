<?php
namespace Classes\PostType;

use Classes\General\Image;

/**
 * Class BasePost: post object with the most common properties for a post-object in WP
 * @package Classes\PostType
 */
class BasePost
{
    private $id;
    private $title;
    private $intro;
    private $tags;
    private $excerpt;
    private $permalink;
    private $slug;
    private $date;
    private $author;
    private $status;
    private $image;
    private $wpObject;

    public function __construct($post) {
        if (isset($post)) {
            $this->setId($post->ID);
            $this->setTitle($post->post_title);
            $this->setIntro(apply_filters("the_content", $post->post_content));
            $this->setPermalink($post->ID);
            $this->setSlug($post->post_name);
            $this->setDate($post->post_date);
            $this->setAuthor($post->post_author);
            $this->setStatus(get_post_status($post));
            $this->setTags(get_the_tags($post->ID));
            $this->setExcerpt($post, 30, 'strip_all');
            $this->setImage($post);
            $this->setWpObject($post);
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getIntro()
    {
        return $this->intro;
    }
    public function getExcerpt()
    {
        return $this->excerpt;
    }
    public function getPermalink()
    {
        return $this->permalink;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getTags()
    {
        return $this->tags;
    }
    public function getImage()
    {
            return $this->image;
    }
    public function getWpObject(): \WP_Post
    {
        return $this->wpObject;
    }

    /**
     * setId
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * setTitle
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
    /**
     * setIntro
     * @param mixed $intro
     */
    public function setIntro($intro): void
    {
        $this->intro = $intro;
    }
    /**
     * setPermalink
     * @param mixed $id = postID
     */
    public function setPermalink($id): void
    {
        $this->permalink = get_permalink($id);
    }
    /**
     * setSlug
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }
    /**
     * setDate
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;;
    }
    /**
     * setAuthor
     * @param mixed $author
     */
    public function setAuthor($authorId): void
    {
        $this->author = get_the_author_meta('user_nicename', $authorId);
    }
    /**
     * setStatus
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
    /**
     * setTags
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }
    /**
     * setExcerpt
     * set the excerpt from a WP Post-object
     * @param $post
     * @param int $length
     * @param string $tags
     * @param string $extra
     */
    public function setExcerpt($post, int $length = 30, string $tags = '<a><em><strong>', string $extra = '...') {
        if (isset($post)) {
            if(has_excerpt($post->ID)) {
                $this->excerpt = $post->post_excerpt;
            }
            else {
                $the_excerpt = $post->post_content;

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
    }
    /**
     * setImage
     * set the image-object with all generated sizes
     */
    public function setImage($post) {
        if (isset($post) && has_post_thumbnail($post)) {
            $img = New Image($post, "post");
            if (!empty($img->getSizes())) {
                $this->image = $img;
            }
        }
    }
    /**
     * setWpObject
     * @param mixed $wpObject
     */
    public function setWpObject($wpObject): void
    {
        $this->wpObject = $wpObject;
    }
}
