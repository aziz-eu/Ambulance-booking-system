<?php if (isset($_GET['msg']) && !empty($_GET['msg'])) : ?>


    <div class="alert alert-<?php echo $_GET['type'] ?> alert-dismissible fade show text-center" role="alert">
        <strong><?php echo $_GET['msg'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>


<?php endif ?>