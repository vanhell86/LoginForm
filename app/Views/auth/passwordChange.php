<?php use Carbon\Carbon;

view('layouts/header');
?>

<?php if ($userData = database()->get('users', ["token", "tokenExpire"], ['token' => $token])): ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <?php if (flashMessage()->get()) : ?>
                    <div class="alert alert-danger">
                        <?php echo flashMessage()->get() ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="/auth/reset/<?php echo $token ?>">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="newPassword">Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php elseif ($userData['tokenExpire'] != null && $userData['tokenExpire'] < Carbon::now()): ?>
    <?php
    flashMessage()->set("Reset link expired");
    redirect('/auth/reset'); ?>
<?php else : ?>
    <?php flashMessage()->set("Invalid reset link");
    redirect('/auth/reset'); ?>
<?php endif; ?>

<?php view('layouts/footer'); ?>