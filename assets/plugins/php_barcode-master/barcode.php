<html>

<head>
    <style>
    p.inline {
        display: inline-block;
    }

    span {
        font-size: 13px;
    }
    </style>
    <style type="text/css" media="print">
    @page {
        size: auto;
        /* auto is the initial value */
        margin: 0mm;
        /* this affects the margin in the printer settings */

    }
    </style>
</head>

<body onload="window.print();">
    <div style="margin: 15px;">
        <?php
        include 'barcode128.php';
        // $product = $_POST['product'];
        // $product_id = $_POST['product_id'];
        // $rate = $_POST['rate'];

        // for ($i=1;$i<=$_POST['print_qty'];$i++) {
        //     echo "<p class='inline'><span ><b>Item: $product</b></span>".bar128(stripcslashes($_POST['product_id']));
        // }

        for ($i=1;$i < 20;$i++) {
            $barcode = microtime(true) *10000 . $i;

            echo "<p class='inline'>".bar128(stripcslashes($barcode));
        }


        ?>
    </div>
</body>

</html>