<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="?path=">
    <i class="fa fa-cutlery"></i> <strong>G</strong>et <strong>M</strong>y <strong>F</strong>ixings
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= $path == 'recipes' ? 'active' : ''?>">
        <a class="nav-link" href="?path=recipes">Recipes</a>
      </li>
      <?php if ($current_user->id > 0): ?>
      <li class="nav-item <?= $path == 'lists' ? 'active' : ''?>">
        <a class="nav-link" href="?path=lists">Lists</a>
      </li>
      <?php endif; ?>
      <?php if ($current_user->is_admin): ?>
      <li class="nav-item <?= $path == 'users' ? 'active' : ''?>">
        <a class="nav-link" href="?path=users">Users</a>
      </li>
      <?php endif; ?>
    </ul>
    <ul class="navbar-nav nav ml-auto">
      <?php if ($current_user && $current_user->id > 0): ?>
        <li class="nav-item dropdown">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
            <?= $current_user->first_name ?><span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-left" 
               style="right:0px; left: auto;">
            <a class="dropdown-item" href="?path=logout"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="?path=logout" method="POST" style="display: none;">
            </form>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a href="?path=login" class="nav-link">Login</a>
        </li>
        <li class="nav-item">
          <a href="?path=register" class="nav-link">Register</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<div class="container-fluid" id="main-wrap"> <!-- #main-wrap -->
