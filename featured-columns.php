<?php
   /*
   Plugin Name: Featured Columns
   description: adds featured column to news and events
   Version: 1.0
   */

// add the featured column
function cspw_add_featured_column($columns) {
   $columns['featured'] = __( 'Featured' );

   $n_columns = array();
   $move = 'featured'; // what to move
   $before = 'date'; // move before this
   foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
   }
   return $n_columns;
};

add_filter('manage_news_posts_columns', 'cspw_add_featured_column');
add_filter('manage_event_posts_columns', 'cspw_add_featured_column');

// populate the featured column
function cswp_populate_column($column_name, $post_ID) {
    if ($column_name == 'featured') {

      if (get_post_type($post_ID) == 'news' ) {
        $post_featured = get_field('news_featured', $post_ID);
     } elseif (get_post_type($post_ID) == 'event') {
      $post_featured = get_field('event_featured', $post_ID);
     };

        if ($post_featured) {
         echo 'Yes';
        } else {
         echo 'No';
        }
    }
}


add_action('manage_news_posts_custom_column', 'cswp_populate_column', 10, 2);
add_action('manage_event_posts_custom_column', 'cswp_populate_column', 10, 2);


// style the featured column

function cspw_featured_column_style(){
   $column_name = 'featured';//column slug
   echo "<style>.column-$column_name{width:15%;}</style>";
}

add_filter('admin_head', 'cspw_featured_column_style');

// make the featured column to be sortable by alphabet
add_filter( 'manage_edit-news_sortable_columns', 'cspw_manage_sortable_columns' );
add_filter( 'manage_edit-event_sortable_columns', 'cspw_manage_sortable_columns' );
function cspw_manage_sortable_columns( $sortable_columns ) {
   $sortable_columns[ 'featured' ] = 'featured';
   return $sortable_columns;
}


add_action( 'pre_get_posts', 'manage_wp_posts_be_qe_pre_get_posts', 1 );
function manage_wp_posts_be_qe_pre_get_posts( $query ) {

   if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
      switch( $orderby ) {
         case 'featured':
         if ($query->get( 'post_type' ) == "news") {
            $query->set( 'meta_key', 'news_featured' );
            $query->set( 'orderby', 'meta_value' );
            break;
         } elseif ($query->get( 'post_type' ) == "event") {
            $query->set( 'meta_key', 'event_featured' );
            $query->set( 'orderby', 'meta_value' );
            break;
         };
      }
   }
}
