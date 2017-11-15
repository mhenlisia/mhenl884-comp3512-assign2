<?php 
include 'includes/book-config.inc.php';

try{
  $db = new ImprintsGateway($connection);
  $string = "";
  $string2 = "";
  $string3 = "";
  
  if(isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "select BookID, ISBN10, ISBN13, Title, CopyrightYear, TrimSize, PageCountsEditorialEst
      as PageCount, Description, Subcategories.SubcategoryID, SubcategoryName, ImprintID, Imprint, BindingType from Books join Subcategories on 
      (Books.SubcategoryID = Subcategories.SubcategoryID) join Imprints using (ImprintID) join BindingTypes using (BindingTypeID) where ISBN10 = '$id'";
      
      $sql2 = "select Authors.FirstName as AFirstName,
        Authors.LastName as ALastName, Authors.Institution as Institution 
        from Books join BookAuthors using (BookID) join Authors using (AuthorID)"; 
        
      $sql3 = "select Universities.Name as UName, UniversityID as ID, Adoptions.ContactID as ContactID, 
        Adoptions.AdoptionDate as AdoptionDate, Contacts.FirstName as FirstName, Contacts.LastName 
        as LastName, Contacts.Email as Email FROM Adoptions join Universities using (UniversityID) 
        join AdoptionBooks using (AdoptionID) join Contacts using (ContactID) where AdoptionBooks.BookID ='$id'";
    
      $result = $db-> runDifferentSelect($sql, "ISBN10", $_GET['id']);
      foreach($result as $row){
        $string .= printDetails($row);
      }
      $result2 = $db-> runDifferentSelect($sql2, "BookID", $id, 1);
      foreach($result2 as $row){
        $string2 .= printAuthors($row);
      }
      $result3 = $db-> runDifferentSelect($sql3);
      foreach($result2 as $row){
        $string3 .= printUniversities($row);
      }
  }

  
}
catch(PDOException $e) {
    die($e->getMessage());
}

function printDetails($rows){
  return "<h3>".$rows['Title']."</h3><img src ='/book-images/small/". $rows['ISBN10']. ".jpg'><br>ISBN10: " . $rows['ISBN10']."<br>ISBN13: " .
  $rows['ISBN13']."<br>Copyright Year: " . $rows['CopyrightYear']."<br><a href ='browse-books.php?Subcategory=" . $rows['SubcategoryName'] .
  "'>SubCategory: " . $rows['SubcategoryName']."</a><br><a href='browse-books.php?Imprint=" . $rows['Imprint'] . "'>Imprint: ". $rows['Imprint'].
  "</a><br>BindingType: ".$rows['BindingType']."<br>Trim Size: ".$rows['TrimSize']."<br>Page Count: ".$rows['PageCount'].
  "<br>Description: ".$rows['Description']."<br><br>";
}

function printAuthors($rows){
  return "<li>" . $rows['AFirstName']. " ". $rows['ALastName'] . "</li>";
  
}

function printUniversities($rows){
  return "<li><a href='browse-universities.php?id=" . $rows["ID"] . "'>" .  $rows['UName'] . "</li>";
}

  // <!-- Should be black but not yet -->
function makePageDim()
{
    document.write('<div id="dimmer" class="dimmer" style="width:'+
    window.screen.width + 'px; height:' + window.screen.height +'px"></div>');
    
}

/*function MouseDown($e)
{
    if (over)
    {
        if (isMozilla) {
            $objDiv = document.getElementById("dimmer");
            X=$e.layerX;
            Y=$e.layerY;
            return false;
        }
        else {
            $objDiv = document.getElementById("dimmer");
            $objDiv = objDiv.style;
            X=event.offsetX;
            Y=event.offsetY;
        }
    }
}

//
//
//
function MouseMove(e)
{
    if (objDiv) {
        if (isMozilla) {
            objDiv.style.top = ($e.pageY-Y) + 'px';
            objDiv.style.left = ($e.pageX-X) + 'px';
            return false;
        }
        else
        {
            objDiv.pixelLeft = event.clientX-X + document.body.scrollLeft;
            objDiv.pixelTop = event.clientY-Y + document.body.scrollTop;
            return false;
        }
    }
}

//
//
//
function MouseUp()
{
    objDiv = null;
}

//
//
//
function init()
{
    // check browser
    isMozilla = (document.all) ? 0 : 1;

    if (isMozilla)
    {
        document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP);
    }

    document.onmousedown = MouseDown;
    document.onmousemove = MouseMove;
    document.onmouseup = MouseUp;

    // add the div
    // used to dim the page
    makePageDim();

}*/

?>