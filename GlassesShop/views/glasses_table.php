<html>
<body>
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
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $prevPage = max(1, $currentPage - 1);
        $nextPage = $currentPage + 1;

        if ($currentPage > 1) {
            echo "<a href='?page=$prevPage'>Previous</a>";
            echo " | ";
        }

        if (count($items) == __RECORDS_PER_PAGE__) {
            echo "<a href='?page=$nextPage'>Next</a>";
        }
    ?>
</body>
</html>




