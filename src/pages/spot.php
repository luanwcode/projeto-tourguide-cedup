<?php
session_start();
include("../config/connect.php");

$spot = $_REQUEST['spot'];
$userRole = $_SESSION['role'] ?? null;
$userId = $_SESSION['id'];
$userPfp = $_SESSION['picture'];

$sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, t.description, t.latitude, t.longitude, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot WHERE t.id_spot = $spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
$query = mysqli_query($connect, $sql_query);

if (!$query) {
    die("Bugou porra: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="../assets/css/spot.css" rel="stylesheet">
    <title></title>

</head>

<body>

    <div class="layout">

        <aside>
            <?php
                include("../includes/fonts.php");
                include("../includes/sidebar.php")
            ?>
        </aside>

        <div class="container">

            <?php while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="spot">

                    <!-- LEFT - IMAGE -->
                    <div class="image-section">
                        <img src=<?php echo ' ' . $row['picture'] . ' '; ?> alt=<?php echo ' ' . $row['name'] . ' '; ?> >
                    </div>
                    <!-- RIGHt -TINFO -->
                    <div class="info-section">

                        <div class="spot-title">
                            <?php echo $row['name']; ?>

                            <?php if($userRole === 'admin'){
                                echo'
                                    <a href="spot_edit.php?spot='.$row['id_spot'].'" style="vertical-align: middle; color: black;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>
                                ';
                                }
                            ?>
                        </div>

                        <div class="description">
                            <?php echo $row['description']; ?>
                        </div>

                        <div class="coordinates">
                            Coordinates: <?php echo $row['latitude'], '   ', $row['longitude']; ?>
                        </div>

                        <div class="maps-location">
                            <h2>Location</h2>

                            <?php
                            $lat = $row['latitude'];
                            $lon = $row['longitude'];
                            ?>

                            <iframe width=420" height="240" style="border:0;" loading="lazy" allowfullscreen
                                src="https://www.google.com/maps?q=<?php echo $row['latitude'] . ',' . $row['longitude']; ?>&hl=pt-BR&z=15&output=embed">
                            </iframe>
                        </div>

                    </div>

                </div>
        </div>
        

        <div class="commentary">
            <div class="user-comment">

                <img 
                src="<?php echo $userPfp; ?>" 
                class="comment-avatar"
                alt="avatar"
                >

                <div class="comment-content">

                    <form class="post_comment" method="post" action="../actions/post_comment.php">
                        <textarea
                            class="comment-textarea"
                            placeholder="Add a comment..."
                            rows="1"
                            name="comment"
                            id="comment"
                        ></textarea>

                        <div class="comment-actions">
                            <button class="btn-cancel">Cancel</button>
                            <button type="input" class="btn-comment">Comment</button>
                        </div>

                        <input type="hidden" name="id_spot" value="<?= $row['id_spot'];?>">
                        <input type="hidden" name="userId" value="<?= $userId; ?>">
                    </form>

                </div>

            </div>
            <?php } ?>
        </div>

        <?php
            $sql_query = "SELECT c.id_comment, c.id_spot, c.id_user, c.comment, c.posted_at, MIN(u.name) as name, MIN(u.picture) as picture FROM comment_spot c LEFT JOIN users u ON c.id_user = u.id_user LEFT JOIN tourist_spot t ON c.id_spot = t.id_spot WHERE c.id_spot = $spot AND c.id_user = u.id_user GROUP BY c.id_comment, c.id_spot, c.id_user, c.comment, c.posted_at ORDER BY c.posted_at DESC";
            $comment_query = mysqli_query($connect, $sql_query);
            while($row = mysqli_fetch_assoc($comment_query))
            {
                echo '
                <div class="community-comment">
                    <div class="comment-body">

                        <div class="comment-header">
                            <img 
                                src="'.$row['picture'].'" 
                                alt="avatar"
                                class="comment-avatar"
                            >

                            <span class="comment-user">'.$row['name'].'</span>
                            <span class="comment-date"> <b>•</b> '.$row['posted_at'].'</span>

                        </div>

                        <div class="comment-text">
                            '.$row['comment'].'
                        </div>
                        <br>
                    </div>
                </div>';
            }
        ?>
    </div>
</body>

<script>
    const textarea = document.querySelector('.comment-textarea');

    textarea.addEventListener('input', () => {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    });
</script>

</html>