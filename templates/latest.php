<?php
/** Template for latest post info */

$image_url = get_the_post_thumbnail_url();
if ( ! $image_url ) {
    /** Use some default image as backup if no image is set */
    $image_url = 'https://placehold.it/700x700';
}

/** Get display category */
$categories = get_the_category();
$category = ! empty( $categories ) ? esc_html( $categories[0]->name ) : ''; 

/** Format time information */
$last_modified = get_the_modified_time('U');
$display_time = human_time_diff( $last_modified, current_time('U') ) . ' ago';
?>

<div class="alp">
    <div class="alp-content">
        <div class="alp-img" style="background-image: url('<?php echo $image_url ?>')"></div>
        <div class="alp-details">
            <span class="alp-tag"><?php echo $category ?></span>
                <span class="alp-tagsep alp-mobile"> | </span>
            <span class="alp-time alp-mobile"><?php echo $display_time ?></span>
            <div class="alp-title"><?php echo get_the_title() ?></div>
            <div class="alp-subtitle alp-desktop">
                <span>By:
                    <span class="alp-author"><?php echo get_the_author() ?></span>
                </span>
                &nbsp;
                <span class="alp-time"><?php echo $display_time ?></span>
            </div>
        </div>
    </div>
</div>