<?php

   $sensei_custom_feature_group = get_post_meta(get_the_ID(), 'sensei_custom_feature_group', true);
    if ($sensei_custom_feature_group) {
        foreach ((array) $sensei_custom_feature_group as $key => $entry) {
            echo '<li>';
            if (isset($entry['sensei_custom_feature_group_icon'])) {
                $if_has_dashicons = (strpos($entry['sensei_custom_feature_group_icon'], 'dashicons') !== false) ? 'dashicons' : '';
                $if_has_fontwsome = (strpos($entry['sensei_custom_feature_group_icon'], 'fa-') !== false) ? 'fa' : '';
                echo '<i class="' . esc_attr($if_has_fontwsome . ' ' . $if_has_dashicons . ' ' . $entry['sensei_custom_feature_group_icon']) . '"></i>';
            } else {
                echo '<i class="flaticon-play-button"></i>';
            }
            if (isset($entry['sensei_custom_feature_group_label'])) {
                echo '<span class="label">' . esc_html($entry['sensei_custom_feature_group_label']) . ':</span>';
            }
            if (isset($entry['sensei_custom_feature_group_value'])) {
                echo '<span class="value">' . esc_html($entry['sensei_custom_feature_group_value']) . '</span>';
            }
            echo '</li>';
        }
    }