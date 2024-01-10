<?php

namespace App\Helpers;

class Csv
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public static function from($file)
    {
        return new static($file);
    }

    public function columns()
    {
        return $this->openFile(function ($h) {
            $a = array_filter(fgetcsv($h, 1000, ","));
            return $a;
        });
    }

    public function eachRow($callback)
    {
        $this->openFile(function ($handle) use ($callback) {
            $columns = array_filter(fgetcsv($handle, 1000, ','));

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $row = [];
                for ($i = 0; $i < count($data); $i++) {
                    if (!isset($columns[$i])) continue;

                    $row[$columns[$i]] = $data[$i];
                }
                $callback($row);
            }
        });
    }

    public function openFile($callback)
    {
        // $handle = fopen("C:\laragon\www\crmmechanic\storage\app\livewire-tmp/qkNrvSxAeUaMUMEA0M9a7ntmbhGGG1-metacHJvZHVjdG9zX2Nzdi5jc3Y=-.csv", "r");
        $handle = fopen($this->file->getRealPath(), "r");
        return $callback($handle);

        fclose($handle);
    }
}
