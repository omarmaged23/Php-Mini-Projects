<?php
/*
htmlspecialchars()
stripslashes()
strcmp()
class is-invalid
*/
define("REQUIRED_FIELD_ERROR", "This Field Is Required!");
$error = [];
$username = '';
$email = '';
$password = '';
$password_confirm = '';
$cv_url = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = post_data('username');
  $email = post_data('email');
  $password = post_data('password');
  $password_confirm = post_data('password_confirm');
  $cv_url = post_data('cv_url');
  if (!$username) {
    $error['username'] = REQUIRED_FIELD_ERROR;
  } else if (strlen($username) < 6 || strlen($username) > 16) {
    $error['username'] = 'Username must be less than 16 and more than 6 chars';
  }
  if (!$email) {
    $error['email'] = REQUIRED_FIELD_ERROR;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Please enter a valid email address";
  }
  if (!$password) {
    $error['password'] = REQUIRED_FIELD_ERROR;
  }
  if (!$password_confirm) {
    $error['password_confirm'] = REQUIRED_FIELD_ERROR;
  }
  if ($password && $password_confirm && strcmp($password, $password_confirm) !== 0) {
    $error['password_confirm'] = "Passwords are not equal";
  }
  if ($cv_url && !filter_var($cv_url, FILTER_VALIDATE_URL)) {
    $error['cv_url'] = "Please provide a valid url";
  }
}
function post_data($field)
{
  if (!isset($_POST[$field])) {
    return false;
  }
  $data = $_POST[$field];
  return htmlspecialchars(stripslashes(trim($data)));
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="padding: 50px;">

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Username</label>
          <input class="form-control <?php echo isset($error['username']) ? 'is-invalid' : '' ?>" name="username" value="<?php echo $username ?>">
          <small class="form-text text-muted">Min: 6 and max 16 characters</small>
          <div class="invalid-feedback">
            <?php echo $error['username'] ?? '' ?>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control <?php echo isset($error['email']) ? 'is-invalid' : '' ?>" name="email" value="<?php echo $email ?>">
          <div class="invalid-feedback">
            <?php echo $error['email'] ?? '' ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control <?php echo isset($error['password']) ? 'is-invalid' : '' ?>" name="password" value="<?php echo $password ?>">
          <div class="invalid-feedback">
            <?php echo $error['password'] ?? '' ?>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label>Repeat Password</label>
          <input type="password" class="form-control <?php echo isset($error['password_confirm']) ? 'is-invalid' : '' ?>" name="password_confirm" value="<?php echo $password_confirm ?>">
          <div class="invalid-feedback">
            <?php echo $error['password_confirm'] ?? '' ?>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-group">
        <label>Your CV link</label>
        <input type="text" class="form-control <?php echo isset($error['cv_url']) ? 'is-invalid' : '' ?>" name="cv_url" placeholder="https://www.example.com/my-cv" value="<?php echo $cv_url ?>">
        <div class="invalid-feedback">
          <?php echo $error['cv_url'] ?? '' ?>
        </div>
      </div>
    </div>

    <div class="form-group">
      <button class="btn btn-primary">Register</button>
    </div>
  </form>

</body>

</html>