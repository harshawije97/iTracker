 <?php include_once './services/auth.php'; ?>

 <?php
    $sessionUser = getSessionUser();
    ?>

 <aside class="sidebar" id="sidebar">
     <div class="sidebar-header">
         <div class="user-details">
             <h2 class="user-name">
                 <?= htmlspecialchars($sessionUser['username']) ?>
             </h2>
             <p class="user-info">Hi, <?= htmlspecialchars($sessionUser['first_name']) ?></p>
             <p class="user-info-small text-green"><?= htmlspecialchars($sessionUser['estate_code']) ?></p>
         </div>
         <button id="closeBtn">&times;</button>
     </div>
     <ul class="sidebar-menu">
         <li class="sidebar-item">
             <a href="./dashboard.php" class="sidebar-link">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                     <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                     <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                 </svg>
                 <span>Dashboard</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a href="./inventory.php" class="sidebar-link">
                 <svg xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-archive-icon lucide-archive">
                     <rect width="20" height="5" x="2" y="3" rx="1" />
                     <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8" />
                     <path d="M10 12h4" />
                 </svg>
                 <span>Inventory</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a href="./incidents.php" class="sidebar-link">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-plus-icon lucide-clipboard-plus">
                     <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                     <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                     <path d="M9 14h6" />
                     <path d="M12 17v-6" />
                 </svg>
                 <span>
                     Incidents
                 </span>
             </a>
         </li>
         <?php if (str_ends_with($sessionUser['role'], 'manager')) { ?>
             <li class="sidebar-item">
                 <a href="users.php" class="sidebar-link">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                         <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                         <circle cx="12" cy="7" r="4" />
                     </svg>
                     Users
                 </a>
             </li>
         <?php } ?>
     </ul>
     <div class="sidebar-footer">
         <div class="user-box">
             <div class="user-avatar"></div>
             <span>Full Name</span>
         </div>
     </div>
 </aside>