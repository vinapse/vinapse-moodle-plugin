<?php

/**
 * @package     mod_vinapse
 * @copyright   2021 TxC2 <info@txc2.eu>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_vinapse;

class utils
{
    // https://gist.github.com/johanmeiring/2894568
    public static function str_putcsv(array $input, string $delimiter = ',', string $enclosure = '"'): string
    {
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $input, $delimiter, $enclosure);
        rewind($fp);
        $data = rtrim(stream_get_contents($fp), "\n");
        fclose($fp);
        return $data;
    }
}
