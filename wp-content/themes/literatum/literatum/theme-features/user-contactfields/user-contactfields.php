<?php
/**
 * Add extra contact fields to the user edit page
 *
 */





function KTT_add_contactmethod( $contactmethods ) {
  // Add Twitter
  if ( !isset( $contactmethods['twitter'] ) )
    $contactmethods['twitter'] = __('Twitter username', THEME_TEXTDOMAIN);

  if ( !isset( $contactmethods['facebook'] ) )
    $contactmethods['facebook'] = __('Facebook username',THEME_TEXTDOMAIN);

  // Remove Yahoo IM
  if ( isset( $contactmethods['yim'] ) )
    unset( $contactmethods['yim'] );

  return $contactmethods;
}
add_filter( 'user_contactmethods', 'KTT_add_contactmethod', 10, 1 );


?>