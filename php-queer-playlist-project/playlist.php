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
              foreach($pdo->query('SELECT * from playlist_queer') as $row) {
                    echo '<pre>';
                    print_r($row);
                    echo '</pre>';
                }
            sleep(5);
            $stmt = $pdo->prepare('SELECT * FROM playlist_queer');
            $stmt->execute();
            $pdo->query('SELECT pg_terminate_backend(pg_backend_pid());');
            $pdo = null;
            sleep(60);
            
          
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        ?>
        </div>

		</div>

	<! -- end content -->
<?php include("inc/footer.php"); ?>