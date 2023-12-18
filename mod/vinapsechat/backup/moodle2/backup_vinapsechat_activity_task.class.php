<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;

require_once($CFG->dirroot . '/mod/vinapsechat/backup/moodle2/backup_vinapsechat_stepslib.php');

class backup_vinapsechat_activity_task extends backup_activity_task
{
    protected function define_my_settings()
    {
    }

    protected function define_my_steps()
    {
        $this->add_step(new backup_vinapsechat_activity_structure_step('vinapsechat_structure', 'vinapsechat.xml'));
    }

    static public function encode_content_links($content)
    {
        return $content;
    }
}
