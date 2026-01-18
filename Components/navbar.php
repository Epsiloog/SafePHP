<link rel="stylesheet" href="./styles/navbar.css">

<div class="navbar-container">
  <a class="navbar-item" href="index.php?action=accueil">Accueil</a>
  <div class="dropdown">
    <button class="dropbtn">Tests</button>
    <div class="dropdown-content">
      <a class="navbar-item" href="index.php?action=test_csrf">Test CSRF</a>
      <a class="navbar-item" href="index.php?action=test_sanitize">Test Sanitize</a>
      <a class="navbar-item" href="index.php?action=test_verify">Test Verify</a>
      <a class="navbar-item" href="index.php?action=test_auth">Test Login & Register</a>
      <a class="navbar-item" href="index.php?action=test_form">Test Form</a>
      <a class="navbar-item" href="index.php?action=test_file_inclusion">Test File Inclusion</a>
      <a class="navbar-item" href="index.php?action=test_sri">Test SRI</a>
    </div>
  </div>
</div>