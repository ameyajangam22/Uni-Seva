<?php 
   include './config.php';
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM ORDERS ORDER BY ORDER_ID;";

    $result = $conn->query($sql);
    
    
    if(isset($_POST['received']))
    {
            $sql= $conn -> prepare("UPDATE ORDERS SET STATUS='Order Received' WHERE ORDER_ID= ?;");
            //echo $sql."     ".$_POST['email'];
            $sql->bind_param("s",$ema);
            $ema=$_POST['oid'];
            $sql->execute();

            
            echo "Request Completed"; 
    }

    if(isset($_POST['received1']))
    {
            $sql= $conn -> prepare("UPDATE ORDERS SET FOOD_STATUS='Food is Ready' WHERE ORDER_ID= ?;");
            //echo $sql."     ".$_POST['email'];
            $sql->bind_param("s",$ema);
            $ema=$_POST['oid'];
            $sql->execute();

            
            echo "Request Completed"; 
    }

    if(isset($_POST['received2']))
    {
        if($_POST['Paid']<=$_POST['pb'])
        {
            $sql= $conn -> prepare("UPDATE ORDERS SET PAYMENT_BALANCE=PAYMENT_BALANCE-". $_POST['Paid']." WHERE ORDER_ID= ?;");
            //echo $sql."     ".$_POST['email'];
            $sql->bind_param("s",$ema);
            $ema=$_POST['oid'];
            $sql->execute();

            
            
            echo "Request Completed"; 
        }
        else
        {
            echo "Invalid Payment";
        }
            
    }
    mysqli_close($conn);
    //echo "<td>".$row["FOOD_STATUS"]."</td>";
    // if($row["FOOD_STATUS"]!="Food is Ready")
    //                     {
    //                         echo "<td><form action= 'canteen.php' method='POST'>  <input type='submit'  name='received1' value='Food is Ready'>   <input type='hidden' name='oid' value='".$row["ORDER_ID"]."'>   </form></td>";
    //                     }
    //                     else
    //                     {
    //                         echo "<td> </td>";
    //                     }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen</title>
<link rel="stylesheet" href="canteen.css">
</head>
<body>
    
    <div class="blomck">
        <h2 class="timtle"><u>Pending Orders</u></h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>EMAIL ID</th>
                <th>Dish Name</th>
                <th>Quantity</th>
                <th>Timestamp</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Payment Balance</th>
                <th>Order Received</th>
                <th>Order Ready</th>
                <th>Payment Received</th>
            </tr>
            <?php
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>";
                        echo "<td>".$row["ORDER_ID"]."</td>";
                        echo "<td>".$row["EMAIL"]."</td>";
                        echo "<td>".$row["DISH_NAME"]."</td>";
                        echo "<td>".$row["QUANTITY"]."</td>";
                        echo "<td>".$row["TIMESTAMP"]."</td>";
                        echo "<td>".$row["STATUS"]."</td>";
                        
                        echo "<td>".$row["PAYMENT_BALANCE"]."</td>"; 
                        if($row["STATUS"]!="Order Received")
                        {
                            echo "<td><form action= 'canteen.php' method='POST'>  <input type='submit'  name='received' value='Order Received'>   <input type='hidden' name='oid' value='".$row["ORDER_ID"]."'>   </form></td>";
                        }
                        else
                        {
                            echo "<td> </td>";
                        }
                        
                        if($row["PAYMENT_BALANCE"]!=0)
                        {
                            echo "<td><form action= 'canteen.php' method='POST'>  <input type='number' name='Paid' value=''> <input type='submit'  name='received2' value='Payment Received'><input type='hidden' name='oid' value='".$row["ORDER_ID"]."'>  <input type='hidden' name='pb' value='".$row["PAYMENT_BALANCE"]."'> </form></td>";
                        }
                        else
                        {
                            echo "<td> </td>";
                        }
                        echo "</tr>";
                    }
                } 
            ?>
        </table>
    </div>
</body>
</html>