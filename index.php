<!DOCTYPE html>
<html lang="en">
<head>
    <title>Country-State-City Dependency dropdown</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./website/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./website/js/vendor/jquery-3.5.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="./website/js/vendor/bootstrap.min.js"></script>
    <style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    #box {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        margin: 0px 200px 0px 200px;
    }
</style>
</head>
<body>
<div class="jumbotron text-center">
    <h1>Get City by State by Country</h1>
    <p>https://selimrezaswadhin.com</p>
</div>

<?php
include "config.php";
$connection = new mysqli("localhost","root","","get-city-by-state-by-country");
include_once "Common.php";
$common = new Common();
$allCountries = $common->getCountries($connection);
?>
<div id="box">
    <form action="script.php" method="post">

        <label>Country <span style="color:red">*</span></label>
        <select name="country" id="countryId" class="form-control" onchange="getStatesByCountry();" >
            <option value="">Country</option>
            <?php
            if ($allCountries->num_rows > 0 ){
                while ($country = $allCountries->fetch_object() ) {
                    $countryId = $country->id;
                    $countryName = $country->name;?>
                    <option value="<?= $countryId;?>"><?= $countryName;?></option>
                <?php }
            }
            ?>

        </select>

        <label>State <span style="color:red">*</span></label>
        <select class="form-control" name="state" id="stateId" onchange="getCityByState();"  >
            <option value="">State</option>
        </select>

        <label>City <span style="color:red">*</span></label>
        <select class="form-control" name="city" id="cityDiv">
            <option value="">City</option>
        </select>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<script>
    function getStatesByCountry() {
        let countryId = $("#countryId").val();
        $.ajax({
            // type : 'get',//default
            method : 'post',
            url:'ajax.php',
            data:{getStatesByCountry:'getStatesByCountry',countryId:countryId},
            success : function (response) {
                    // alert(response);
                    let data = response.split('^');
                    let stateData = data[1];
                    $("#stateId").html(stateData);
            }
        });

       /* $.post(
            "ajax.php",
            {getStatesByCountry:'getStatesByCountry',countryId:countryId},
            function (response) {
           // alert(response);
            let data = response.split('^');
            let stateData = data[1];
            $("#stateId").html(stateData);
        });*/
    }

    function getCityByState() {
        let stateId = $("#stateId").val();
        $.post("ajax.php",{getCityByState:'getCityByState',stateId:stateId},function (response) {
            // alert(response);
            let data = response.split('^');
            let cityData = data[1];
            $("#cityDiv").html(cityData);
        });
    }
</script>
</body>
</html>
