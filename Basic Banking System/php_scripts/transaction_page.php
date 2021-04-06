<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
     <title>Banking System | Transactions Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/transaction_page.css">
    <?php
        include './navigation_pane.php';
    ?>
    
  </head>
  <body>
    <h1>Money Transfer</h1>
   <div class="">
       <?php
       include './connection.php';
       if (isset($_REQUEST['c_id'])) {
           $sid = $_GET['c_id'];
           $sql = "SELECT * FROM  customers where c_id=$sid";
           $result = mysqli_query($conn, $sql);
           if (!$result) {
               echo "Error : " . $sql . "<br>" . mysqli_error($conn);
           }
           $rows = mysqli_fetch_assoc($result);
       }
       ?>
       <form method="post" name="debit_credit" >

           <div class="display-info">
             <p>Name: <?php echo (isset($rows['c_name']) ? $rows['c_name'] : ''); ?>
               <span>Id: <?php echo (isset($rows['c_id']) ? $rows['c_id'] : ''); ?></span>
             </p>
             <p>Account number: <?php echo (isset($rows['c_acctno']) ? $rows['c_acctno'] : ''); ?>
               <span>Email: <?php echo (isset($rows['c_mail']) ? $rows['c_mail'] : ''); ?></span>
             </p>
             <h3>Balance: Rs. <?php echo (isset($rows['c_balance']) ? $rows['c_balance'] : ''); ?> /-</h3>

           </div>

           <div class="transfer">
               <br><br><br>
               <label for="to" class="selection">Transfer To:</label>
               <select id="to" name="to"  required>
                   <option value="" disabled selected >Choose</option>
                   <?php
                   include 'config.php';
                   $sid = $_REQUEST['c_id'];
                   $sql = "SELECT * FROM customers where c_id!=$sid";
                   $result = mysqli_query($conn, $sql);
                   if (!$result) {
                       echo "Error " . $sql . "<br>" . mysqli_error($conn);
                   }
                   while ($rows = mysqli_fetch_assoc($result)) {
                   ?>
                       <option  value="<?php echo $rows['c_id']; ?>">

                           <?php echo $rows['c_name']; ?>
                           (A/C:<?php echo $rows['c_acctno']; ?>)

                       </option>
                   <?php
                   }
                   ?>
           </div>
           </select>
           <label for="amount" class="selection-amount">Amount:</label>
           <input type="number"  name="amount" id="amount" required>
           <div class="but">
               <button class="submit" name="submit" type="submit" id="myBtn">Transfer</button>
               <button class="cancel" name="Cancel" type="submit" onclick="location.href='./transfer_money.php'">Cancel</button>
           </div>
           <br>
       </form>
   </div>
   </div>
   <footer>
     <hr><p><b>2021 © Made by Orvell Ferreira | All Rights Reserved | The Sparks Foundation</b></p>
   </footer>
</body>

</html>
<?php
include './connection.php';

if (isset($_POST['submit'])) {

    $from = $_GET['c_id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where c_id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array from which the amount is to be transferred.

    // check input of negative value by user
    if (($amount) < 0) {
        echo '<script>';
        echo ' alert("You have entered Negative value. Please Enter correct amount. Try Again!")';  // showing an alert box.
        echo '</script>';
    }

    // check insufficient balance.
    else if ($amount > $sql1['c_balance']) {
        echo '<script>';
        echo ' alert("Insufficient Balance. Try Again!")';  // showing an alert box.
        echo '</script>';

    }

    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script>";
        echo "alert('Zero value cannot be transferred. Try Again!')";
        echo "</script>";
    } else {
        $sql = "SELECT * from customers where c_id=$to";
        $query = mysqli_query($conn, $sql);
        $sql2 = mysqli_fetch_array($query);

        $sender = $sql1['c_name'];
        $sender_acct = $sql1['c_acctno'];
        $receiver = $sql2['c_name'];
        $receiver_acct = $sql2['c_acctno'];
        // deducting amount from sender's account
        $newbalance = $sql1['c_balance'] - $amount;
        $sql = "UPDATE customers set c_balance=$newbalance where c_id=$from";
        mysqli_query($conn, $sql);

        // adding amount to reciever's account
        $newbalance = $sql2['c_balance'] + $amount;
        $sql = "UPDATE customers set c_balance=$newbalance where c_id=$to";
        mysqli_query($conn, $sql);

        $transaction_id=(rand(10000000000000000,99999999999999999));
        $sql = "INSERT INTO transactions(s_name,s_acct, r_name,r_acct, amount,transaction_id) VALUES ('$sender','$sender_acct','$receiver','$receiver_acct','$amount','$transaction_id')";
        $query = mysqli_query($conn, $sql);


        if ($query) {

            echo "<script> alert('Transaction Successful. Transaction Id: #$transaction_id');
                      window.location='./transactions.php';
                  </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>
