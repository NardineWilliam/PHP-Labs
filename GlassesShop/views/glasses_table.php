<?php

    if (isset($_GET['search']) && !empty($_GET['search'])) {
         $items = Item::search('product_name', $_GET['search']);
    } elseif (isset($_GET['show_all'])) {
        $items = Item::getAllItems();
    } else {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * __RECORDS_PER_PAGE__;
        $items = $capsule->table("items")->skip($offset)->take(__RECORDS_PER_PAGE__)->get();
    }
?>

<html>
    <body>
        <form action="" method="GET">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search">
            <button type="submit">Search</button>
            <a href="?show_all">Show All</a>
        </form>
        <table>
            <tr>
                <td><b>Item ID</b></td>
                <td><b>Name</b></td>
                <td><b>Details</b></td>
            </tr>
            <?php
                foreach ($items as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->id . "</td>";
                    echo "<td>" . $item->product_name . "</td>";
                    echo "<td><a href='details.php?id=" . $item->id . "'>More</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <?php
            if (!isset($_GET['search'])) {
                $prevPage = max(1, $currentPage - 1);
                $nextPage = $currentPage + 1;

                if ($currentPage > 1) {
                    echo "<a href='?page=$prevPage'>Previous</a>";
                    echo " | ";
                }

                if (count($items) == __RECORDS_PER_PAGE__) {
                    echo "<a href='?page=$nextPage'>Next</a>";
                }
            }
        ?>
    </body>
</html>

