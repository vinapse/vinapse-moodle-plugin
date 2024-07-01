<?php

/**
 * @package     mod_vinapsechat
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class provider implements \core_privacy\local\metadata\null_provider
{

    public static function get_reason(): string
    {
        return 'privacy:metadata';
    }

}
