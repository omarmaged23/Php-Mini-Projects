<?php include(VIEWS . 'inc/header.php'); ?>
<h1 class="text-center  my-5 py-3">View All Products </h1>
<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>

          <?php $i = 1; ?>
          <?php foreach ($products as $row) :  ?>
            <tr>
              <td> <?php echo $i;
                    $i++; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['price']; ?> <b class="float-right"> $ </b></td>
              <td class="text-center"><?php echo $row['description']; ?></td>
              <td><?php echo $row['qty']; ?></td>
              <td>
                <a href="<?php url('product/edit/' . $row['id']) ?>" class="btn btn-info">Edit</a>
              </td>
              <td>
                <a href="<?php url('product/delete/' . $row['id']) ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include(VIEWS . 'inc/footer.php'); ?>