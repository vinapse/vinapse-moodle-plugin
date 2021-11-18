<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_daddyvideo;

use context_course;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/lti/locallib.php');

class lti_helper
{
    /**
     * Gets the IMS role string for the specified user and LTI course module.
     *
     * @param int $courseid The course id of the LTI activity
     *
     * @return string A role string suitable for passing with an LTI launch
     *
     * @see lti_get_ims_role
     *
     */
    public static function daddy_get_ims_roles($courseid)
    {
        $roles = [];

        $context = context_course::instance($courseid);
        if (has_capability('mod/daddyvideo:addinstance', $context)) {
            $roles[] = 'Instructor';
        } else {
            $roles[] = 'Learner';
        }

        if (is_siteadmin()) {
            // Make sure admins do not have the Learner role, then add administrator role
            $roles = array_diff($roles, array('Learner'));
            $roles[] = 'urn:lti:sysrole:ims/lis/Administrator';
        }

        return join(',', $roles);
    }

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
            'custom_type' => 'lecture',
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
            'custom_type' => 'generic',
            'user_id' => $userid,
            'custom_destination_path' => $destinationpath
        ];

        return self::generate_launch_form($params);
    }

    private static function generate_launch_form($params): string
    {
        $endpoint = get_config('mod_daddyvideo', 'lti_provider_base_url');
        if (empty($endpoint)) {
            return get_string('error_not_configured', 'daddyvideo');
        }

        // Build standard LTI parameters
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
