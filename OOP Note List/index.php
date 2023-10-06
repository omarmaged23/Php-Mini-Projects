<?php
require_once __DIR__ . '/Connection.php';
$conn = new Connection();
$notes = $conn->getNotes();
$currenItem = [
  "id" => '',
  "title" => '',
  "description" => ''
];
if (isset($_GET['id'])) {
  $currenItem = $conn->getNoteById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="app.css">
</head>

<body>
  <div>
    <form class="new-note" action="create.php" method="post">
      <input type="hidden" name='id' value='<?php echo $currenItem['id'] ?>'>
      <input type="text" name="title" placeholder="Note title" autocomplete="off" value='<?php echo $currenItem["title"] ?>'>
      <textarea name="description" cols="30" rows="4" placeholder="Note Description">
            <?php echo trim($currenItem["description"]) ?>
            </textarea>
      <button>
        <?php if ($currenItem['id']) : ?>
          Update Note
        <?php else : ?>
          Add Note
        <?php endif; ?>
      </button>
    </form>
    <div class="notes">
      <?php foreach ($notes as $note) : ?>
        <div class="note">
          <div class="title">
            <a href="?id=<?php echo $note['id'] ?>"><?php echo $note['title'] ?></a>
          </div>
          <div class="description">
            <?php echo trim($note['description']) ?>
          </div>
          <small><?php echo $note['create_date'] ?></small>
          <form action="delete.php" method='post'>
            <input type="hidden" name='id' value='<?php echo $note['id'] ?>'>
            <button class="close">X</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>