<?php

namespace Classes\Template;

use Classes\General\ProductCategory;
use Classes\General\Link;
use Classes\PostType\Page;

/**
 * Class Homepage: Specific fields only used on Homepage-template
 * @package Classes\Template
 */
class Homepage extends Page
{

	private $buttons;
	private $featuredCategories;
	private $featuredProducts;

	public function __construct($post)
	{
		parent::__construct($post);
		$this->setButtons($post);
		$this->setFeaturedCategories($post);
	}

	/**
	 * @return mixed
	 */
	public function getButtons()
	{
		return $this->buttons;
	}

	/**
	 * @param mixed $post
	 */
	public function setButtons($post): void
	{
		$buttonsData = get_field('buttons', $post);

		if (is_array($buttonsData) && !empty($buttonsData)) {
			$this->buttons = [];
			foreach ($buttonsData as $button) {
				$this->buttons[] = $button;
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getFeaturedCategories()
	{
		return $this->featuredCategories;
	}

	/**
	 * @param mixed $post
	 */
	public function setFeaturedCategories($post): void
	{
		$terms = get_field('featured_categories', $post);
		foreach ($terms as $term) {
			$this->featuredCategories[] = new ProductCategory($term);
		}
	}
}
