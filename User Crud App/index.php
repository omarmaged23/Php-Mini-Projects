<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <title>My Shop</title>
</head>

<body>
  <div class="container my-5">
    <h2>List of Clients</h2>
    <a class="btn btn-primary" href="create.php" role="button">New Client</a>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php
      $hostname = "localhost";
      $username = "root";
      $pass = "root";
      $database = "my_db";
      try {
        // Create Connection
        $conn = new PDO("mysql:hostname=$hostname;dbname=$database", $username, $pass);
        // Write your queries
        $sql = "select * from clients";
        $result = $conn->query($sql);
        // Read and Use your queries
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          echo "
            <tbody>
            <tr>
              <td>$row[id]</td>
              <td>$row[name]</td>
              <td>$row[email]</td>
              <td>$row[phone]</td>
              <td>$row[address]</td>
              <td>$row[created_at]</td>
              <td>
                <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Edit</a>
                <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
              </td>
            </tr>
          </tbody>
            ";
        }
      } catch (PDOException $e) {
        die($e->getMessage());
      }
      ?>

    </table>
  </div>
</body>

</html>