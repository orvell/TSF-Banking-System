<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
     <title>Banking System | Transactions</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/transactions.css">
    <?php
        include './navigation_pane.php';
    ?>
    <title>Transactions</title>
  </head>
  <body>
    <h1>Transaction History</h1>
    <?php
    include './connection.php';
    $sql = "SELECT * FROM transactions";
    $result = mysqli_query($conn, $sql);
    ?>
    <table class="center">
      <thead>
            <tr>
                <th scope="col" >Id</th>
                <th scope="col" >Sender Name</th>
                <th scope="col" >Sender Account Number</th>
                <th scope="col" >Reciever Name</th>
                <th scope="col" >Reciever Account Number</th>
                <th scope="col" >Amount(Rs.)</th>
                <th scope="col" >Transaction Id</th>
                <th scope="col" >Created At</th>
            </tr>
      </thead>
      <tbody>
          <?php
              if (isset($result)) {
                    while ($rows = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
                <td><?php echo (isset($rows['id']) ? $rows['id'] : ''); ?></td>
                <td ><?php echo (isset($rows['s_name']) ? $rows['s_name'] : ''); ?></td>
                <td><?php echo (isset($rows['s_acct']) ? $rows['s_acct'] : ''); ?></td>
                <td ><?php echo (isset($rows['r_name']) ? $rows['r_name'] : ''); ?></td>
                <td><?php echo (isset($rows['r_acct']) ? $rows['r_acct'] : ''); ?></td>
                <td style="text-align:right;font-weight:bold;"><?php echo (isset($rows['amount']) ? $rows['amount'] : ''); ?></td>
                <td ><?php echo (isset($rows['transaction_id']) ? $rows['transaction_id'] : ''); ?></td>
                <td ><?php echo (isset($rows['created_at']) ? $rows['created_at'] : ''); ?></td>
                </tr>
              <?php
                      }
                    }
                ?>

          </tbody>
      </table>
    </div>
    <footer>
      <hr><p><b>2021 © Made by Orvell Ferreira | All Rights Reserved | The Sparks Foundation</b></p>
    </footer>

  </body>
</html>
