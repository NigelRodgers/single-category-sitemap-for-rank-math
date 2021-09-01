<?php

namespace RankMath\Sitemap\Providers;

defined( 'ABSPATH' ) || exit;

class Custom implements Provider {

	public function handles_type( $type ) {
		return true;
	}

	public function get_index_links( $max_entries ) {
		return [];
	}

	public function get_sitemap_links( $type, $max_entries, $current_page ) {
		$links     = array(); 
		
        $category_query_args = array(
            'cat' => 6, //use the category id for your category
			'orderby' => 'modified'
        );
        
        $category_query = new \WP_Query( $category_query_args );

        if ( $category_query->have_posts() ) : while ($category_query->have_posts()) : $category_query->the_post();
        $links[] = [ 'loc' => \get_permalink()];
        
        endwhile; endif;

		return $links;
	}

}
