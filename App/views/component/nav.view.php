<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$role = $_SESSION['USER']['role'] ?? '';
$profileLink = '#'; 

switch ($role) {
    case 'student':
        $profileLink = ROOT . '/StudentProfile';
        break;
    case 'teacher':
        $profileLink = ROOT . '/TeacherProfile';
        break;
    case 'institute':
        $profileLink = ROOT . '/InstituteProfile';
        break;
    case 'admin':
        $profileLink = ROOT . '/Admin'; 
        break;
}
?>

<nav class="navbar">
  <div class="navbar-logo">
    <a href="<?php echo ROOT ?>/home">
      <img src="<?php echo ROOT ?>/assets/images/logo.png" alt="Institute Logo">
    </a>
  </div>

  <div class="navbar-right-section">
    <form action="<?= ROOT ?>/ClassList" method="GET" class="navbar-search-container">
      <input type="search" name="query" placeholder="Search here..." class="navbar-search-bar">
      <button type="submit" class="navbar-search-icon ">Search</button>
    </form>
    
    <div class="navbar-links">
      <?php if (!empty($role)): ?>

        <!-- Admin: only show profile & logout -->
        <?php if ($role === 'admin'): ?>
            <a href="<?php echo $profileLink ?>" class="navbar-btn navbar-profile-icon" title="View Profile">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </a>

            <a href="<?php echo ROOT; ?>/Login/logout" class="navbar-btn logout-btn">
              <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>

        <!-- Other roles: show profile, logout & classes -->
        <?php else: ?>
            <a href="<?php echo $profileLink ?>" class="navbar-btn navbar-profile-icon" title="View Profile">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </a>

            <a href="<?php echo ROOT; ?>/Login/logout" class="navbar-btn logout-btn">
              <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>

            <a href="<?php echo ROOT ?>/ClassManager" class="navbar-btn">Classes</a>
        <?php endif; ?>

      <?php else: ?>
        <!-- Show when no user logged in -->
        <a href="<?php echo ROOT ?>/Login" class="navbar-btn navbar-secondary-btn">Log in</a>
        <a href="<?php echo ROOT ?>/signup" class="navbar-btn">Sign up</a>
      <?php endif; ?>

    </div>
  </div>
</nav>
