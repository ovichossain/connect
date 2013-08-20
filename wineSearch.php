<?php
$searchResult = "";
//or ($_POST['winery']) && $_POST['winery'] != "")

//if(isset ($_POST['WineName']) && $_POST['WineName'] != ""){
          //$WineName = preg_replace('#[^a-z]#i','',$_POST['WineName']);
          //$winery = preg_replace('#[^a-z]#i','',$_POST['winery']);
          //$sqlCommand = "(SELECT wine_name From wine WHERE wine_name LIKE '%$WineName%')";
          //UNION(SELECT winery_name From winery WHERE winery_name LIKE '%$winery%')";
          $arr = new array();
          if(!empty($_POST['WineName']))
          $arr[] = "wine_name LIKE '".$_POST['WineName']."'";
          if(!empty($_POST['winery']))
          $arr[] = "winery_name LIKE '".$_POST['winery']."'";
          
          $str = impode("and", $arr);
          if(!empty($str)) $str = "and ".$str;
          
          include_once("connect.php");//requesting to open the database
          $query = mysql_query("select * from WineSearchView where 1 $str") or die(mysql_error());
          $count = mysql_num_rows($query);
          if($count > 1){
            $searchResult .= "$count results for $WineName";
            while($row = mysql_fetch_array($query)){
              $wName = $row["wine_name"];
              $variety = $row["variety"];
              $year = $row["year"];
              $wineryName = $row["winery_name"];
              $region = $row["region_name"];
              $cost = $row["cost"];
              $stock = $row["on_hand"];
              $ordered = $row["qty"];
              //$Winery = $row["winery_name"];
              $searchResult .= "Wine Name: $wName, V: $variety, Y: $year, WN: $winery_name, R: $region, C: $cost, S: $stock, O: $ordered<br />";
            }//close while
          }else { $searchResults = "0 results for $WineName $sqlCommand";
           }
          
//}
          
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
