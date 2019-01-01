<?php
  /*
   Adds a top-level field with featured image data including available sizes
   and URLs to the post object returned by the REST API.
   */
  add_action( 'init', 'featured_images_init', 12 );
  /*
   Register our enhanced better_featured_image field to all public post types
   that support post thumbnails.
   */
  function featured_images_init() {
    $post_types = get_post_types( array( 'public' => true ), 'objects' );
    foreach ( $post_types as $post_type ) {
      $post_type_name     = $post_type->name;
      $show_in_rest       = ( isset( $post_type->show_in_rest ) && $post_type->show_in_rest ) ? true : false;
      $supports_thumbnail = post_type_supports( $post_type_name, 'thumbnail' );
      // $field = get_field_object('field_5c2365e58d604');
      // $choices = $field['key'];
      // register_rest_field( $post_type_name,
      //   'debljine',
      //   array(
      //     'get_callback' => get_field_object('field_5c2365e58d604'),
      //     'schema'       => null,
      //   )
      // );
      // Only proceed if the post type is set to be accessible over the REST API
      // and supports featured images.
      if ( $show_in_rest && $supports_thumbnail ) {
        // Compatibility with the REST API v2 beta 9+
        if ( function_exists( 'register_rest_field' ) ) {
          register_rest_field( $post_type_name,
            'featuredImage',
            array(
              'get_callback' => 'featured_images_get_field',
              'schema'       => null,
            )
          );
        } elseif ( function_exists( 'register_api_field' ) ) {
          register_api_field( $post_type_name,
            'featuredImage',
            array(
              'get_callback' => 'featured_images_get_field',
              'schema'       => null,
            )
          );
        }
      }
    }
  }
  // Return the better_featured_image field.
  function featured_images_get_field( $object, $field_name, $request ) {
    // Only proceed if the post has a featured image.
    if ( ! empty( $object['featured_media'] ) ) {
      $image_id = (int)$object['featured_media'];
    } elseif ( ! empty( $object['featured_image'] ) ) {
      // This was added for backwards compatibility with < WP REST API v2 Beta 11.
      $image_id = (int)$object['featured_image'];
    } else {
      return null;
    }
    $image = get_post( $image_id );
    if ( ! $image ) {
      return null;
    }
    // This is taken from WP_REST_Attachments_Controller::prepare_item_for_response().
    $featured_image['id']            = $image_id;
    $featured_image['alt_text']      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
    $featured_image['caption']       = $image->post_excerpt;
    $featured_image['description']   = $image->post_content;
    $featured_image['media_type']    = wp_attachment_is_image( $image_id ) ? 'image' : 'file';
    $featured_image['media_details'] = wp_get_attachment_metadata( $image_id );
    $featured_image['post']          = ! empty( $image->post_parent ) ? (int) $image->post_parent : null;
    $featured_image['source_url']    = wp_get_attachment_url( $image_id );
    if ( empty( $featured_image['media_details'] ) ) {
      $featured_image['media_details'] = new stdClass;
    } elseif ( ! empty( $featured_image['media_details']['sizes'] ) ) {
      $img_url_basename = wp_basename( $featured_image['source_url'] );
      foreach ( $featured_image['media_details']['sizes'] as $size => &$size_data ) {
        $image_src = wp_get_attachment_image_src( $image_id, $size );
        if ( ! $image_src ) {
          continue;
        }
        $size_data['source_url'] = $image_src[0];
      }
    } elseif ( is_string( $featured_image['media_details'] ) ) {
      // This was added to work around conflicts with plugins that cause
      // wp_get_attachment_metadata() to return a string.
      $featured_image['media_details'] = new stdClass();
      $featured_image['media_details']->sizes = new stdClass();
    } else {
      $featured_image['media_details']['sizes'] = new stdClass;
    }
    return apply_filters( 'better_rest_api_featured_image', $featured_image, $image_id );
  }