<?php
session_start();
include("../config/connect.php");

$nameUser = $_SESSION['name'] ?? 'Guest';

$sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, t.type, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
$query = mysqli_query($connect, $sql_query);
?>

<!-- SEARCH FIELD PHP -->
<?php
/*
  $search = $_REQUEST['search'];

  //Receives the typed values at the 'search' variable
  if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
    $search = $_REQUEST['search'];
  }

  //Verifies if there is any term at the 'Search' field
  if ($search == "") {
    $sql_search = "SELECT id_spot, name, city, state, country, type FROM tourist_spot ORDER BY city";
    $query = mysqli_query($connect, $sql_search);
    $cont = mysqli_num_rows($query);
  } else {
    $sql_search = "SELECT * FROM tourist_spot WHERE city LIKE '%$search%' ORDER BY city";
    $query = mysqli_query($connect, $sql_search);
    $cont = mysqli_num_rows($query);
  }

  //Message showing the results
  if ($cont == 1 && $search == "") {
    $msg = "<b>$cont</b> register was found on the database.";
  } else if ($cont > 1 && $search == "") {
    $msg = "<b>$cont</b> registers where found on the database";
  } else if ($cont == 1 && $search != "") {
    $msg = "<b>$cont</b> register where found on the database with: b>$search</b>.
          <a href='client_list.php'>
            <button class='btn btn-secondary'>
              Limpar
            </button>
          </a>";
  } else {
    $msg = "<b>$cont</b> register where found on the database, with: <b>$search</b>.
          <a href='client_list.php'>
            <button class='btn btn-secondary'>
              Limpar
            </button>
          </a>";
  }
*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../assets/css/homepage.css" rel="stylesheet">
  <title>Tourguide!</title>
</head>

<body>
  <div class="layout">
    <aside>
      <?php
      include("../includes/fonts.php");
      include("../includes/sidebar.php");
      ?>
    </aside>

    <main class="content">
      <h1>Hello <?php echo $nameUser; ?>, choose your destiny</h1>

      <div class="row">
        <div class="col">
          <h3>
            Search for spots
          </h3>
        </div>
        <div class="col-md-auto">
          <form method="get" class="formsearch" action="">
            <div class="col-md-auto">
              <div class="input-group">
                <input class="form-control" type="search" name="search" placeholder="" aria-label="Search"
                  style="border-right: none;">
                <div class="input-group-append">
                  <i class="fas fa-search"></i>
                </div>
                <input class="btn btn-secondary" type="submit" value="Search">
              </div>

              <small class="form-text" style="color:white;">
                Type a city, state or country to search for spots
              </small>
            </div>
          </form>
        </div>
      </div>

      <div class="spots-grid">
        <?php
        if (mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_assoc($query)) {
            echo
              '
                <div class="spots-card" data-bg="' . $row['picture'] . '">
                    <img src=' . $row['picture'] . ' class="spots-img" />
                    <div class="spots-info">
                        <div class="spots-name">' . $row['name'] . '</div>
                        <div class="spots-price">' . $row['city'] . ', ' . $row['state'] . ', ' . $row['country'] . '</div>
                        <div class="spots-type">' . $row['type'] . '</div>
                        <a href="spot.php?spot=' . $row['id_spot'] . '"
                        <button class="see-info" style="text-decoration: none;">See info</button>
                        </a>
                    </div>
                </div>
                ';
          }
        } else {
          echo "No spots found";
        }
        ?>
    </main>
  </div>

  <!--
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
  -->

</body>

</html>