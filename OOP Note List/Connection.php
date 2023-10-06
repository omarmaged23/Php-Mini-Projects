<?php
class Connection
{
  public $pdo;
  public function __construct()
  {
    $this->pdo = new PDO('mysql:hostname=localhost;dbname=notes', 'root', 'root');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  public function getNotes()
  {
    $statement = $this->pdo->prepare('SELECT * FROM notes ORDER BY create_date DESC');
    $statement->execute();
    return $statement->fetchall(PDO::FETCH_ASSOC);
  }
  public function addNote($new)
  {
    $statement = $this->pdo->prepare('INSERT INTO notes(title,description,create_date)
                                    values(:title,:description,:create_date)');
    $statement->bindValue("title", trim($new['title']));
    $statement->bindValue("description", trim($new['description']));
    $statement->bindValue("create_date", date("Y-m-d H-i-s"));
    $statement->execute();
  }
  public function getNoteById($id)
  {
    $statement = $this->pdo->prepare('SELECT * FROM notes Where id = :id');
    $statement->bindValue('id', $id);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function updateNote($id, $note)
  {
    $statement = $this->pdo->prepare('UPDATE notes SET title=:title,description=:description WHERE id=:id');
    $statement->bindValue("title", trim($note['title']));
    $statement->bindValue("description", trim($note['description']));
    $statement->bindValue("id", $id);
    $statement->execute();
  }
  public function deleteNoteById($id)
  {
    $statement = $this->pdo->prepare('DELETE FROM notes WHERE id=:id');
    $statement->bindValue('id', $id);
    $statement->execute();
  }
}
