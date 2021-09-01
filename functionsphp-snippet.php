
include_once 'custom-sitemap.php';
add_filter('rank_math/sitemap/providers', function( $external_providers ) {
	$external_providers['custom'] = new \RankMath\Sitemap\Providers\Custom();
	return $external_providers;
});



add_filter( 'rank_math/sitemap/enable_caching', '__return_false');

add_filter( 'rank_math/sitemap/index', function( $xml ) {
    $category_query_args = array(
        'cat' => 6, //use the category id for your category
        'orderby' => 'modified',
        'posts_per_page' => 1
    );
    $category_query = new \WP_Query( $category_query_args );

    if ( $category_query->have_posts() ) : while ($category_query->have_posts()) : $category_query->the_post();
        
        
        
	$xml .= '
		<sitemap>
			<loc>'.get_site_url().'/custom-sitemap.xml</loc>
			<lastmod>'.get_the_modified_date('Y-m-d H:i:sP' ).'</lastmod>
		</sitemap>'; //Replace when time is determined:<lastmod>2020-09-14T20:34:15+00:00</lastmod>
    endwhile; endif;
		return $xml;
}, 11 );
