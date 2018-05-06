<?php
session_start();
session_destroy();

echo "<script>alert('Session telah ditamatkan.');window.location='../../index.php'</script>";

?>