<?php
namespace Classes\Helper;

use Classes\PostType\Product;

class WooHelper
{
	public function getProducts($category = null) {
		$helper = new BaseContentHelper();
		$products = $helper->getEntities('Product', $category);
		return $products;
	}

	public function getFeaturedProducts($count = -1) {
		$helper = new BaseContentHelper();

		$ids = wc_get_featured_product_ids();
		$products = $helper->getEntitiesByIds('Product', $ids, $count);

		return $products;
	}
}
