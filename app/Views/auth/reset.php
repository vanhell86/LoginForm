<?php view('layouts/header'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <?php if (flashMessage()->get()) : ?>
                    <div class="alert alert-danger">
                        <?php echo flashMessage()->get() ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="/auth/reset">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               name="email">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

<?php view('layouts/footer'); ?>