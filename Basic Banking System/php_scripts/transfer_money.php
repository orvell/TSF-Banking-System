<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
     <title>Banking System | Transfer Money</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/transfer_money.css">
    <?php
        include './navigation_pane.php';
    ?>
    
  </head>
  <body>
    <h1>Tranfer Money</h1>
    <?php
    include './connection.php';
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn, $sql);
    ?>
    <table class="center">
      <thead>
            <tr>
                <th scope="col" >Id</th>
                <th scope="col" >Name</th>
                <th scope="col" >Account Number</th>
                <th scope="col" >Email</th>
                <th scope="col" >Balance (Rs.)</th>
                <th scope="col" >Transaction</th>
            </tr>
      </thead>
      <tbody>
          <?php
              if (isset($result)) {
                    while ($rows = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
                <td><?php echo (isset($rows['c_id']) ? $rows['c_id'] : ''); ?></td>
                <td ><?php echo (isset($rows['c_name']) ? $rows['c_name'] : ''); ?></td>
                <td><?php echo (isset($rows['c_acctno']) ? $rows['c_acctno'] : ''); ?></td>
                <td ><?php echo (isset($rows['c_mail']) ? $rows['c_mail'] : ''); ?></td>
                <td style="text-align:right;font-weight:bold;"><?php echo (isset($rows['c_balance']) ? $rows['c_balance'] : ''); ?></td>
                <td ><a href="./transaction_page.php?c_id=<?php echo $rows['c_id']; ?>"> <button type="button">Transfer</button></a></td>
                </tr>
              <?php
                      }
                    }
                ?>

          </tbody>
      </table>
      <footer>
        <hr><p><b>2021 © Made by Orvell Ferreira | All Rights Reserved | The Sparks Foundation</b></p>
      </footer>
  </body>
</html>
