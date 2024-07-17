<?php
namespace Classes\General;

class MetaData
{
    private string $title;
    private string $description;
    private string $keywords;
    private string $imageUrl;
    private string $url;
    private string $author;
    private string $yoastActive;

    private function __construct($title = "", $description = "", $keywords = "", $imageUrl = "", $url = "", $author = "") {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setKeywords($keywords);
        $this->setImageUrl($imageUrl);
        $this->setUrl($url);
        $this->setAuthor($author);
    }

    /** Static Constructors **/
    public static function constructFromData($title, $description, $keywords, $imageUrl, $url, $author): MetaData
    {
        $metaData = new static($title, $description, $keywords, $imageUrl, $url, $author);
        $metaData->yoastActive = is_plugin_active('wordpress-seo/wp-seo.php');
        return $metaData;
    }
    public static function constructFromPost($post): MetaData
    {
        $metaData = new static();

        $desc = $metaData->getExcerptFromPost($post, 30, 'strip_all', '');

        $metaData->title = strip_tags($post->post_title);
        $metaData->description = $desc;
        $metaData->keywords = get_the_tags($post->ID);
        $metaData->url = get_the_permalink($post->ID);
        $metaData->author = get_the_author_meta('user_nicename', $post->post_author);
        $metaData->yoastActive = is_plugin_active('wordpress-seo/wp-seo.php');

        if (has_post_thumbnail($post)) {
            $img = $metaData->getImageFromPost($post);
            $metaData->imageUrl = $img->getSizes()['social_media'];
        }

        return $metaData;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
    /**
     * @return bool
     */
    public function getYoastActive(): bool
    {
        return $this->yoastActive;
    }
    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }
    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }
    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    /**
     * @param bool $yoastActive
     */
    public function setYoastActive(bool $yoastActive): void
    {
        $this->yoastActive = $yoastActive;
    }
    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }


    /** Private functions **/
    private function getImageFromPost($post): ?Image
    {
        if (isset($post)) {
            $img = New Image($post, "post");
            if (empty($img->getSizes())) {
                $frontpage_id = get_option( 'page_on_front' );
                $frontpage = get_post($frontpage_id);
                $img = New Image($frontpage, "post");
            }
            return $img;
        }
        else {
            return null;
        }
    }
    private function getExcerptFromPost($post, $length = 30, string $tags = '<a><em><strong>', $extra = '...')
    {
        $excerpt = "";
        if (isset($post)) {
            if (has_excerpt($post->ID)) {
                $excerpt = $post->post_excerpt;
            } else {
                $the_excerpt = $post->post_content;

                //met of zonder markup.
                if ($tags == 'strip_all') {
                    $the_excerpt = strip_shortcodes(strip_tags($the_excerpt));
                } else {
                    $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
                }

                //opsplitsen in woorden
                $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2 + 1);
                $excerpt_waste = array_pop($the_excerpt);
                $the_excerpt = implode($the_excerpt);
                $the_excerpt .= $extra;

                //met of zonder <p>
                if ($tags != 'strip_all') {
                    $excerpt = apply_filters('the_content', $the_excerpt);
                }
                else {
                    $excerpt = $the_excerpt;
                }
            }
        }
        return $excerpt;
    }


}
