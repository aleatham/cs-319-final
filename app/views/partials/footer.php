</div> <!-- /#main-wrap -->
<footer class="footer-basic-centered">
	<p class="footer-company-motto">Community curated culinary delights.</p>
		<a href="index.php?path=">Home</a>
		·
		<a href="index.php?path=recipes">Recipes</a>
		·
    <?php if ($current_user->id > 0): ?>
		<a href="index.php?path=lists">Lists</a>
		·
    <?php endif; ?>
    <?php if ($current_user->is_admin): ?>
		  <a href="index.php?path=users">Users</a>
		  ·
    <?php endif; ?>
    <?php if ($current_user && $current_user->id > 0): ?>
      <a href="?path=logout"
         onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
        Logout
      </a>
      <form id="logout-form" action="?path=logout" method="POST" style="display: none;">
      </form>
    <?php else: ?>
      <a href="?path=login">Login</a>
      <a href="?path=register">Register</a>
    <?php endif; ?>
	</p>
	<p class="footer-company-name">Get My Fixings &copy; 2017</p>
</footer>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="app/assets/scripts/app.js"></script>
