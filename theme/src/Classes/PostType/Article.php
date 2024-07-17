<?php namespace Classes\PostType;

use Classes\Traits\Paragraphs;

/**
 * Class Article: News-article - POST
 * @package Classes\PostType
 */
class Article extends BasePost
{
    use Paragraphs;

    private $subtitle;
	private $linkedProduct;

    public function __construct($post) {
        parent::__construct($post);

        $this->setSubtitle($post);
		$this->setLinkedProduct($post);
        $this->setParagraphs($post);
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param mixed $post
     */
    public function setSubtitle($post): void
    {
        $this->subtitle = get_field('subtitle', $post);
    }

	/**
	 * @return mixed
	 */
	public function getLinkedProduct()
	{
		return $this->linkedProduct;
	}
	/**
	 * @param mixed $linkedProduct
	 */
	public function setLinkedProduct($post): void
	{
		if (get_field('product', $post)) {
			$this->linkedProduct = New Product(get_field('product', $post));
		}
	}
}
