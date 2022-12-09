<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Title -->
    <title>Todo App</title>
</head>

<?php
$session = session();
?>

<body style="background-color: #07192f; color: white;">
    <div class="toast-container">
        <!-- Create Action Toast -->
        <?php
        if ($session->getFlashdata('action') !== null) {
            if ($session->getFlashdata('status') == 'error') { ?>
                <?php foreach ($session->getFlashdata('message') as $errMsg) { ?>
                    <div class="toast align-items-center text-bg-danger border-0 show position-relative m-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body ">
                                <?= $errMsg; ?>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="toast align-items-center text-bg-success border-0 show position-relative m-3" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?= $session->getFlashdata('message') ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
        <?php }
        }
        ?>
        <!-- Main  -->
        <?php if ($error != null) { ?>
            <div class="toast align-items-center text-bg-danger border-0 show position-relative m-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body ">
                        <?= $error; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
    </div>
    <h3 class="text-center mt-5">TODO APP ✏️</h3>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-12 my-4">
                <h3>Create To-do</h3>
                <form action="<?= base_url() ?>" method="POST">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="example, Main gundu" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="example, Description of main gundu"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="col-12">
                <h3>To-do List</h3>
                <div class="row">
                    <?php foreach ($data as $d) { ?>
                        <div class="col-12 text-black d-flex justify-content-center">
                            <div class="card my-3 w-100">
                                <div class="card-body">
                                    <h5 class="card-title" <?php if ($d->isDone == 't') { ?> style="text-decoration: line-through;" <?php } ?>><?= $d->title ?></h5>
                                    <p class="card-text" <?php if ($d->isDone == 't') { ?> style="text-decoration: line-through;" <?php } ?>><?= $d->description ?></p>
                                    <!-- Detail Btn -->
                                    <div class="d-flex">
                                        <a href="<?php echo base_url() ?>/detail/<?= $d->id ?>" class="btn btn-primary me-3">Detail</a>
                                        <!-- Mark Completed/Uncompleted Btn-->
                                        <?php if ($d->isDone == 't') { ?>
                                            <form action="<?php base_url() ?>/update/setIsDone/<?= $d->id ?>" method="post">
                                                <input type="hidden" name="isDone" value="<?= $d->isDone ?>">
                                                <button type="submit" class="btn btn-warning me-3">Mark As Uncompleted</button>
                                            </form>
                                        <?php } else { ?>
                                            <form action="<?php base_url() ?>/update/setIsDone/<?= $d->id ?>" method="POST">
                                                <input type="hidden" name="isDone" value="<?= $d->isDone ?>">
                                                <button type="submit" class="btn btn-success me-3">Mark As Completed</button>
                                            </form>
                                        <?php } ?>
                                        <!-- Delete Btn -->
                                        <form action="<?php base_url() ?>/delete/<?= $d->id ?>" method="POST">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>


</html>