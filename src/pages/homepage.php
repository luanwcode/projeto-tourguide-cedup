<?php
  include("../config/connect.php");
  $sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
  $query = mysqli_query($connect, $sql_query);//Resultado
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="../assets/css/homepage.css" rel="stylesheet">
  <title>Tourguide!</title>




</head>
<body>
  <div class="layout">  
      <aside>
        <?php
          include("../includes/sidebar.php");
        ?>
      </aside>

      <main class="content">
        <h1>Choose your destiny</h1>
        <div class="spots-grid">
        <?php
            if (mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                echo 
                '
                <div class="spots-card" data-bg="'.$row['picture'].'">
                    <img src='.$row['picture'].' class="spots-img" />
                    <div class="spots-info">
                        <div class="spots-name">'.$row['name'].'</div>
                        <div class="spots-price">'.$row['city'].', '.$row['state'].', '.$row['country'].'</div>
                        <a href="spot.php?spot='.$row['id_spot'].'" 
                        <button class="see-info" style="text-decoration: none;">See info</button>
                        </a>
                    </div>
                </div>
                ';
            }
            }else{
            echo "No spots found";
            }
        ?>
      </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const cards = document.querySelectorAll('.spots-card');

        //console.log('cards:', cards.length);


        cards.forEach(card => {
          card.addEventListener('mouseenter', () => {
            const bg = card.dataset.bg;
            document.body.style.backgroundImage = `url(${bg})`;

            
            document.body.classList.add('hovered');
            document.body.classList.remove('unhovered');
            

            console.log('hovered');
          });

        card.addEventListener('mouseleave', () => {
          document.body.style.backgroundImage = 'none';
          
          document.body.classList.remove('hovered');
          document.body.classList.add('unhovered');
          

          console.log('unhovered');
        });
      });
    }); 
  </script>
  
</body>
</html>   