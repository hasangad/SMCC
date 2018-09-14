<?php
/*-------------------------------------------*/
add_action( 'init', 'slider' );
function slider() {
register_post_type( 'slider',
array(
'labels' => array(
'name' => 'العارض الرئيسي'
),
'public' => true,
'supports' =>
array( 'title', 'editor', 'thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-welcome-view-site',
'has_archive' => true
)
);
}

/*-------------------------------------------*/
add_action( 'init', 'news' );
function news() {
register_post_type( 'news',
array(
'labels' => array(
'name' => 'الأخبار'
),
'public' => true,
'supports' =>
array( 'title', 'editor', 'thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-welcome-widgets-menus',
'has_archive' => true
)
);
}
/*-------------------------------------------*/
add_action( 'init', 'projects' );
function projects() {
register_post_type( 'projects',
array(
'labels' => array(
'name' => 'مشاريعنا'
),
'public' => true,
'supports' =>
array( 'title', 'editor', 'thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-screenoptions',
'has_archive' => true
)
);
}
/*-------------------------------------------*/
add_action( 'init', 'media' );
function media() {
register_post_type( 'media',
array(
'labels' => array(
'name' => 'مرئيات '
),
'public' => true,
'supports' =>
array( 'title', 'editor','thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-format-video',
'has_archive' => true
)
);
}
/*-------------------------------------------*/
add_action( 'init', 'serv' );
function serv() {
register_post_type( 'serv',
array(
'labels' => array(
'name' => 'الخدمات '
),
'public' => true,
'supports' =>
array( 'title', 'editor', 'thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-menu',
'has_archive' => true
)
);
}

/*-------------------------------------------*/
add_action( 'init', 'activity' );
function activity() {
register_post_type( 'activity',
array(
'labels' => array(
'name' => 'أنشطة وفاعليات'
),
'public' => true,
'supports' =>
array( 'title', 'editor', 'thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-menu',
'has_archive' => true
)
);
}

/*-------------------------------------------*/
add_action( 'init', 'home_ads' );
function home_ads() {
register_post_type( 'home_ads',
array(
'labels' => array(
'name' => 'إعلانات الرئيسية'
),
'public' => true,
'supports' =>
array( 'title', 'editor','thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-menu',
'has_archive' => true
)
);
}

/*-------------------------------------------*/
add_action( 'init', 'Partner' );
function Partner() {
register_post_type( 'Partner',
array(
'labels' => array(
'name' => 'شركاؤنا'
),
'public' => true,
'supports' =>
array( 'title', 'editor', 'thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-groups',
'has_archive' => true
)
);
}

/*---------------------- Contact -------------------*/
add_action( 'init', 'create_contact' );
function create_contact() {
register_post_type( 'contact',
array(
'labels' => array(
'name' => 'بيانات التواصل'
),
'public' => true,
'supports' =>
array( 'title','editor','thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-email-alt',
'has_archive' => true
)
);
}


/*---------------------- Social -------------------*/
add_action( 'init', 'create_social' );
function create_social() {
register_post_type( 'social',
array(
'labels' => array(
'name' => 'الروابط الإجتماعية'
),
'public' => true,
'supports' =>
array( 'title', 'editor','thumbnail',  ),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-share',
'has_archive' => true
)
);
}
/*---------------------- Contact Forms -------------------*/
add_action( 'init', 'cfz' );
function cfz() {
register_post_type( 'cfz',
array(
'labels' => array(
'name' => 'نماذج المراسلة'
),
'public' => true,
'supports' =>
array( 'title',),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-email-alt',
'has_archive' => true
)
);
}
/*---------------------- Contact Forms -------------------*/
/*add_action( 'init', 'nletter' );
function nletter() {
register_post_type( 'nletter',
array(
'labels' => array(
'name' => 'النشرات البريدية'
),
'public' => true,
'supports' =>
array( 'title',),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-email-alt',
'has_archive' => true
)
);
}*/
/*---------------------- Contact Forms -------------------*/
add_action( 'init', 'nletter_users' );
function nletter_users() {
register_post_type( 'nletter_users',
array(
'labels' => array(
'name' => 'مشتركي النشرات البريدية'
),
'public' => true,
'supports' =>
array( 'title'),
'taxonomies' => array( '' ),
'menu_icon' =>'dashicons-email-alt',
'has_archive' => true
)
);
}
/*
function add_product_taxonomies() {
	register_taxonomy('products-categories', 'products', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'تصنيفات المنتجات', 'taxonomy general name' ),
			'singular_name' => _x( 'Review-Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Review-Categories' ),
			'all_items' => __( 'All Review-Categories' ),
			'parent_item' => __( 'Parent Review-Category' ),
			'parent_item_colon' => __( 'Parent Review-Category:' ),
			'edit_item' => __( 'Edit Review-Category' ),
			'update_item' => __( 'Update Review-Category' ),
			'add_new_item' => __( 'Add New Review-Category' ),
			'new_item_name' => __( 'New Review-Category Name' ),
			'menu_name' => __( 'Review Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'products-categories', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_product_taxonomies', 0 );*/
?>
