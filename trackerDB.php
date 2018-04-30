<?php
if(isset($_REQUEST))
{
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    if(isMobile()){
        $device_type = "Mobile/Tablet";
    }
    else {
        $device_type = "Laptop/PC";
    }

    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "quran");
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql="INSERT INTO `statistics` (`ip_address`, `hostname`, `country`, `state`, `city`,  `postal`, `device_type`) VALUES
('$_REQUEST[ip]', '".gethostname()."', '$_REQUEST[country]', '$_REQUEST[region]', '$_REQUEST[city]', '$_REQUEST[postal]', '$device_type')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>