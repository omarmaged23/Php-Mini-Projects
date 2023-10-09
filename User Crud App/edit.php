<?php
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$errorMessage = "";
$successMessage = "";
///////////////////////////
$hostname = "localhost";
$username = "root";
$pass = "root";
$database = "my_db";
$conn = new PDO("mysql:hostname=$hostname;dbname=$database", $username, $pass);
//////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Get Method to show the data of client
  if (!isset($_GET['id'])) {
    header("location: index.php");
    exit;
  }
  $id = $_GET['id'];
  // read row of the selected client from database
  $sql = "SELECT * from clients WHERE id=$id";
  $stmt = $conn->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$row) {
    header("location: index.php");
    exit;
  }
  $name = $row['name'];
  $email = $row['email'];
  $phone = $row['phone'];
  $address = $row['address'];
} else {
  // POST Method to update the data of the user
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  do {
    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
      $errorMessage = "All Fields Are Required";
      break;
    }

    // Write your queries
    $sql = "UPDATE clients Set name='$name' , email='$email',
            phone='$phone',address='$address' WHERE id=$id";
    // Read and Use your queries
    try {
      $result = $conn->query($sql);
    } catch (Exception $e) {
      $result = "";
    }
    if (!$result) {
      $errorMessage = 'Invalid query: ' . $conn->errorInfo()[2];
      break;
    }

    $successMessage = "Client Updated Successfully";
    header("location: index.php");
    exit;
  } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js'></script>
  <title>My Shop</title>
</head>

<body>
  <div class="container my-5">
    <h2>New Client</h2>
    <!-- Error Message Display -->
    <?php
    if (!empty($errorMessage)) {
      echo "

            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
    }
    ?>
    <!-- Form Data Fill -->
    <form action="" method="post">
      <input type='hidden' name='id' value='<?php echo $id; ?>'>
      <!-- Name -->
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
        </div>
      </div>
      <!-- Email -->
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
      </div>
      <!-- Phone -->
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
        </div>
      </div>
      <!-- Address -->
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
        </div>
      </div>
      <!-- Success Message -->
      <?php
      if (!empty($successMessage)) {
        echo "
        <div class='row mb-3'>
          <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          </div>
        </div>
        ";
      }
      ?>
      <!-- Submit and Cancel -->
      <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
          <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</body>

</html>