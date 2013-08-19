<?php
$searchResult = "";
if(isset (($_POST['WineName']) && $_POST['WineName'] != "") or ($_POST['winery']) && $_POST['winery'] != "")){
          $WineName = preg_replace('#[^a-z]#i','',$_POST['WineName']);
          $winery = preg_replace('#[^a-z]#i','',$_POST['winery']);
          $sqlCommand = "(SELECT wine_name From wine WHERE wine_name LIKE '%$WineName%')UNION
          (SELECT winery_name From winery WHERE winery_name LIKE '%$winery%')";
          
          include_once("connect.php");//requesting to open the database
          $query = mysql_query($sqlCommand) or die(mysql_error());
          $count = mysql_num_rows($query);
          if($count > 1){
            $searchResult .= "$count results for $WineName, $winery $sqlCommand";
            while($row = mysql_fetch_array($query)){
              $wName = $row["wine_name"];
              $Winery = $row["winery_name"];
              $searchResult .= "Wine Name: $wName Winery Name: $Winery<br />";
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
<font size="+2">Winery   :</font><input type="text" name="winery" />
<br />
<input type="submit" name="searchButton" />
</form>
<br />
<?php echo $searchResult; ?>
</body>
</html>
