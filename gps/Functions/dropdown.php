<?php

    include_once("DBInteractor.php");

    
    $sql = "SELECT username FROM blog_users";
    $rs = mysql_query($sql) or die(mysql_error());
	?>



    <?php
    if (isset($_POST['Search']))
    {
    $userselect = $_POST['username'];
    echo $userselect;
	
	$sql1 = 'SELECT * FROM current_location WHERE username LIKE "%'.$userselect.'%"';
        $result = mysql_query($sql1);
		$r=mysql_num_rows($result);
	

        if (mysql_num_rows($result) > 0) 
            {
                while($row = mysql_fetch_array($result)) 
                    {
                        //$latitude= $row["lat"];
                        //$longitude= $row["lon"];
						
                    }
	
	
    }
	
	
	}
    ?>
<script>
function showUser(str){

var e = document.getElementById("user");
var str = e.options[e.selectedIndex].text;
alert(str)

}

</script>
	
<form  method='post'>
	
    <select id="user" name=username onchange="showUser(this.value)">
	<option value="">Select a person:</option>
	<?php
    while($row = mysql_fetch_array($rs)){
    echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
    }mysql_free_result($rs);
	?>
    </select>
	
	<input type="submit" name="Search"  value="Search"/>

</form>


	