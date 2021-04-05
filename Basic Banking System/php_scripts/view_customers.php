<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
     <title>Banking System | Customers</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/cust_view.css">
    <?php
        include './navigation_pane.php';
    ?>
    
  </head>
  <body>
    <div class="table_disp">
      <h1>View Customers</h1>
      <table class="center">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>A/C Number</th>
          <th>Email</th>
          <th>Balance (Rs.)</th>
          <th>Created At</th>
        </tr>
    <?php
      include_once './connection.php';

        $sql = "SELECT * from customers";

        $query = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
          echo "<tr><td>" . $row["c_id"]. "</td><td>" . $row["c_name"]. "</td><td>" . $row["c_acctno"]."</td><td>". $row["c_mail"]. "</td><td><span>" . $row["c_balance"]. "</span></td><td>" . $row["created_at"] ."</td></tr>";
              }
              echo "</table>";
      ?>

     </div>

        <?php

          mysqli_close($conn);
        ?>
    </div>
    <footer>
      <hr><p><b>2021 © Made by Orvell Ferreira | All Rights Reserved | The Sparks Foundation</b></p>
    </footer>
  </body>
</html>
