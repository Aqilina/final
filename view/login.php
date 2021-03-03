<div class="row">
    <div class="col-lg-6 col-md-6 col-8 mx-auto">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email:<sup>*</sup></label>
                <input type="email" name="email" id="email"
                       class="<?php echo (!empty($errors['emailErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                       value="<?php echo $email ?>">
                <span class='invalid-feedback'><?php echo $errors['emailErr'] ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:<sup>*</sup></label>
                <input type="password" name="password" id="password"
                       class="<?php echo (!empty($errors['passwordErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                       value="<?php echo $password ?>">
                <span class='invalid-feedback'><?php echo $errors['passwordErr'] ?></span>
            </div>
            <input type="submit" value="Login" class="btn btn-primary btn-block my-3">
        </form>
    </div>
</div>