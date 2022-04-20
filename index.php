<!DOCTYPE html>
<html>
    <?php
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=baseprojet', 'root' ,'root');

$page = $_SERVER['PHP_SELF'];
$sec = "6";
?>
    <head>
   <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <title>Cours PHP & MySQL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="cours.css">
    </head>
    <body>
        <h1>Dernière distance calculée </h1>
        <?php    
            
            $res = fopen('C:\Users\33754\Desktop\data.txt', 'rb');  
            /*Tant que la fin du fichier n'est pas atteninte, c'est-à-dire
             *tant que feof() renvoie FALSE (= tant que !feof() renvoie TRUE)
             on echo une nouvelle ligne du fichier*/
            // while(!feof($res)){
            //     $ligne = fgets($res);
              	
            // }
            $tab = file('C:\Users\33754\Desktop\data.txt');
            $der_ligne = $tab[count($tab)-1];
            $today = date("H:i:s");
            $conn = $pdo->query("INSERT INTO data VALUES ('".$der_ligne."', '".$today."') ");
          
           
            $heur  = date("H") -1;
        ?>
        <h1><?php echo $der_ligne?></h1>  
        
        <?php
            $php_data_array = Array();
           $conn = $pdo->query("select * from  data");
           $conn->setFetchMode(PDO::FETCH_NUM);
      
            foreach ($conn as $row) {
             $php_data_array[] = $row; // Adding to array
        }
            echo "<script> var my_2d = ".json_encode($php_data_array)."  </script>";
            
            // $conn = $pdo->query("DELETE  from data  ");
?>
          <h1><?php //var_dump($date);
          //echo json_encode($php_data_array);?></h1>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
       
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
     function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'valeur');
         
          for(i = 0; i < my_2d.length; i++)
        data.addRow([my_2d[i][1], parseInt(my_2d[i][0])]);
    
         var options = {
          title: 'variation distance',
        curveType: 'function',
		width: 1000,
        height: 500,
          legend: { position: 'bottom' }
        };
         
          var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
         chart.draw(data, options);
         }
	///////////////////////////////
</script>
         
         <div id="curve_chart"></div>
         
         
         
         
         
         
         
         
    </body>
</html>