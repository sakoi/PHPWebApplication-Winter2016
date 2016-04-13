<?php  ob_start();
// authentication check
require_once ('auth.php');
// set page title and embed header
$page_title = null;
$page_title = 'Video Game Listings';
require_once('header.php'); ?>

<!-- facebook -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


    <h1>Video Games</h1>
    <script src="sorttable.js"></script>

<!-- keyword -->
<div class= "col-sm-12 text-right">
    <form action="gametable.php" method="get" class="form-inline">
        <lable for="keywords">Keywords</lable>
        <input name="keywords" id="keywords" />
        <select name="type" id="type">
            <option value="OR">Any Keyword</option>
            <option value="AND">All keywords</option>
        </select>
        <button class="btn btn-primary">Search</button>
    </form>
</div>

<?php
// add an error handler in case anything breaks
//try {
    // connect
    require_once('db.php');


    // write the query to fetch the game data
    $sql = "SELECT * FROM game";

    //check for keywords
    $final_keyword = null;
    if(!empty($_GET['keywords'])){
        $keywords = $_GET['keywords'];

     //covert keyowrds into array
        $word_list = explode(" ",$keywords);
        //start where clase
        $sql .= " WHERE ";
        $where = "";
        $counter = 0; // multi ways to do this

        //check for or/add
        $type =$_GET['type'];


        //loop througt the array
        foreach($word_list as $word){

            if($counter > 0){
                $where .= " $type ";
            }

            $where .="name LIKE ?";
            $word_list[$counter] = '%'. $word. '%';
            $counter++;

        }

        $sql .= $where;
    }//end not empty

    // add order by
    $sql.= " ORDER BY name;";
//test sql statment
//echo $sql;

    // run the query and store the results into memory
    $cmd = $conn->prepare($sql);
    $cmd->execute($word_list);
    $games = $cmd->fetchAll();
    // start the table and add the headings
    echo '<table  class="sortable table table-striped table-hover"><thead>
        <th><a href="#">Name</a></th>
        <th><a href="#">Age Limit</a></th>
        <th><a href="#">Release Date</a></th>
        <th><a href="#">Size</a></th>
        <th>Edit</th>
        <th>Delete</th></thead><tbody>';
    /* loop through the data, creating a new table row for each game
    and putting each value in a new column */
    foreach ($games as $game) {
        echo '<tr><td>' . $game['name'] . '</td>
            <td>' . $game['age_limit'] . '</td>
            <td>' . $game['release_date'] . '</td>
            <td>' . $game['size'] . '</td>
            <td><a href="game.php?game_id=' . $game['game_id'] . '">Edit</a></td>
            <td>
            <a href="delete-game.php?game_id=' . $game['game_id'] .
            '" onclick="return confirm(\'Are you sure?\');">
                Delete</a></td></tr>';
    }
    // close the table
    echo '</tbody></table>';
    // disconnect
    $conn = null;
?>
<!-- html -->
    <div class="fb-comments" data-href="http://gc200321034.computerstudi.es/comp1006/week12/gametable.php" data-width="1150" data-numposts="5"></div>

<?php
//catch (Exception $e) {
    // send ourselves an email
  //  mail('georgian2015@hotmail.com', 'Games Listing Error', $e);
    // redirect to the error page
   // header('location:error.php');
//}
// embed footer
require_once('footer.php');
ob_flush();
?>