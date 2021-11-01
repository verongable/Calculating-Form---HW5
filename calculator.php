<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/calculator.css" type="text/css" rel="stylesheet">
    <title>Travel Calculator</title>
</head>
<body>
    <h1>Trip Calculator</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
<fieldset>
    <label for="name">Name</label>
        <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ;?>">

    <label for="miles">How many miles will you be driving?</label>
        <input type="number" name="miles" value="<?php if(isset($_POST['miles'])) echo htmlspecialchars($_POST['miles']); ;?>">

    <label for="idealhours">How many hours per day would you like to drive?</label>
        <input type="number" name="idealhours" value="<?php if(isset($_POST['idealhours'])) echo htmlspecialchars($_POST['idealhours']); ;?>">

    <label for="price">Price per gallon</label>
        <ul>
            <li><input type="radio" name="price" value="3.00"
            <?php if(isset($_POST['price']) && $_POST['price'] == '3.00') echo 'checked="checked"' ;?>
            >$3.00</li>
            <li><input type="radio" name="price" value="3.50"
            <?php if(isset($_POST['price']) &&$_POST['price'] == '3.50') echo 'checked="checked"' ;?>
            >$3.50</li>
            <li><input type="radio" name="price" value="4.00"
            <?php if(isset($_POST['price']) &&$_POST['price'] == '4.00') echo 'checked="checked"' ;?>
            >$4.00</li>
        </ul>

        <label for="fuel">Fuel efficiency</label>
        <select name="fuel">
            <option value="" NULL
            <?php if(isset($_POST['fuel']) && $_POST['fuel'] == NULL) echo 'selected="unselected"';?>
            >Select One</option>

            <option value="20"
            <?php if(isset($_POST['fuel']) && $_POST['fuel'] == '20') echo 'selected="unselected"';?>
            >Terrible</option>

            <option value="30"
            <?php if(isset($_POST['fuel']) && $_POST['fuel'] == '30') echo 'selected="unselected"';?>
            >Not too bad</option>

            <option value="35"
            <?php if(isset($_POST['fuel']) && $_POST['fuel'] == '35') echo 'selected="unselected"';?>
            >Pretty good</option>

            <option value="40"
            <?php if(isset($_POST['fuel']) && $_POST['fuel'] == '40') echo 'selected="unselected"';?>
            >Excellent</option>
        </select>

        <label for="speed">How fast do you plan on driving?</label>
        <select name="speed">
            <option value="" NULL
            <?php if(isset($_POST['speed']) && $_POST['speed'] == NULL) echo 'selected="unselected"';?>
            >Select your speed</option>

            <option value="60"
            <?php if(isset($_POST['speed']) && $_POST['speed'] == '60') echo 'selected="unselected"';?>
            >60mph</option>

            <option value="65"
            <?php if(isset($_POST['speed']) && $_POST['speed'] == '65') echo 'selected="unselected"';?>
            >65mph</option>

            <option value="70"
            <?php if(isset($_POST['speed']) && $_POST['speed'] == '70') echo 'selected="unselected"';?>
            >70mph</option>

            <option value="75"
            <?php if(isset($_POST['speed']) && $_POST['speed'] == '75') echo 'selected="unselected"';?>
            >75mph</option>
        </select>

        <input type="submit" value="Calculate">
        <input type="reset" value="Reset" name="reset">
</fieldset>
</form>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(empty($_POST['name'])) {
            echo '<span class="error">Please fill out your name</span>';
        }

        if(empty($_POST['miles'])) {
            echo '<span class="error">Please fill out your miles</span>';
        }

        if(empty($_POST['idealhours'])) {
            echo '<span class="error">Please fill out your desired driving hours</span>';
        }

        if(empty($_POST['price'])) {
            echo '<span class="error">Please fill out your price per gallon</span>';
        }

        if($_POST['fuel'] == NULL){
            echo '<span class="error">Please choose your fuel efficiency</span>';
        }

        if($_POST['speed'] == NULL){
            echo '<span class="error">Please choose your speed</span>';
        }
            
        if(isset(
            $_POST['name'],
            $_POST['miles'],
            $_POST['idealhours'],
            $_POST['price'],
            $_POST['speed'],
            $_POST['fuel']) && 
            is_numeric($_POST['fuel']
        )) {
            $name = $_POST['name'];
            $miles = $_POST['miles'];
            $idealhours = $_POST['idealhours'];
            $price = $_POST['price'];
            $fuel = $_POST['fuel'];
            $speed = $_POST['speed'];

            $gallons = $miles / $fuel;

            $totalcost = $price * $gallons;

            $friendly_totalcost= number_format($totalcost,2);

            $totaltime = $miles / $speed;
            $friendly_totaltime = floor($totaltime);

            $days = $totaltime / $idealhours;
            $friendly_days = round($days, 2);

            echo '
            <div class="box">
            <h2>Results</h2>
            <p><b>'.$name.'</b>, you will be driving: <b>'.$miles.' miles</b></p>
            <p>Your vehicle has an efficiency rating of: <b>'.$fuel.' miles per gallon</b></p>
            <p>Your total cost for gas will be: <b>$'.$friendly_totalcost.' dollars</b></p>
            <p>You will be driving a total of <b>'.$friendly_totaltime.' hours</b> equating to <b>'.$friendly_days.' days</b>.
            </div>
            ';
        }
    } // end of server request

?>
</body>
</html>