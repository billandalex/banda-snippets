<?php


/**
 * Adds a meta box to the post editing screen
 */
function banda_snippets_code_custom_meta() {
    add_meta_box( 'banda_snippets_code_meta', __( 'Code snippet', 'banda_snippets_code-textdomain' ), 'banda_snippets_code_meta_callback', 'banda_snippets' );
}
add_action( 'add_meta_boxes', 'banda_snippets_code_custom_meta' );

/**
 * Outputs the content of the meta box in the backend
 */
function banda_snippets_code_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'banda_snippets_code_nonce' );
    $banda_snippets_code_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <label for="meta-text" class="banda_snippets_code_custom_meta-row-title"><?php _e( '', 'banda_snippets_code-textdomain' )?></label>
        <pre><textarea rows="1" cols="40" type="text" name="meta-text" id="meta-text" class="meta-box-full-width"><?php if ( isset ( $banda_snippets_code_stored_meta['meta-text'] ) ) echo $banda_snippets_code_stored_meta['meta-text'][0]; ?></textarea></pre>
    </p>

    <?php
}

/**
 * Saves the custom meta input
 */
function banda_snippets_code_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'banda_snippets_code_nonce' ] ) && wp_verify_nonce( $_POST[ 'banda_snippets_code_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }

}
add_action( 'save_post', 'banda_snippets_code_meta_save' );

//  Custom css
add_action('admin_head', 'banda_snippets_custom_css');

function banda_snippets_custom_css() {
  echo '<style>
    .meta-box-full-width {
      width: 100%;
      height: 100px;
    }
  </style>';
}
