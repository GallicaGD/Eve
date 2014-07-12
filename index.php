<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require_once('eve.php');
    
    $item_name = '';
    $parts = array();
    $item_price = 0.00;
    
    if ( $_GET ) {
        $itemCheck = $eve->findItem($_GET['term']);
        return json_encode($itemCheck);
    }

    if ( $_POST ) {
        $eve = new EveStaticData();
    
        $item_name = $eve->getItemName($_POST['item_name']);
        $parts = $eve->getMaterials($_POST['item_name']);
    }
    
    
?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" type="text/css" />
        <script type="text/javascript">
            $(function (){
                $('input[name=item_name]').autocomplete({
                        source: 'index.php',
                        select: function (event, ui) {
                            $('input[name=item_id]').val(ui.item.value);
                            $('input[name=item_name]').val(ui.item.label);
                        }
                    });
                
            });
        </script>
    </head>
    <body>
        <form id="search" action="index.php" method="post">
            <label>Item</label><input type="text" name="item_name" />
            <input type="hidden" name="item_id" value="" />
            <input type="submit" value="Get" />
            <div>
                <h3><?php echo $item_name ?></h3>
                <ul>
                    <li>
                        <label>Price Per Unit:</label>
                        <span><?php echo $item_price; ?></span>
                </ul>
                <table>
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th>Quantity</th>
                            <th>Price per Unit</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parts as $part) { ?>

                            <tr>
                                <td><?php echo $part['typeName']; ?></td>
                                <td><?php echo $part['quantity']; ?></td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </body>
</html>