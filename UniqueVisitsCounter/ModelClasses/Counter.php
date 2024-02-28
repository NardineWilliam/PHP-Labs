<?php
class Counter{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function increment()
    {
        $count = $this->getCount();
        $count++;
        file_put_contents($this->fileName, $count);
    }

    public function getCount()
    {
        if (file_exists($this->fileName)) {
            return (int)file_get_contents($this->fileName);
        } else {
            return 0;
        }
    }
}