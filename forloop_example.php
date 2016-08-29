<?php
//A thread class
class SiteProcess extends Thread
{
    private $from;
    private $upto;
    public $sum;
    public $id;
    public function __construct($id, $fraction)
    {
        $this->sum = 0;
        $this->from = $id*$fraction;
        $this->upto = ($id+1)*$fraction;
        $this->id = $id;
    }

    public function run()
    {
        for ($i=$this->from+1; $i <= $this->upto; $i++) { 
            $this->sum += $i;
        }
        
    }
}
var_dump(microtime(true));
$Threads = [];
$SUM = [];
/*
 * For Each Site, spawn a new thread, process the site and store result in Global Storage.
 */
$numberOfThreads = 1;           // experiment by varying them
$total = 10000000;
$fraction = $total/$numberOfThreads;
$remaining = $total;
$previous = 0;
for ($i=0; $i < $numberOfThreads; $i++) {
    $Threads[$i] = new SiteProcess($i, $fraction);
    $Threads[$i]->start();
    
}

//When the threads are complete, join them(destroy the threads)
for ($i=0; $i <$numberOfThreads ; $i++) { 
    $Threads[$i]->join();
}
var_dump(microtime(true));

