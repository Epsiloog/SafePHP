<link rel="stylesheet" href="./styles/navbar.css">

<div class="navbar-container">
  <ul>
    <li>
      <a href="index.php?action=accueil">Accueil</a>
    </li>
  </ul>
  <div class="dropdown">
    <button class="dropbtn">Tests</button>
    <div class="dropdown-content">
      <a href="index.php?action=test_csrf">Test CSRF</a>
      <a href="index.php?action=test_sanitize">Test Sanitize</a>
      <a href="index.php?action=test_verify">Test Verify</a>
      <a href="index.php?action=test_auth">Test Login & Register</a>
    </div>
  </div>
</div>