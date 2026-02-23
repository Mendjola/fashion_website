<?php

if (isset($success) && is_array($success)) {
    foreach ($success as $successMessage) {
        echo '<script>Swal.fire("' . $successMessage . '","","success");</script>';
    }
}

if (isset($error) && is_array($error)) {
    foreach ($error as $errorMessage) {
        echo '<script>Swal.fire("' . $errorMessage . '","","error");</script>';
    }
}

if (isset($warning) && is_array($warning)) {
    foreach ($warning as $warningMessage) {
        echo '<script>Swal.fire("' . $warningMessage . '","","warning");</script>';
    }
}

if (isset($info) && is_array($info)) {
    foreach ($info as $infoMessage) {
        echo '<script>Swal.fire("' . $infoMessage . '","","info");</script>';
    }
}

?>
