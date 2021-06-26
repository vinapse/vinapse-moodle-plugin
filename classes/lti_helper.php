<?php

namespace mod_daddyvideo;

use stdClass;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/lti/locallib.php');

class lti_helper
{
    public static function daddy_request_lti_launch($uuid, $role, $userid, $courseid)
    {
        $endpoint = get_config('mod_daddyvideo', 'lti_provider_base_url');

        $requestparams = array(
            'custom_resource_id' => $uuid,
            'roles' => $role,
            'user_id' => $userid,
            'context_id' => $courseid
        );

        $lti = new stdClass();
        $lti->key = get_config('mod_daddyvideo', 'lti_key');
        $lti->secret = get_config('mod_daddyvideo', 'lti_secret');

        $debug = false;

        $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $lti->key, $lti->secret);

        $content = lti_post_launch_html($params, $endpoint, $debug);

        return $content;
    }
}
