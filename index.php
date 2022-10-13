<?php
  require_once('database.inc.php');
  require_once("functions.php");
  //print_r($_POST); //print de post array van de user input
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">

    </script>

</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        Type event

        <?php
      $results = getEventOptions();
      $selectbox = createSelect($results, "event");
      echo $selectbox;
    ?>

        <label for="start">date</label>
        <input type="date" id="start" name="date" value="" min="2022-01-01" max="2023-12-31">

        time<input type="time" name="time">
        end<input type="time" name="end">

        <input type="submit" name="saved" value="voeg toe" />
    </form>

    <?php
if(isset($_POST['saved'])){
      if($_POST['saved']=='voeg toe')
      {
          $uuid = createUuid();
          $event = $_POST['event'];
          $date = $_POST['date'];
          $time = $_POST['time'];
          $end = $_POST['end'];

          $sql = "INSERT INTO planning (uuid, event, date, time, end, others, status) VALUES (?,?,?,?,?,?,?)";

          $data = array($uuid, $event, $date, $time, $end, "", 1); //Just an example

          $result = Database::getData($sql, $data);

          if($result == true)
          {
              $_SESSION['status'] = "Inserted Succesfully";
              header("Location: index.php");
          }
          else
          {
              $_SESSION['status'] = "Not Inserted";
              header("Location: index.php");
          }
      }
    }

       $sql = "SELECT * FROM planning";
       $data = array(); //Just an example
       $result = Database::getData($sql);
       foreach($result as $key => $row) {
          
          $id = $row['event'];
          $event = getEvent($id);

          echo $event;
          echo  " | "; 
          echo $row['date'];
          echo  " | "; 
          echo $row['time'];
          echo  " / ";
          echo $row['end'];
          echo "<br />";

          $from = '10:45:00';
          $to = '00:00:00';
          // werkt nog niet volledig

          $from = '14:46:00';
          $to = '15:46:00';

          $from = '13:47:00';
          $to = '00:00:00';

          $from = '11:46:00'; 
          $to = '00:00:00';

          $from = '15:45:00'; 
          $to = '00:00:00';

          $from = '12:37:00'; 
          $to = '14:35:00';

          $from = '14:30:00'; 
          $to = '15:30:00';

          $total      = strtotime($to) - strtotime($from);
          $hours      = floor($total / 60 / 60);
          $minutes    = round(($total - ($hours * 60 * 60)) / 60);

          //telt uren nog niet op

          echo $hours.'.'.$minutes;

            
            
          
        }
     ?>
</body>
</html>