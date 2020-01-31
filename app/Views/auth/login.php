<?php view('layouts/header'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <?php if (flashMessage()->get()) : ?>
                    <div class="alert alert-danger">
                        <?php echo flashMessage()->get() ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="/auth/login">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               name="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <div class="text-center text-white">Don't have an account? <a href="/auth/signup">Sign Up here</a></div>
                <div class="text-center text-white">Forgot your password? <a href="/auth/reset">Reset</a></div>
            </div>
        </div>
    </div>

<?php view('layouts/footer'); ?>