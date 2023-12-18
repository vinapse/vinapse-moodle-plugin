<?php

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_vinapse;

use context_course;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/lti/locallib.php');

class lti_helper
{
    /**
     * Gets the IMS role string for the specified user and LTI course module.
     *
     * @param int|null $courseid The course id of the LTI activity
     *
     * @return string A role string suitable for passing with an LTI launch
     *
     * @throws \coding_exception
     */
    public static function get_ims_roles(int $courseid = null): string
    {
        // Loosely based on @see lti_get_ims_role
        // https://github.com/moodle/moodle/blob/MOODLE_311_STABLE/mod/lti/locallib.php#L2144
        $roles = [];

        $is_context_admin = false;

        // If we're in a course context, push roles based on capabilities in the course
        if (!empty($courseid)) {
            $context = context_course::instance($courseid);
            if (has_capability('mod/vinapse:addinstance', $context)) {
                $roles[] = 'Instructor';
            } else if (isguestuser()) {
                $roles[] = 'Learner/GuestLearner';
            } else {
                $roles[] = 'Learner';
            }
            $is_context_admin = has_capability('mod/lti:admin', $context);
        }

        // Always add admin roles if the user is an admin
        $is_role_switched = !empty($courseid) && is_role_switched($courseid);
        if (!$is_role_switched && (is_siteadmin() || $is_context_admin)) {
            $roles[] = 'urn:lti:sysrole:ims/lis/Administrator';
            $roles[] = 'urn:lti:instrole:ims/lis/Administrator';
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
            'roles' => self::get_ims_roles($courseid),
            'context_id' => $courseid,
            'context_label' => $courseshortname,
            'context_title' => $coursefullname,
            'custom_lecture_uuid' => $uuid,
            'resource_link_title' => $title,
            'resource_link_description' => $description
        ];

        return self::generate_launch_form($params);
    }

    public static function request_lti_launch_generic(string $destinationpath): string
    {
        $params = [
            'lti_message_type' => 'Login',
            'roles' => self::get_ims_roles(),
            'custom_destination_path' => $destinationpath
        ];

        return self::generate_launch_form($params);
    }

    private static function generate_launch_form($params): string
    {
        global $USER;

        $endpoint = get_config('mod_vinapse', 'lti_provider_base_url');
        if (empty($endpoint)) {
            return get_string('error_not_configured', 'vinapse');
        }

        // Build standard LTI parameters
        $requestparams = lti_build_standard_message(null, null, LTI_VERSION_1);

        // Add common parameters
        $params['ext_moodle_plugin_version'] = get_config('mod_vinapse', 'version');
        $params['user_id'] = $USER->id;
        $params['custom_courses'] = self::get_courses();

        // Add request-specific parameters
        $requestparams = array_merge($requestparams, $params);

        $key = get_config('mod_vinapse', 'lti_key');
        $secret = get_config('mod_vinapse', 'lti_secret');

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
