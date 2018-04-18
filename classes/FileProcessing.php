<?php

class FileProcessing
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    protected function openFile()
    {
        if ($this->checkIfFileExists($this->file)) {
            // return file for read
            return fopen($this->file, 'r');

        } else {
            throw new \InvalidArgumentException('Cannot locate file: '. $this->file);
        }
    }

    protected function checkIfFileExists($file)
    {
        return file_exists($file);
    }

    public function parseFile()
    {
        $handler = $this->openFile();

        while($line = fgetcsv($handler,null,'|')) {
            $guest = new Guest();

            $guest->nm_firstname = $line[0];
            $guest->nm_surname = $line[1];
            $guest->tx_alt_names = $line[2];
            $guest->id_guest_type = $line[3] == 'day-guest' ? 1 : 2;
            var_dump($guest);
            $guest->save();
        }

        return true;
    }
}