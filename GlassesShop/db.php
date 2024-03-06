<?php
require_once "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;
try{
    $capsule = new Capsule;
    $capsule->addConnection([
        "driver" => "mysql",
        "host" =>__HOST__,
        "database" => __DATABASE__,
        "username" => __USERNAME__,
        "password" => __PASSWORD__
]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    
}catch(\Exception $e){
    die("ERROR: ".$e->getMessage());
    }
    
    $recordsPerPage = __RECORDS_PER_PAGE__;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $recordsPerPage;
    
    $items = $capsule->table("items")->select()->skip($offset)->take($recordsPerPage)->get();


require_once("views/glasses_table.php");
