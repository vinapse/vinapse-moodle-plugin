<?php
// Standard GPL and phpdocs
namespace tool_demo\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

class renderer extends plugin_renderer_base {
    /**
     * Defer to template.
     *
     * @param video_page $page
     *
     * @return string html for the page
     */
    public function render_video_page($page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('mod_daddyvideo/templates/video_page', $data);
    }
}
