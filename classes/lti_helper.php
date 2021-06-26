<?php

namespace mod_daddyvideo;

use stdClass;

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/lti/locallib.php');

class lti_helper
{
    public static function daddy_request_lti_launch($uuid, $role)
    {
        $endpoint = get_config('mod_daddyvideo', 'lti_provider_base_url');

        $requestparams = array(
            'resource_id' => $uuid,
            'role' => $role
        );

        $lti = new stdClass();
        $lti->key = get_config('mod_daddyvideo', 'lti_key');
        $lti->secret = get_config('mod_daddyvideo', 'lti_secret');

        $debug = false;

        /**
         * Signs the petition to launch the external tool using OAuth
         *
         * @param array $oldparms Parameters to be passed for signing
         * @param string $endpoint url of the external tool
         * @param string $method Method for sending the parameters (e.g. POST)
         * @param string $oauthconsumerkey
         * @param string $oauthconsumersecret
         * @return array|null
         */
        $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $lti->key, $lti->secret);

        /**
         * Posts the launch petition HTML
         *
         * @param array $newparms Signed parameters
         * @param string $endpoint URL of the external tool
         * @param bool $debug Debug (true/false)
         * @return string
         */
        $content = lti_post_launch_html($params, $endpoint, $debug);

        return $content;
    }
}
