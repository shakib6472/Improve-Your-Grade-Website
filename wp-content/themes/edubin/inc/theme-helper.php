<?php

if (!class_exists('Edubin_Theme_Helper')) {
    /**
     * Edubin Theme Helper
     *
     */
    class Edubin_Theme_Helper
    {
        private static $instance;

        public static function get_instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * @link https://github.com/opensolutions/smarty/blob/master/plugins/modifier.truncate.php
         */
        public static function modifier_character(
            $string,
            $length = 80,
            $etc = '... ',
            $break_words = false
        ) {
            if (0 == $length) {
                return '';
            }

            if (mb_strlen($string, 'utf8') > $length) {
                if (!$break_words) {
                    $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
                }

                return mb_substr($string, 0, $length, 'utf8') . $etc;
            } else {
                return $string;
            }
        }

        public static function render_html($args)
        {
            return $args ?? '';
        }

    }

    new Edubin_Theme_Helper();
}
