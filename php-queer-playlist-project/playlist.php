<?php
$pageTitle = "Playlist"; 
$section = "playlist";
?>

    <div class="section catalog random">

			<div class="wrapper">

				<h1><?php echo $pageTitle; ?></h1>
  <?php include("inc/header.php"); ?>
        <?php
        try {
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=sys', 'root', 'azul');
            $results = $pdo->query('select * from playlist_queer');
          } catch(Exception $e) {
          	echo $e->getMessage();
          	die();
          }

          $playlist = $results->fetchAll(PDO::FETCH_ASSOC);
             
        ?>

        	<ol>
        		<?php
        		foreach($playlist as $entry) {
        			echo '<li><i class="lens"></i>'.$entry["artist"]. ' - ' .$entry["song_title"].'</li>';
        		}
        		?>
        	</ol>

        </div>

		</div>

<?php include("inc/footer.php"); ?>