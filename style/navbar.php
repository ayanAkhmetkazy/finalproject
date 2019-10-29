<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php?page=login">Twitter</a>
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link <?php if($page == 'login'){echo 'active';} ;?>" href="index.php?page=login">Log in</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if($page == 'register'){echo 'active';} ;?>" href="index.php?page=register">Register</a>
    </li>
  </ul>
</nav>