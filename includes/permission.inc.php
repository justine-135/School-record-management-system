<?php
if ($_SESSION['is_superadmin'] == 0) {
        switch ($_SESSION['page_permission']) {
            case 'admin':
                if ($_SESSION['is_admin'] == 0) {
                    // header("Location: ./index.php?permission&error");
                    echo '<p class="p-2">You are not permitted to visit this page. Redirect <a href="javascript:history.back()">here</a>.</p>';
                    die();
                }
                break;
            case 'teacher':
                if ($_SESSION['is_teacher'] == 0 && $_SESSION['is_guidance'] == 0) {
                    // header("Location: ./index.php?permission&error");
                    echo '<p class="p-2">You are not permitted to visit this page. Redirect <a href="javascript:history.back()">here</a>.</p>';
                    die();
                }
                break;
            case 'guidance':
                if ($_SESSION['is_guidance'] == 0) {
                    // header("Location: ./index.php?permission&error");
                    echo '<p class="p-2">You are not permitted to visit this page. Redirect <a href="javascript:history.back()">here</a>.</p>';
                    die();
                }
                break;
            // case 'author':
            //     if ($_SESSION['is_author'] == 0) {
            //         header("Location: ./index.php?permission&error");
            //         die();
            //     }
            //     break;
            default:
                break;
        }
    
}  