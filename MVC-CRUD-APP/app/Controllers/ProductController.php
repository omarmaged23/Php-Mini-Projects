<?php

class ProductController
{
  public function index()
  {
    $db = new Product;
    $data['products'] = $db->getAllProducts();
    View::load("product/index", $data);
  }
  // View Add Page
  public function add()
  {
    View::load("product/add");
  }
  // Store Data From Form Into Database
  public function store()
  {
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $qty = $_POST['qty'];
      $data = array(
        "name" => $name,
        "price" => $price,
        "description" => $description,
        "qty" => $qty
      );
      $db = new Product();
      if ($db->insertProduct($data)) {
        View::load("product/add", ["success" => "Data Created Successfully"]);
      } else {
        View::load("product/add", ["error" => "Make Sure The Data Inserted Is Correct"]);
      }
    }
  }
  // Edit Product 
  public function edit($id)
  {
    $db = new Product();
    if ($db->getRow($id)) {
      $data['row'] = $db->getRow($id);
      View::load('product/edit', $data);
    } else {
      echo 'Error';
    }
  }
  public function update($id)
  {
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $qty = $_POST['qty'];
      $dataUpdate = array(
        "name" => $name,
        "price" => $price,
        "description" => $description,
        "qty" => $qty
      );
      $db = new Product();
      if ($db->updateProduct($id, $dataUpdate)) {
        View::load("product/edit", ["success" => "Data Updated Successfully", 'row' => $db->getRow($id)]);
      } else {
        View::load("product/edit", ["error" => "Make Sure The Data Inserted Is Correct", 'row' => $db->getRow($id)]);
      }
    }
  }
  // Delete Product From Database
  public function delete($id)
  {
    $db = new Product();
    if ($db->deleteProduct($id)) {
      View::load("product/delete");
    } else {
      echo 'Error';
    }
  }
}
