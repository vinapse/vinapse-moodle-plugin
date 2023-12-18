<?php

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_vinapse\output;

use moodle_url;
use renderable;
use renderer_base;
use templatable;
use stdClass;

// TODO: get rid of this class, see vinapsechat
class video_page implements renderable, templatable
{

    private $cmid;

    public function __construct($cmid)
    {
        $this->cmid = $cmid;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output)
    {
        $data = new stdClass();

        $url = new moodle_url(
            '/mod/vinapse/launch_embed.php',
            [
                'cmid' => $this->cmid,
            ]
        );

        $data->launch_url = $url->out(false);

        return $data;
    }
}
