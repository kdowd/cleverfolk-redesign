<?php

/*	-----------------------------------------------------------------------------------------------
	CUSTOM COMMENT OUTPUT
--------------------------------------------------------------------------------------------------- */

if (!function_exists('mcluhan_comment')) :
    function mcluhan_comment($comment, $args, $depth)
    {

        switch ($comment->comment_type):
            case 'pingback':
            case 'trackback':
                global $post;
?>

<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <?php _e('Pingback:', 'mcluhan'); ?> <?php comment_author_link(); ?>
    <?php edit_comment_link(__('Edit', 'mcluhan')); ?>

    <?php

                break;

            default:
                global $post;
                ?>
    <div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

        <div id="comment-<?php comment_ID(); ?>">

            <header class="comment-meta">

                <span class="comment-author">
                    <cite>
                        <?php echo get_comment_author_link(); ?>
                    </cite>

                    <?php
                                    if ($comment->user_id === $post->post_author) {
                                        echo '<span class="comment-by-post-author"> (' . __('Author', 'mcluhan') . ')</span>';
                                    }
                                    ?>
                </span>

                <span class="comment-date">
                    <a class="comment-date-link" href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"
                        title="<?php echo get_comment_date() . ' ' . __('at', 'mcluhan') . ' ' . get_comment_time(); ?>"><?php echo get_comment_date(get_option('date_format')); ?></a>
                </span>

                <?php
                                comment_reply_link(array(
                                    'after'            => '</span>',
                                    'before'        => '<span class="comment-reply">',
                                    'depth'            => $depth,
                                    'max_depth'     => $args['max_depth'],
                                    'reply_text'     => __('Reply', 'mcluhan'),
                                ));
                                ?>

            </header>

            <div class="comment-content entry-content">

                <?php comment_text(); ?>

            </div><!-- .comment-content -->

            <div class="comment-actions">
                <?php if ('0' == $comment->comment_approved) : ?>
                <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'mcluhan'); ?>
                </p>
                <?php endif; ?>
            </div><!-- .comment-actions -->

        </div><!-- .comment -->

        <?php
                break;
        endswitch;
    }
endif; // End if().