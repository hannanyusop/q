<?php
session_start();
if(isset($_SESSION['test'])){

}else {
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $.get("https://ipinfo.io/json", function (response) {
                $("#ip").html("IP: " + response.ip);
                $("#address").html("Location: " + response.city + ", " + response.region);
                $("#details").html(JSON.stringify(response, null, 4));

                var data = response;
                $.ajax({
                    data: data,
                    type: "post",
                    url: "trackerDB.php",
                    success: function (data) {
                        console.log("new visitor");
                    }
                });
            }
            , "jsonp");

    </script>
<?php

    function randIt($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $_SESSION['test'] = randIt();
}
?>
