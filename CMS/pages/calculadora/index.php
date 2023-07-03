<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$pdo =  pdo_connect_mysql();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="script.js"></script>
    <title>Document</title>
</head>
<body>
<label for="base_salary">Base Salary</label>
<input type="number" id="base_salary" placeholder="Enter Base Salary" required/>

<label for="meal_allowance">Meal Allowance</label>
<select name="meal_allowance" id="meal_allowance" required>
    <option value="no_allowance">No meal allowance</option>
    <option value="card">Meal Card</option>
    <option value="money">Money</option>
</select>

<label for="meal_allowance_amount">Meal Allowance Amount</label>
<input
        required
        type="number"
        id="meal_allowance_amount"
        placeholder="Enter Meal Allowance Amount"
        value="0"
        
/>
<div>
    <label for="meal_days">How many days did you work?</label>
    <input
            required
            type="number"
            id="meal_days"
            placeholder="Enter Meal Days"
            value="0"
    />
</div>

<button id="calculate">Calculate</button>

<p>Your gross salary is: <span id="gross_salary"></span></p>
<p>The taxes you pay are: <span id="taxes"></span></p>
<p>The ammout you receive as meal allowance: <span id="meal_allowance_value"></span></p>
<p>Meal allowance that is taxed: <span id="meal_allowance_taxed"></span></p>
<p>IRS tax: <span id="descontos_irs"></span></p>
<p>SS tax: <span id="descontos_ss"></span></p>
<p>Your net salary is: <span id="net_salary"></span></p>
</body>
</html>
