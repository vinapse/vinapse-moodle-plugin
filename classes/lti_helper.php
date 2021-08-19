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
    public static function daddy_request_lti_launch($uuid, $role, $userid, $courseid)
    {
        $endpoint = get_config('mod_daddyvideo', 'lti_provider_base_url');
        $requestparams = lti_build_standard_message(null, null, LTI_VERSION_1);

        $requestparams['roles'] = $role;
        $requestparams['user_id'] = $userid;
        $requestparams['context_id'] = $courseid;
        $requestparams['custom_lecture_uuid'] = $uuid;
        $requestparams['custom_plugin_version'] = get_config('mod_daddyvideo', 'version');
        $requestparams['custom_endpoint'] = $endpoint;

        $key = get_config('mod_daddyvideo', 'lti_key');
        $secret = get_config('mod_daddyvideo', 'lti_secret');

        $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $key, $secret);

        $content = lti_post_launch_html($params, $endpoint, false);

        return $content;
    }
}
