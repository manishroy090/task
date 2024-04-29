<?php

namespace  App\Services;

use League\Csv\Writer;
use League\Csv\Reader;
use SplFileObject;

class CsvService
{

    public function saveDataToCsv(array $data, string $filename)
    {
        $csv = Writer::createFromPath(storage_path('app/public/' . $filename), 'a+');
        if ($this->isEmptyFile($filename)) {
            $csv->insertOne(array_keys($data));
        }

        $csv->insertOne($data);
    }

    public function fetchDataFromCsv(string $filename)
    {
        $reader = Reader::createFromPath(storage_path('app/public/' . $filename));
        // Check if the header row exists and is not empty
         
        if (!$this->isEmptyFile($filename)) {
            // Handle the case when the header row is empty
            // For example, you can set the header offset to null to ignore the header row
            $reader->setHeaderOffset(0);
           $data = iterator_to_array($reader->getRecords());
        }else{

            $data = [];
        }

        return $data;
    }


    public function readSignleRowOfCSV(string $filename, int $rowNumber)
    {
        $csvFilePath = storage_path('app/public/' . $filename);
        $reader = Reader::createFromPath($csvFilePath);
        $reader->setHeaderOffset(0);
        $records = iterator_to_array($reader->getRecords());
        return $records[$rowNumber] ?? [];
    }

    private function isEmptyFile(string $filename): bool
    {
        return filesize(storage_path('app/public/' . $filename)) === 0;
    }
}
