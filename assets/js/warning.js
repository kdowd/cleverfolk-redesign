setTimeout((e) => {
  alert("This is in development , no orders will be taken and no money debited.");
}, 2000);

// https://wpshout.com/get_queried_object-how-and-why-to-use-it-with-examples/#gref
// get_queried_object is the single src of truth for the page - not that one in the loop.

// The “currently-queried object” means the object that is the subject of the webpage:

// – On a category archive, tag archive, or other taxonomy archive page, it will return the WP_Term object of the current category,
// tag, or other term.
// – If you have set a posts page where your basic posts are displayed, get_queried_object() will return the WP_Post object of that page.
// – On post type archive pages, it will return the WP_Post_Type object of the given post type.
// – On an author archive page, it will return the WP_User object of that author.
// – On any singular page (a single post, a single page, or a post in a custom post type), it will return the WP_Post object of that post or page.

// Be careful not to use get_queried_object() and get_post() or global $post interchangeably.
// On a singular post, those will all return the same thing.But, for example, if you have a page called “Blog” that displays
// your posts, get_queried_object()
// will return the “Blog” page whereas get_post() will return the current post in the loop.
