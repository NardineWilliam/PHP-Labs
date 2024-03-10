<?php

namespace App;
require_once "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;


class Webservice{
    protected $items;
    protected $capsule;

    public function __construct() {
        try {
            $this->capsule = new Capsule;
            $this->capsule->addConnection([
                "driver" => "mysql",
                "host" => __HOST__,
                "database" => __DATABASE__,
                "username" => __USERNAME__,
                "password" => __PASSWORD__,
            ]);
            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();
        
        } catch (\Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

/**
     * @api {get} /glasses list all glasses
     * @apiName ListGlasses
     * @apiGroup Glass
     * @apiVersion 1.0.0
     * @apiSuccessExample Success-Response:
     * HTTP:/1.1 200 OK
     * {
     *    "data" : [
     *              {
     *                  "id": "100",
     *                  "product_code": "NWTCFV-100",
     *                  "product_name": "new_glass very new1 ",
     *                  "photo": "09.png",
     *                  "list_price": "14.00",
     *                  "reorder_level": "10",
     *                  "units_in_stock": "4",
     *                  "category": "sunglasses",
     *                  "country": "USA", 
     *                  "rating": "4.60",
     *                  "discontinued": "1",
     *                  "date": "2018-08-28 22:53:14"
     *               }
     *           ]
     * }
     */

     public function getGlasses() {
        $items = $this->capsule->table("items")->select()->get();
        return ["data" => $items];    }
    
    public function getSingleGlass($id) {
        $item = $this->capsule->table("items")->find($id);

        if ($item) {
            return ["data" => $item];
        }

        return null;
    }
    
      /**
     * Create a new glass record
     *
     * @param array $data
     * @return bool
     */
    public function createGlass($data)
    {
        try {
            $allowedColumns = [
                'product_code',
                'product_name',
                'photo',
                'list_price',
                'reorder_level',
                'units_in_stock',
                'category',
                'country',
                'rating',
                'discontinued',
                'date',
            ];

            $filteredData = array_intersect_key($data, array_flip($allowedColumns));
            $this->capsule->table("items")->insert($filteredData);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}