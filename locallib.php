<?php

defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

global $CFG; // should be defined in config.php

require_once($CFG->dirroot.'/mod/lti/locallib.php');

function local_daddy_request_lti_launch($uuid, $department, $year) {

    if ($uuid===NULL) {
        $endpoint = "https://dev-lti.txc2.eu/edit";
    } else {
        $endpoint = "https://dev-lti.txc2.eu/view";
    }
    $requestparams = array(
        'resource_id' => $uuid,
        'department' => $department,
        'year' => $year,

    );

    $lti = new stdClass();
    $lti->resourcekey = "unitn";
    $lti->password = "secret1";

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
    $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $lti->resourcekey, $lti->password);

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
