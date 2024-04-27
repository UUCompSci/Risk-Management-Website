<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="Windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/MainPage.css">
        <link rel="stylesheet" href="">
        <title></title>
    </head>
    <body>
        <nav>
            <!--Divides the Header from the rest of the page-->
            <div class = "heading">Risk Management Project</div>
            <!--Span is used for making space at the top-->
            <!--On User click, it opens the Navigation Bar-->
            <span class = "topMenuButton"
                onClick = "openNavBar()">
            </span>
            <!--Creation of the Navigation bar at the top-->
            <div class = "navbar">
                <ul>
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/FAIR-Model.html">FAIR Model</a></li>
                    <li><a href="/AboutMe.html">About Me</a></li>
                </ul>
            </div>
        </nav>
        <center>

        <br><br>
        <form action="index.php" method="post">
                <label>Choose an industry from this list:</label>
                <select name="Organization_Type" id="Organization_Type">
                    <option value="Academic">Academic</option>
                    <option value="Financial">Financial</option>
                    <option value="Gaming">Gaming</option>
                    <option value="Government">Government</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Retail">Retail</option>
                    <option value="Tech">Tech</option>
                    <option value="Web">Web</option>
                  </select>
                <br><br>

                <label>Choose a Methodology:</label>
                <select name="Method" id="Method">
                    <option value="Accidentally Published">Accidentally Published</option>
                    <option value="Hacked">Hacked</option>
                    <option value="Inside Job">Inside Job</option>
                    <option value="Tech">Tech</option>
                    <option value="Security">Security</option>
                </select>
                
                <br><br>
                
                <input type="submit" value="Query" name="Query_Button">
            </form>

            <?php
            if($_POST["Query_Button"]){
            // Connect to the database 
            //echo "POST <BR>";
 
            //$db = new mysqli("localhost","u736344464_RiskManagement","u736344464_Admin","Thomasyp22$");
            try {
             $db = mysqli_connect("localhost","u736344464_Admin","Thomasyp22$","u736344464_RiskManagement");
            } catch( Exception $e ) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            
            if(!$db) {
                echo "No DB Connection: " . mysqli_connect_error();
            } 
 
// Check if the connection was successful 

 
// Execute the query 
try {

// Get the form data 
$organization_Type = $_POST["Organization_Type"]; 
$method = $_POST["Method"]; 

//echo $organization_Type;

//echo $method;
 
//Grab the data from the table
//$sql = "SELECT * FROM rmp_1_dataset WHERE Organization_Type = 'Academic' AND Method = 'Accidentally Published';";
$sql = $db->prepare("SELECT * FROM rmp_1_dataset WHERE Organization_Type=? AND Method=?");

$sql->bind_param("ss", $organization_Type, $method);

//echo $sql;  

   //$result = $db->query($sql);
   $sql->execute();
   $result = $sql->get_result();
   
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// Check if the query was successful 
echo "Rows Found of $organization_Type Industry and $method methodology:  " . $result->num_rows . "<BR><BR><BR>";


if ($result->num_rows > 0) {

    while($row = $result->fetch_array()){
        
        //table set up (Label and Result are in the same box)
        echo "<table border=1 cellspacing=3 cellpadding=3>
        
        <tr><th>ID</th>
        <th>Company</th>
        <th>Year</th>
        <th>People_Affected</th>
        <th>Organization_Type</th>
        <th>Method</th></tr>
        
        <tr><td>$row[ID]</td>
        <td>$row[Company] </td>
        <td>$row[Year] </td>
        <td>$row[People_Affected] </td>
        <td>$row[Organization_Type] </td>
        <td>$row[Method]</td></tr>
        </table>";
    }
}
    else {
        echo "0 results";
    }

}
        ?>
        <footer>
            <div class = "footer">
                <span>
                    Created By Sterling Proctor
                </span>
            </div>
           </footer>
    </body>
</html>