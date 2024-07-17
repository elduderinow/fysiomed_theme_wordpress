<?php

namespace Classes\PostType;

use Classes\General\Category;
use Classes\General\Image;

class Product extends BasePost
{
	private $hasVariants;
	private $wcProduct;
	private $gallery;
	private $productTags;
	private $downloads = [];

	public function __construct($post) {
		parent::__construct($post);
		$this->setWcProduct($post);

		$this->setHasVariants($this->wcProduct);
		$this->setGallery($this->wcProduct);
		$this->setProductTags($this->wcProduct);
		$this->setDownloads($post);
	}

	/**
	 * @param mixed $post
	 */
	public function setWcProduct($post): void
	{
		$this->wcProduct = wc_get_product($post->ID);;
	}

	public function setDownloads($post) {
		
		$downloads = get_field('product_download', $post);
		$downs = [];
		if(empty($downloads)) return;
		foreach($downloads as $download) {
			$downs[] = [
				'name' => $download['product_download_name'],
				'file' => $download['product_download_file']
			];
		}
		$this->downloads = $downs;
	}

	public function getDownloads() {
		return $this->downloads;
	}

	/**
	 * @return mixed
	 */
	public function getWcProduct()
	{
		return $this->wcProduct;
	}

	/**
	 * @return mixed
	 */
	public function getHasVariants()
	{
		return $this->hasVariants;
	}

	/**
	 * @param mixed $prod
	 */
	public function setHasVariants($product): void
	{
		$this->hasVariants = false;

		if ($product && $product->is_type('variable')) {
			$this->hasVariants = true;
		} else {
			$this->hasVariants = false;
		}
	}

	/**
	 * @return mixed
	 */
	public function getGallery()
	{
		return $this->gallery;
	}

	/**
	 * @param mixed $prod
	 */
	public function setGallery($product): void
	{
		//featured image
		$this->gallery[] = $this->getImage();

		//gallery images from product
		$gallery_ids = $product->get_gallery_image_ids();
		foreach ($gallery_ids as $image_id) {
			$image_obj = get_post($image_id);
			$this->gallery[] = new Image($image_obj, "image");
		}
	}

	/**
	 * @param mixed $prod
	 */
	public function setProductTags($product): void
	{
		$terms = get_the_terms( $product->get_id(), 'product_tag' );
		if ($terms) {
			foreach ($terms as $term) {
				$this->productTags[] = new Category($term);
			}
		}

	}

	/**
	 * @return mixed
	 */
	public function getProductTags()
	{
		return $this->productTags;
	}
}