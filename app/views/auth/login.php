<div class="container-fluid login-form">
  <div class="row">
    <div class="col-md-12 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading login-h4"><h4>Welcome! Sign in here</h4></div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="?path=post_login" id="form">
            <div class="form-group">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
              </div>
            </div>

            <div class="form-group">
              <label for="pass" class="col-md-4 control-label">Password</label>

              <div class="col-md-6">
                <input id="pass" type="password" class="form-control" name="pass" required>
              </div>
            </div>
            <?php if ($errors['login']): ?>
              <div class="alert alert-danger">
                <strong><?= $errors['login'] ?></strong>
              </div>
            <?php endif; ?>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-outline-primary"> 
                    Login
                </button>
                <a class="btn btn-link" href="?path=password">
                    Forgot Your Password?
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>