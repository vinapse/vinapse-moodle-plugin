<?php

/**
 * @package     mod_daddyvideo
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_daddyvideo\output;

use moodle_url;
use renderable;
use renderer_base;
use templatable;
use stdClass;

class video_page implements renderable, templatable
{
    private $courseid;
    private $lectureuuid;

    public function __construct($courseid, $lectureuuid)
    {
        $this->courseid = $courseid;
        $this->lectureuuid = $lectureuuid;
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
            '/mod/daddyvideo/launch_embed.php',
            [
                'courseId' => $this->courseid,
                'lectureUUID' => $this->lectureuuid
            ]
        );

        $data->launch_url = $url->out(false);

        return $data;
    }
}
