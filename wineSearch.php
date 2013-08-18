<?php
$searchResult = "";
if(isset ($_POST['WineName']) && $_POST['WineName'] != ""){
          $WineName = preg_replace('#[^a-z 0-9]#i','',$_POST['WineName']);
          $sqlCommand = "SELECT wine_name From wine WHERE wine_name LIKE '%$WineName%'";
          
          include_once("connect.php");//requesting to open the database
          $query = mysql_query($sqlCommand) or die(mysql_error());
          $count = mysql_num_rows($query);
          if($count > 1){
            $searchResult .= "$count results for $WineName $sqlCommand";
            while($row = mysql_fetch_array($query)){
              $wName = $row["wine_name"];
              $searchResult .= "Wine Name: $wName<br />";
            }//close while
          }else { $searchResults = "0 results for $WineName $sqlCommand";
           }
          
}
          
?>
<html>
<head>
<title>Wine Search Directory</title>
</head>

<body>
<form action="wineSearch.php" method="POST">
<font size="+2">Wine Name:</font><input type="text" name="WineName"/>
<br />
<input type="submit" name="searchButton" />
</form>
<br />
<?php echo $searchResult; ?>
</body>
</html>
