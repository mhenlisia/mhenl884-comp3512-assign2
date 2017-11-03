<?php 
require_once('config.php');
function outputBooks() {
   try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select BookID, ISBN10, Title, CopyrightYear, SubcategoryID, ImprintID, CoverImage from Books order by Title limit 0, 20";
        $result = $pdo-> query ($sql);
        while ($row = $result->fetch()) {
             echo '<a href="/single‐book.php?book='. $row['ISBN10'] . '" class="';
             //echo '<a href="' . $SERVER["SCRIPT_NAME"] . '?book=' . $row['ISBN10'] . '" class="';
        if (isset($_GET['book']) && $_GET['book'] == $row['BookID']) echo 'active';
            echo 'item">';
            echo "<img src ='/book-images/tinysquare/". $row['ISBN10']. ".jpg'>". " ". $row['Title']. " ". $row['CopyrightYear']. " ". $row['SubcategoryID']. " ". $row['ImprintID'] . '</a>';
            echo '<br>';
         }
         $pdo = null;
   } 
   catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Browse Books</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  </head>
  <body>
      <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
              <?php include 'includes/header.inc.php'; ?>
              <?php include 'includes/left-nav.inc.php'; ?>
   
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">

            <div class="mdl-grid">

              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp" style="width:auto;">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Books</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">

                         <?php  
                              outputBooks();
                         ?>            
                
                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
            </div>  <!-- / mdl-grid -->    

        </section>
    </main>    
</div>    <!-- / mdl-layout --> 
  </body>
    
</html>