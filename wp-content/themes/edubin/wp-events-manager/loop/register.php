<?php
/**
 * The Template for displaying register button in single event page.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/loop/register.php
 *
 * @author        ThimPress, leehld
 * @package       WP-Events-Manager/Template
 * @version       2.1.7
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( wpems_get_option( 'allow_register_event' ) == 'no' ) {
	return;
}

$edubin_single_tp_event_countdown = Edubin::setting( 'edubin_single_tp_event_countdown' );
$edubin_single_tp_event_cost = Edubin::setting( 'edubin_single_tp_event_cost' );
$edubin_single_tp_event_date = Edubin::setting( 'edubin_single_tp_event_date' );
$edubin_single_tp_event_time = Edubin::setting( 'edubin_single_tp_event_time' );
$edubin_single_tp_event_seat = Edubin::setting( 'edubin_single_tp_event_seat' );
$edubin_tp_single_event_btn = Edubin::setting( 'edubin_tp_single_event_btn' );
$edubin_single_tp_event_booking = Edubin::setting( 'edubin_single_tp_event_booking' );
$edubin_single_tp_event_booking_btn_text = Edubin::setting( 'edubin_single_tp_event_booking_btn_text' );
$edubin_single_tp_event_booking_btn_type = Edubin::setting( 'edubin_single_tp_event_booking_btn_type' );
$edubin_tp_events_start_date_format = Edubin::setting( 'edubin_tp_events_start_date_format' );
$edubin_tp_events_end_date_format = Edubin::setting( 'edubin_tp_events_end_date_format' );
$edubin_tp_events_time_format = Edubin::setting( 'edubin_tp_events_time_format' );

$event           = new WPEMS_Event( get_the_ID() );
$user_reg        = $event->booked_quantity( get_current_user_id() );
$date_start      = $event->__get( 'date_start' ) ? date( $edubin_tp_events_start_date_format, strtotime( $event->__get( 'date_start' ) ) ) : '';
$time_start      = $event->__get( 'time_start' ) ? date( $edubin_tp_events_time_format, strtotime( $event->__get( 'time_start' ) ) ) : '';
$date_end        = $event->__get( 'date_end' ) ? date( $edubin_tp_events_end_date_format, strtotime( $event->__get( 'date_end' ) ) ) : '';
$time_end        = $event->__get( 'time_end' ) ? date( $edubin_tp_events_time_format, strtotime( $event->__get( 'time_end' ) ) ) : '';
$g_calendar_link = 'http://www.google.com/calendar/event?action=TEMPLATE&text=' . urlencode( $event->get_title() );
$g_calendar_link .= '&dates=' . $date_start . ( $time_start ? 'T' . $time_start : '' ) . '/' . $date_end . ( $time_end ? 'T' . $time_end : '' );
$g_calendar_link .= '&details=' . urlencode( $event->post->post_content );
$g_calendar_link .= '&location=' . urlencode( $event->__get( 'location' ) );
$g_calendar_link .= '&trp=false&sprop=' . urlencode( get_permalink( $event->ID ) );
$g_calendar_link .= '&sprop=name:' . urlencode( get_option( 'blogname' ) );
$time_zone       = get_option( 'timezone_string' ) ? get_option( 'timezone_string' ) : 'UTC';
$g_calendar_link .= '&ctz=' . urlencode( $time_zone );
$register_status = true;

if ( absint( $event->qty ) == 0 || get_post_meta( get_the_ID(), 'tp_event_status', true ) === 'expired' ) {
	$register_status = false;
}

$extra_meta = get_post_meta( get_the_ID(), 'edubin_tp_event_extra_meta_fields', true ); 

echo '<div class="tpc-event-sidebar sidebar tpc-sidebar-get-sticky">';
    echo '<div class="inner">';
        echo '<div class="content">';

            if ( $edubin_single_tp_event_countdown ) {
                do_action( 'tp_event_loop_event_countdown' );
            };

          // echo '<h4 class="widget-title">' . esc_html__( 'Event Info', 'edubin' ) . '</h4>';

            echo '<ul class="event-meta">';
                if ( $edubin_single_tp_event_cost  ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-price-tag"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap price-meta">';
                            echo '<h5 class="label">' . esc_html__( 'Event Cost', 'edubin' ) . '</h5>';
                            echo '<span class="value price">';
                                printf( '%s', $event->is_free() ? __( 'Free', 'edubin' ) : wpems_format_price( $event->get_price() ) );
                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };

                if ( $edubin_single_tp_event_date ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-calendar"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Event Date', 'edubin' ) . '</h5>';
                            echo '<span class="value">';

                                echo esc_html( $date_start );
                    
                                if ( $date_start !== $date_end ) {
                                    if (!empty($date_end)) {
                                        echo esc_attr( ' - ' );
                                    }
                                echo esc_html( $date_end );
                                }

                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };

                if ( $edubin_single_tp_event_time && $time_start ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-start"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Start Time', 'edubin' ) . '</h5>';
                            echo '<span class="value">';

                                echo esc_html( $time_start );
                            
                                if ( $time_start !== $time_end ) {

                                    if (!empty($time_end)) {
                                       echo esc_attr( ' - ' );
                                    }
                                echo esc_html( $time_end );
                                }

                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };


                if ( $edubin_single_tp_event_seat ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo'<i class="flaticon-tickets"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Total Seat', 'edubin' ) . '</h5>';
                            echo '<span class="value">' . esc_html( absint( $event->qty ) ) . '</span>';
                        echo '</div>';
                    echo '</li>';
                };


                if ( $edubin_single_tp_event_booking ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo'<i class="flaticon-users"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Seat Booking', 'edubin' ) . '</h5>';
                            echo '<span class="value">' . esc_html( absint( $event->booked_quantity() ) ) . '</span>';
                        echo '</div>';
                    echo '</li>';
                };

                if ( isset( $extra_meta ) && is_array( $extra_meta ) ) {
                    foreach ( $extra_meta as $key => $meta ) {
                        if ( $meta['label'] ) {
             
                            echo '<li class="edubin-event-details-features-item">';
                                echo '<div class="icon-wrap">';
                                    if (  isset( $meta['icon_class'] ) && ! empty( $meta['icon_class'] ) ) {
                                        echo '<i class="' . esc_attr( $meta['icon_class'] ) . '"></i>';
                                    }else {
                                        echo '<i class="flaticon-tickets"></i>';
                                    };
                                echo '</div>';
                                echo '<div class="meta-wrap">';
                                    echo '<h5 class="label">';
                                    
                                    echo esc_html( $meta['label'] ) ? esc_html( $meta['label'] ) : '';
                                    echo '</h5>';
                                    echo esc_html( $meta['label'] ) ? '<span class="value">' . esc_html( $meta['value'] ) . '</span>' : '';
                                echo '</div>';
    
                            echo '</li>';
                        };
                    };
                };
            echo '</ul>';
            ?>
            
            <?php if ( $edubin_tp_single_event_btn ){
                $edubin_single_tp_event_booking_btn_text = $edubin_single_tp_event_booking_btn_text ? $edubin_single_tp_event_booking_btn_text :  __( 'Book Now', 'edubin' );
                $edubin_single_tp_event_booking_btn_type = $edubin_single_tp_event_booking_btn_type;

                if ( 'default' === $edubin_single_tp_event_booking_btn_type ) { ?>
                    <?php if ( $register_status ) { ?>
                        <?php if ( is_user_logged_in() ) { ?>
                            <?php
                            $registered_time = $event->booked_quantity( get_current_user_id() );
                            if ( $registered_time && wpems_get_option( 'email_register_times' ) === 'once' && $event->is_free() ) { ?>
                                <p><?php echo __( 'You have registered this event before.', 'edubin' ); ?></p>
                            <?php } else { ?>
                                <a class="event_register_submit event_auth_button event-load-booking-form edubin-btn edubin-full-btn"
                                data-event="<?php echo esc_attr( get_the_ID() ) ?>">
                                    <?php echo esc_html( $edubin_single_tp_event_booking_btn_text ); ?>
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <a href="<?php echo esc_url( wpems_login_url() ); ?>" class="edubin-btn edubin-full-btn login-redirect">
                                <?php echo esc_html( $edubin_single_tp_event_booking_btn_text ); ?>
                            </a>
                            <p class="tpc-tp-event-login-msg"><?php echo sprintf( __( 'You must <a href="%s">login</a> before register event.', 'edubin' ), wpems_login_url() ); ?></p>
                        <?php } ?>
                    <?php }else { ?>
                        <?php if ( ! $edubin_single_tp_event_countdown ) { ?>
                            <p class="tp-event-notice error"><?php echo __( 'This event has expired', 'edubin' ); ?></p>
                        <?php }; ?>
                    <?php }; ?>
                <?php }else {
                    $ep_tp_event_button_link  = get_post_meta( get_the_ID(), 'edubin_tp_event_custom_link', true ); 
                    $ep_tp_event_button_open = apply_filters( 'edubin_tp_event_button_link_open_same_tab', true );
                    if ( $ep_tp_event_button_open ) {
                        $open_tab = '_self';
                    }else {
                        $open_tab = '_blank';
                    };
                    echo '<a class="edubin-btn edubin-full-btn" href="' . esc_url( $ep_tp_event_button_link ) . '" target="' . esc_attr( $open_tab ). '">';
                        echo esc_html( $edubin_single_tp_event_booking_btn_text );
                    echo '</a>';
                };
            };


        echo '</div>';
    echo '</div>';
echo '</div>';