<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_daddyvideo;

use context_course;
use core_user;

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
    public static function get_ims_roles(int $courseid): string
    {
        $roles = [];

        $context = context_course::instance($courseid);
        if (has_capability('mod/daddyvideo:addinstance', $context)) {
            $roles[] = 'Instructor';
        } else if (isguestuser()) {
            $roles[] = 'Learner/GuestLearner';
        } else {
            $roles[] = 'Learner';
        }

        if (is_siteadmin()) {
            $roles[] = 'Administrator';
        }

        return join(',', $roles);
    }

    public static function request_lti_launch_lecture(string $uuid,
                                                      int    $courseid,
                                                      string $courseshortname,
                                                      string $coursefullname,
                                                      string $title,
                                                      string $description): string
    {
        $params = [
            'custom_type' => 'lecture',
            'roles' => self::get_ims_roles($courseid),
            'context_id' => $courseid,
            'context_label' => $courseshortname,
            'context_title' => $coursefullname,
            'custom_lecture_uuid' => $uuid,
            'custom_lecture_title' => $title,
            'custom_lecture_description' => $description
        ];

        return self::generate_launch_form($params);
    }

    public static function request_lti_launch_generic(string $destinationpath): string
    {
        $params = [
            'custom_type' => 'generic',
            'custom_destination_path' => $destinationpath
        ];

        return self::generate_launch_form($params);
    }

    private static function generate_launch_form($params): string
    {
        global $USER;
        /** @var core_user $USER */

        $endpoint = get_config('mod_daddyvideo', 'lti_provider_base_url');
        if (empty($endpoint)) {
            return get_string('error_not_configured', 'daddyvideo');
        }

        // Build standard LTI parameters
        $requestparams = lti_build_standard_message(null, null, LTI_VERSION_1);

        // Add common parameters
        $params['custom_endpoint'] = $endpoint;
        $params['custom_plugin_version'] = get_config('mod_daddyvideo', 'version');
        $params['user_id'] = $USER->id;
        $params['custom_courses'] = self::get_courses();

        // Add request-specific parameters
        $requestparams = array_merge($requestparams, $params);

        $key = get_config('mod_daddyvideo', 'lti_key');
        $secret = get_config('mod_daddyvideo', 'lti_secret');

        // Sign parameters and generate launch form
        $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $key, $secret);
        $content = lti_post_launch_html($params, $endpoint, false);

        return $content;
    }

    private static function get_courses(): string
    {
        global $USER, $SITE;
        $courses = enrol_get_users_courses($USER->id, true);

        $items = [];
        $items[] = count($courses);

        foreach ($courses as $course) {
            if ($course->id == $SITE->id) {
                // Skip front page
                continue;
            }

            $items[] = $course->id;
            $items[] = $course->shortname;
            $items[] = $course->fullname;
            $items[] = self::get_ims_roles($course->id);
        }

        return utils::str_putcsv($items);
    }
}
