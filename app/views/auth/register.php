<div class="container-fluid login-form">
  <div class="row">
    <div class="col-md-12 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading login-h4"><h4>Register</h4></div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="?path=post_register" id="form">
            <!-- First Name -->
            <div class="form-group <?= $errors['first_name'] ? 'has-error' : '' ?>">
              <label for="first_name" class="col-md-4 control-label">First Name</label>

              <div class="col-md-6">
                <input id="first_name" type="text" class="form-control" name="first_name" value="" required autofocus>

                  
                <?php if ($errors && array_key_exists('first_name', $errors)): ?>
                  <div class="alert alert-danger">
                    <strong><?= $errors['first_name'] ?></strong>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- Last Name -->
            <div class="form-group <?= $errors['last_name'] ? 'has-error' : '' ?>">
              <label for="last_name" class="col-md-4 control-label">Last Name</label>

              <div class="col-md-6">
                <input id="last_name" type="text" class="form-control" name="last_name" value="" required autofocus>

                  
                <?php if ($errors && array_key_exists('last_name', $errors)): ?>
                  <div class="alert alert-danger">
                    <strong><?= $errors['last_name'] ?></strong>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- Email -->
            <div class="form-group <?= $errors['email'] ? 'has-error' : '' ?>">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                  
                <?php if ($errors && array_key_exists('email', $errors)): ?>
                  <div class="alert alert-danger">
                    <strong><?= $errors['email'] ?></strong>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- Password -->
            <div class="form-group <?= $errors['pass'] ? 'has-error' : '' ?>">
              <label for="pass" class="col-md-4 control-label">Password</label>
              
              <div class="col-md-6">
                <input id="pass" type="password" class="form-control" name="pass" required>

                <?php if ($errors && array_key_exists('pass', $errors)): ?>
                  <div class="alert alert-danger">
                    <strong><?= $errors['pass'] ?></strong>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group">
              <label for="pass2" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                <input id="pass2" type="password" class="form-control" name="pass2" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Register
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
