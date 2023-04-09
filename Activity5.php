<!DOCTYPE html>
<html>
<head>
	<title>Online currency calculator</title>
<style>
    input[type="submit"],
    input[type="text"],
    select {
        border-radius: 3px;
    }

</style>
</head>
<body>
<form method="POST" action="">
    
	<table>
        <caption><h2>Online Currency Calculator</h2></caption>
		<tr>
			<td><label>From:</label></td>
			<td><input type="text" name="amount" pattern="[0-9]+([\.,][0-9]+)?" required value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : ''; ?>"></td>
			<td><label>Currency:</label></td>
			<td>
				<select name="from_currency" required>
					<option value="USD" <?php if(isset($_POST['from_currency']) && $_POST['from_currency'] == 'USD') echo 'selected'; ?>>US Dollar (USD)</option>
					<option value="CAD" <?php if(isset($_POST['from_currency']) && $_POST['from_currency'] == 'CAD') echo 'selected'; ?>>Canadian Dollar (CAD)</option>
					<option value="EUR" <?php if(isset($_POST['from_currency']) && $_POST['from_currency'] == 'EUR') echo 'selected'; ?>>Euro (EUR)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label>To:</label></td>
			<td><label id="to_amount"><?php echo isset($converted_amount) ? $converted_amount : '0'; ?></label></td>
			<td><label>Currency:</label></td>
			<td>
				<select name="to_currency" required>
					<option value="USD" <?php if(isset($_POST['to_currency']) && $_POST['to_currency'] == 'USD') echo 'selected'; ?>>US Dollar (USD)</option>
					<option value="CAD" <?php if(isset($_POST['to_currency']) && $_POST['to_currency'] == 'CAD') echo 'selected'; ?>>Canadian Dollar (CAD)</option>
					<option value="EUR" <?php if(isset($_POST['to_currency']) && $_POST['to_currency'] == 'EUR') echo 'selected'; ?>>Euro (EUR)</option>
				</select>
			</td>
		</tr>
        <tr>
            <td colspan="4" align="right"><input type="submit" name="convert" value="Convert"></td>
        </tr>
	</table>
</form>


	<?php
    if(isset($_POST['convert'])) {
        $currency_rate = array(
            "USD" => array(
                "EUR" => 0.91,
                "CAD" => 1.36,
                "USD" => 1
            ),
            "CAD" => array(
                "USD" => 0.74,
                "EUR" => 0.68,
                "CAD" => 1
            ),
            "EUR" => array(
                "USD" => 1.10,
                "CAD" => 1.47,
                "EUR" => 1
            )
        );

        $amount = (float) $_POST['amount'];
        $from_currency = $_POST['from_currency'];
        $to_currency = $_POST['to_currency'];

        $currency_rate = $currency_rate[$from_currency][$to_currency];

        $converted_amount = $amount * $currency_rate;

        echo '<script>document.getElementById("to_amount").innerHTML = "'.$converted_amount.'";</script>';
        
    }
    ?>
</body>
</html>
