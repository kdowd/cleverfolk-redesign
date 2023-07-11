<?php
/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE DESCRIPTION

	@param	$description string		The initial description.
--------------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_filter_archive_description')) :
    function mcluhan_filter_archive_description($description)
    {

        // On search, show a string describing the results of the search.
        if (is_search()) {
            global $wp_query;
            if ($wp_query->found_posts) {
                /* Translators: %s = Number of results */
                $description = sprintf(_x('We found %s matching your search query.', 'Translators: %s = the number of search results', 'mcluhan'), $wp_query->found_posts . ' ' . (1 == $wp_query->found_posts ? __('result', 'mcluhan') : __('results', 'mcluhan')));
            } else {
                /* Translators: %s = the search query */
                $description = sprintf(_x('We could not find any results for the search query "%s". You can try again through the form below.', 'Translators: %s = the search query', 'mcluhan'), get_search_query());
            }
        }

        return $description;
    }
    add_filter('get_the_archive_description', 'mcluhan_filter_archive_description');
endif;


/*	-----------------------------------------------------------------------------------------------
	PRE_GET_POSTS
--------------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_sort_search_posts_by_date')) {
    function mcluhan_sort_search_posts_by_date($query)
    {

        // In search, order results by date
        if (!is_admin() && $query->is_main_query() && $query->is_search()) {
            $query->set('orderby', 'date');
        }
    }
}
add_action('pre_get_posts', 'mcluhan_sort_search_posts_by_date');
