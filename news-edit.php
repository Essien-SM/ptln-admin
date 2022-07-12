<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg rounded-3 mb-4">
                <div class="card-body">
                    <h4 class="text-primary">Upadate news</h4>

                    <?php
                    include('alerts.php');

                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];

                        $query = "SELECT * FROM news WHERE new_id = '$id' ";
                        $query_run = mysqli_query($connection, $query);

                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                    ?>
                                <form action="news-code.php" method="POST" autocomplete="off">
                                    <input type="hidden" name="id" value="<?php echo $row['new_id'] ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="tittle">Tittle</label>
                                                <input type="text" class="form-control" name="tittle" value="<?php echo $row['tittle']; ?>" id="tittle">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="content">News content</label>
                                                <input class="form-control" name="content" value="<?php echo $row['content']; ?>" id="content" autocapitalize="on" autocorrect="on">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="name">Publisher Name</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo $row['publisher_name']; ?>" id="name">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="source">Source</label>
                                                <input type="text" class="form-control" name="source" value="<?php echo $row['source']; ?>" id="source">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="w-100 mb-2 btn btn-lg rounded-4 btn-outline-primary" name="update-news">Update news</button>
                                </form>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="card-footer">
                    <a href="news.php" class="btn btn-outline-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>