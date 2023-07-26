            <?php
            session_start();
            if (isset($_GET['x']) && $_GET['x'] == 'dashboard') {
                $page = "dashboard.php";
                include "main.php";
            } elseif (isset($_GET['x']) && $_GET['x'] == 'menu') {
                if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 3) {
                    $page = "menu_card.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'katmenu') {
                if ($_SESSION['level_user'] == 1) {
                    $page = "kat_menu.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'order') {
                if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3) {
                    $page = "order.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'orderitem') {
                if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 3) {
                    $page = "order_item.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'viewitem') {
                if ($_SESSION['level_user'] == 1) {
                    $page = "view_item.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'dapur') {
                if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 4) {
                    $page = "dapur.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
                if ($_SESSION['level_user'] == 1) {
                    $page = "user.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'report') {
                if ($_SESSION['level_user'] == 1) {
                    $page = "report.php";
                    include "main.php";
                } else {
                    $page = "dashboard.php";
                    include "main.php";
                }
            } elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
                include "login.php";
            } elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
                include "proses/proses_logout.php";
            } else {
                include "main.php";
            }
            ?>
            