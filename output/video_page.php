<?php

namespace mod_daddyvideo\output;

use moodle_url;
use renderable;
use renderer_base;
use templatable;
use stdClass;

class video_page implements renderable, templatable
{

    private $uuid;
    private $department;
    private $year;

    public function __construct($uuid, $year, $department)
    {
        $this->uuid = $uuid;
        $this->year = $year;
        $this->department = $department;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output)
    {
        $data = new stdClass();

        $data->uuid = $this->uuid;

        $data->launch_url = new moodle_url(
            '/mod/daddyvideo/lti_launch.php',
            array(
                'uuid' => $this->uuid,
                'department' => $this->department,
                'year' => $this->year
            )
        );

        return $data;
    }
}
