<h1>Register</h1>



<div class="row">
    <div class="col-lg-6 mx-auto">
<!--        <div class="card  bg-light mt-5">-->
            <!--                --><?php //flash('register_fail'); ?>

            <form action="" method="post">

                <div class="form-group">
                    <label for="name">Name:<sup>*</sup></label>
                    <input type="text" name="name" id="name"
                           class="<?php echo (empty($errors['nameErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $name ?>">
                    <span class='invalid-feedback'><?php echo $errors['nameErr'] ?></span>
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname:<sup>*</sup></label>
                    <input type="text" name="lastname" id="lastname"
                           class="<?php echo (empty($errors['lastnameErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $name ?>">
                    <span class='invalid-feedback'><?php echo $errors['lastnameErr'] ?></span>
                </div>

                <div class="form-group">
                    <label for="email">Email:<sup>*</sup></label>
                    <input type="text" name="email" id="email"
                           class="<?php echo (empty($errors['emailErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $email ?>">
                    <span class='invalid-feedback'><?php echo $errors['emailErr'] ?></span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone number:</label>
                    <input type="text" name="phone" id="phone"
                           class="<?php echo (empty($errors['phoneErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $email ?>">
                    <span class='invalid-feedback'><?php echo $errors['phoneErr'] ?></span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address"
                           class="<?php echo (empty($errors['addressErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $email ?>">
                    <span class='invalid-feedback'><?php echo $errors['addressErr'] ?></span>
                </div>


                <div class="form-group">
                    <label for="password">Password:<sup>*</sup></label>
                    <input type="password" name="password" id="password"
                           class="<?php echo (empty($errors['passwordErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $password ?>">
                    <span class='invalid-feedback'><?php echo $errors['passwordErr'] ?></span>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:<sup>*</sup></label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                           class="<?php echo (empty($errors['confirmPasswordErr'])) ? '' : 'is-invalid'; ?> form-control form-control-lg"
                           value="<?php echo $confirmPassword ?>">
                    <span class='invalid-feedback'><?php echo $errors['confirmPasswordErr'] ?></span>
                </div>


                        <input type="submit" value="Register" class="btn btn-primary btn-block m-4">


            </form>
<!--        </div>/-->
    </div>
</div>



