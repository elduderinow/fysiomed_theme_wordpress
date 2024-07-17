<?php

namespace Classes\Helper;

use Classes\PostType\Page;

class BaseContentHelper
{
    public function getEntities($classname, $term = null, $count = false, $sticky = false)
    {
        $fqn = 'Classes\\PostType\\' . $classname;

        $entities = [];
        $query = $this->_getEnititiesQuery($classname, $term, $count, $sticky);
        foreach ($query->posts as $post) {
            $entities['items'][] = new $fqn($post);
        }
        wp_reset_postdata();
        return $entities;
    }

    public function getEntitiesWithPagination($classname, $term = null, $count = false, $sticky = false)
    {
        $fqn = 'Classes\\PostType\\' . $classname;

        $entities = [];
        $query = $this->_getEnititiesQuery($classname, $term, $count, $sticky);
        foreach ($query->posts as $post) {
            $entities['items'][] = new $fqn($post);
        }

        $entities['pagination'] = $this->_getPagination($query);
        wp_reset_postdata();
        return $entities;
    }

	public function createEntitiesFromPosts($classname, $posts) {
		$fqn = 'Classes\\PostType\\' . $classname;

		$entities = [];
		foreach ($posts as $post) {
			$entities['items'][] = new $fqn($post);
		}
		return $entities;
	}

	public function getEntitiesByIds($classname, $ids = null, $count = false) {
		$fqn = 'Classes\\PostType\\' . $classname;

		$args = array(
			'post_type' => strtolower($classname),
			'post__in' => $ids,
			'posts_per_page' => $count
		);
		$posts = get_posts($args);

		foreach ($posts as $post) {
			$entities['items'][] = new $fqn($post);
		}
		wp_reset_postdata();
		return $entities;
	}

    private function _getPagination($query)
    {
        $helper = new ContentHelper();

        $pagination = null;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		var_dump($query->max_num_pages);

        if ($query->max_num_pages > 1) {
            $pagination = "<div class='pagination-wrapper'>";

	        if ($query->max_num_pages > 1) {
                for ($i = 1; $i <= $query->max_num_pages; $i++) {
	                if ($paged == $i ) {
	                    $active_class = "active";
	                }
	                else{
	                    $active_class = '';
	                }
	                $pagination .= "<div class='$active_class count p-text'><a href='" . $i . "' target='_self'>"  . $i . "</a></div>";
	            }
            }
        }
        var_dump($pagination);

		return $pagination;
    }

    private function _getEnititiesQuery($classname, $term = null, $count = false, $sticky = null)
    {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if ($classname == 'Article') {
            $posttype = 'post';
        } else {
            $posttype = strtolower($classname);
        }

        if ($count == null || $count == false) {
	        $count = get_option('posts_per_page');
        }

        if ($sticky!=null){
            $args['meta_key'] ='sticky_post';
        }

        $meta_args = [];
        if ($sticky === true) {
            $meta_args = array(
                'key'   => 'sticky_post',
                'value' => true,
            );
        }
        $args = array(
            'post_type' => $posttype,
            'status' => 'publish',
	        'numberposts' => $count,
            'posts_per_page' => $count,
            'suppress_filters' => 0,
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'paged' => $paged
        );
	    $orderby = (get_query_var('orderby'))? get_query_var('orderby'): '';
	    if (!empty ($orderby)) {
			switch ($orderby) {
				case 'price':
					$args['meta_key'] ='_price';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'ASC';
					break;
				case 'popularity':
					$args['meta_key'] ='total_sales';
					$args['orderby'] = 'meta_value_num';
					$args['order'] = 'DESC';
					break;
				default:
					$args['orderby'] = $orderby;
			}
	    }
		if (!empty($meta_args)) {
			$args['meta_query'] = array(
				array($meta_args)
			);
		}
        if (!empty($term)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $term->taxonomy,
                    'field' => 'slug',
                    'terms' => $term->slug,
                    'hide_empty' => true
                )
            );
		}

        return new \WP_Query($args);
    }
}
