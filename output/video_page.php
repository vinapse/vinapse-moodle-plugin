<?php

namespace mod_daddyvideo\output;

use moodle_url;
use renderable;
use renderer_base;
use templatable;
use stdClass;

class video_page implements renderable, templatable
{
    private $cmid;
    private $name;

    public function __construct($cmid, $name)
    {
        $this->cmid = $cmid;
        $this->name = $name;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output)
    {
        $data = new stdClass();

        $data->name = $this->name;
        $data->cmid = $this->cmid;

        $data->launch_url = new moodle_url(
            '/mod/daddyvideo/lti_launch.php',
            array(
                'cmid' => $this->cmid
            )
        );

        return $data;
    }
}
