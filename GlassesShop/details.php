<?php
require_once "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as Capsule;

try {
    $capsule = new Capsule;
    $capsule->addConnection([
        "driver" => "mysql",
        "host" => __HOST__,
        "database" => __DATABASE__,
        "username" => __USERNAME__,
        "password" => __PASSWORD__,
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

} catch (\Exception $e) {
    die("ERROR: " . $e->getMessage());
}

    $itemId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $item = $capsule->table("items")->find($itemId);

    if (!$item) {
    die("Item not found");
    }
?>

<html>
    <head>
        <style>
           table {
                border-collapse: collapse;
                width: 50%;
            }

            table, th, td {
                border: 2px solid black;
            }
        </style>
    </head>
    <body>
        <h2>Details for Item ID: <?php echo $itemId; ?></h2>
        <table>
            <tr>
                <td colspan="4"><b>Type</b>: <?php echo $item->product_name; ?></td>
                <td colspan="4"><b>Price</b>: $<?php echo $item->list_price; ?></td>
            </tr>
            <tr>
                <td colspan="4"><b>Details</b>:<br> Code: <?php echo $item->PRODUCT_code; ?> <br> Item ID: <?php echo $item->id; ?> <br> Rating: <?php echo $item->Rating; ?></td>
                <td colspan="4"><img src='resources/images/<?php echo $item->Photo; ?>' alt='<?php echo $item->product_name; ?>'></td>
            </tr>
        </table>
    </body>
</html>
