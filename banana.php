<html>
<p>This is Jason's Raspberry pi server</p>
<p>Welcome!</p>
<?php
echo "Hello World!";
?>  
<br/>


<!--
 <form action="action_page.php" method="GET">
  What do you want to search for? <input type="text" name="input">
	<select>
		<option value="pokemonNumber">ID number</option>
		<option value="name">Name</option>
		<option value="weight">Weight</option>
		<option value="height">Height</option>
		<option value="type">Type</option>
		<option value=""></option>
	</select>
  <br>
  Last name:<br>
  <input type="text" name="lastname" value="Mouse">
  <br><br>
  <input type="submit" value="Submit">
</form> 
-->


<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Tyrus123";
$db = "pokemon";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
<br/>
<?php

$sql = "SELECT * FROM test";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        
		//get the id so i can find the image for the corresponding pokemon
		$id = $row["pokemonNumber"];
		
		//all png images need to be in 3 digit format
		//handles id's numbered 1-9
		if(strlen($id) < 2){
			$id = "00" . $id;
		}
		//handles id's numbered 10-99
		if(strlen($id) < 3){
			$id = "0" . $id;
		}
		
		//get the image url into the id var
		$id='/PokemonImages/'.$id.'.png';
		
		
		?>
		<br/>
		<img src=<?=$id?> alt="<?=$row["name"]?>"/>
		<p>
		Pokedex Number: <?=$row["pokemonNumber"]?><br/>
		Name: <?=$row["name"]?><br/>
		Weight: <?=$row["weight"]?> lbs.<br/>
		Height: <?=$row["heightFeet"]?>'<?=$row["heightInches"]?>"<br/>
		Type: <?=$row["pokeType"]?><br/>
		Ability: <?=$row["ability"]?><br/>
		Description: <?=$row["description"]?><br/>
		
		<!--
		<?=$row["evolutionStatus"]?><br/>
		<?=$row["familyNumber"]?><br/>
		-->
		
		
		<?php
			//makes type plural if a second type exists
			if(($row["type2"] != '')){
				?>
				Types: <?=$row["type1"]?>, <?=$row["type2"]?> 
				<?php
			} else {
				?>
				Type: <?=$row["type1"]?>
				<?php
			}
		?>
		
		<?php
		//finds the baby pokemon id
		/*
		while($row["evolutionStatus"] != 1){
			$seekingID = $pokemonNumber - 1;
			find it with something like
			select * from test where familyNumber = <?=$row["familyNumber"]?> and evolutionStatus == 1;
		}
		*/		
		?>
		<p>I belong to the
		<?php
		if($row["familyNumber"] % 10 == 1){
			?>
			<?=$row["familyNumber"]?>st
			
			<?php
		} else if ($row["familyNumber"] % 10 == 2){
			?>
			<?=$row["familyNumber"]?>nd
			<?php
		} else if ($row["familyNumber"] % 10 == 3){
			?>
			<?=$row["familyNumber"]?>rd
			<?php
		} else {
			?>
			<?=$row["familyNumber"]?>th
			<?php
		}
		?>
		family in the Pokedex.</p>
		<?php
		
		?>
		</p>
		<hr/>
		<?php
    }
} else {
    echo "Sorry I can't find this pokemon";
}
$conn->close();
?> 
</html>