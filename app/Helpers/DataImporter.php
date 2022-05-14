<?php

namespace App\Helpers;

class DataImporter
{
    /**
     * Import csv file, process and return data as array.
     * 
     * @param string $file File path.
     * @param string $delimiter Delimiter.
     * @return array
     */
    public static function importCSV($file, $delimiter = ',')
    {
        if (!file_exists($file) || !is_readable($file)) {
            return false;
        }

        $header = null;
        $data = array();

        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } elseif ($row[0] !== null) {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}
