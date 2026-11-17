<?php
// ponytail: native Apache DirectoryIndex redirect for /admin without requiring mod_rewrite; upgrade to front-controller router if clean URLs expand.
session_start();
if (isset($_SESSION['username'])) {
    header("Location: ../admin_index.php");
} else {
    header("Location: ../login.php");
}
exit;
?>
