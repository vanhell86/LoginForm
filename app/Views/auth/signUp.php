<?php view('layouts/header'); ?>

    <div class="container">
        <?php if (flashMessage()->get()) : ?>
            <div class="alert alert-danger">
                <?php echo flashMessage()->get() ?>
            </div>
        <?php endif; ?>
        <div class="signup-form">
            <form action="/auth/signup" method="post">
                <h2 style="color: white">Sign Up</h2>
                <p style="color: white">Please fill in this form to create an account!</p>
                <hr>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-lock"></i>
					<i class="fa fa-check"></i>
				</span>
                        <input type="password" class="form-control" name="confirm_password"
                               placeholder="Confirm Password"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                </div>
            </form>
            <div class="text-center text-white">Already have an account? <a href="/auth/login">Login here</a></div>
        </div>
    </div>

<?php view('layouts/footer'); ?>