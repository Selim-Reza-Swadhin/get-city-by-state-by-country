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
$connection = new mysqli("localhost","root","","get-city-by-state-by-country");
$query = "SELECT * FROM bird_countries";
$allCountries = mysqli_query($connection, $query);
?>
<div id="box">
    <form action="script.php" method="post">

        <label>Country <span style="color:red">*</span></label>
        <select name="country" class="form-control">
            <option value="">Country</option>
            <?php
            if (mysqli_num_rows($allCountries) > 0 ){
                while ($country = mysqli_fetch_assoc($allCountries) ) {
                    $countryId = $country['id'];
                    $countryName = $country['name'];?>
                    <option value="<?= $countryId;?>"><?= $countryName;?></option>
                <?php }
            }
            ?>

        </select>

        <label>State <span style="color:red">*</span></label>
        <select class="form-control" name="state"  >
            <option value="">State</option>
            <?php
            $connection = new mysqli("localhost","root","","get-city-by-state-by-country");
            $query = "SELECT bird_states.id, bird_states.statename
                      FROM bird_countries
                      INNER JOIN bird_states 
                      ON 
                      bird_countries.id = bird_states.countryId";
                      //WHERE countryId='$countryId'";
            $Country_State = mysqli_query($connection, $query);
            if (mysqli_num_rows($Country_State) > 0 ){
                while ($state = mysqli_fetch_assoc($Country_State) ) {
                     $stateId = $state['id'];
                     $stateName = $state['statename'];?>
                    <option value="<?= $stateId;?>"><?= $stateName;?></option>
                <?php }
            }
            ?>
        </select>

        <label>City <span style="color:red">*</span></label>
        <select class="form-control" name="city">
            <option value="">City</option>
            <?php
            $connection = new mysqli("localhost","root","","get-city-by-state-by-country");
            $query = "SELECT bird_states.countryId, bird_cities.id, bird_cities.cityName
                      FROM bird_states
                      INNER JOIN bird_cities 
                      ON 
                      bird_states.countryId = bird_cities.id";
            //WHERE countryId='$countryId'";
            $State_city = mysqli_query($connection, $query);
            if (mysqli_num_rows($State_city) > 0 ){
                while ($city = mysqli_fetch_assoc($State_city) ) {
                    $cityId = $city['id'];
                    $cityName = $city['cityName'];?>
                    <option value="<?= $cityId;?>"><?= $cityName;?></option>
                <?php }
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Submit">
    </form>
</div>
</body>
</html>

<?php
/*$connection = new mysqli("localhost","root","","get-city-by-state-by-country");
$query = "SELECT bird_countries.id, bird_states.countryId, bird_states.statename
                      FROM bird_countries
                      INNER JOIN bird_states
                      ON
                      bird_countries.id = bird_states.countryId";
$Country_State = mysqli_query($connection, $query);

while ($state = mysqli_fetch_assoc($Country_State) ) {*/?><!--

    <tr>
        <td><?/*= $state['id'];*/?></td>
        <td><?/*= $state['countryId'];*/?></td>
        <td><?/*= $state['statename'];*/?></td>
    </tr>
    --><?php
/*}
*/?>
