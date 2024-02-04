<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
           <h4 class="mb-0">Categories
            <a href="categories-create.php" class="btn btn-primary float-end">Add Category</a>
           </h4> 
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $categories = getAll('categories');
                        if(!$categories){
                            echo '<h4>Something Went Wrong</h4>';
                            return false;
                        }
                        if(mysqli_num_rows($categories) > 0)
                        {
                            foreach($categories as $item) {
                        ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['status'] ?></td>
                            <td>
                                <a href="categories-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="categories-delete.php?id=<?= $item['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        else
                        {
                        ?>
                                <h4 class="mb-0">No Record Found</h4>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
