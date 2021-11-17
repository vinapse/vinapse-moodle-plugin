<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_daddyvideo;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/lti/locallib.php');

class lti_helper
{
    public static function daddy_request_lti_launch_lecture(string $uuid,
                                                            string $role,
                                                            int    $userid,
                                                            int    $courseid,
                                                            string $courseshortname,
                                                            string $coursefullname,
                                                            string $title,
                                                            string $description)
    {
        $params = [
            'type' => 'lecture',
            'roles' => $role,
            'user_id' => $userid,
            'context_id' => $courseid,
            'context_label' => $courseshortname,
            'context_title' => $coursefullname,
            'custom_lecture_uuid' => $uuid,
            'custom_lecture_title' => $title,
            'custom_lecture_description' => $description
        ];

        return self::generate_launch_form($params);
    }

    public static function daddy_request_lti_launch_generic(int $userid, string $destinationpath)
    {
        $params = [
            'type' => 'generic',
            'user_id' => $userid,
            'destination_path' => $destinationpath
        ];

        return self::generate_launch_form($params);
    }

    private static function generate_launch_form($params): string
    {
        $endpoint = get_config('mod_daddyvideo', 'lti_provider_base_url');
        if (empty($endpoint)) {
            return get_string('error_not_configured', 'daddyvideo');
        }

        # Build standard LTI parameters
        $requestparams = lti_build_standard_message(null, null, LTI_VERSION_1);

        // Add request-specific parameters
        $params['custom_endpoint'] = $endpoint;
        $params['custom_plugin_version'] = get_config('mod_daddyvideo', 'version');
        $requestparams = array_merge($requestparams, $params);

        $key = get_config('mod_daddyvideo', 'lti_key');
        $secret = get_config('mod_daddyvideo', 'lti_secret');

        // Sign parameters and generate launch form
        $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $key, $secret);
        $content = lti_post_launch_html($params, $endpoint, false);

        return $content;
    }
}
