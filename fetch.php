<?php
//fetch.php
$connect = mysqli_connect("127.0.0.1", "root", "", "common-database");
$output = '';

if(isset($_POST["query"])){
   $search = mysqli_real_escape_string($connect, $_POST["query"]);

   $query = "SELECT * FROM hashtag WHERE keyword LIKE '%".$search."%' OR Address LIKE '%".$search."%' ";
}
else{
   $query = "SELECT * FROM member WHERE pseudo LIKE '%".$search."%' ORDER BY pseudo";
}

$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0){
   $output .= '
      <div class="table-responsive">
         <table class="table table bordered">
            <tr>
               <th>#  ou  @</th>
            </tr>';

   while($row = mysqli_fetch_array($result)){
      $output .= '
            <tr>
               <td>'.$row["Address"].'</td>
            </tr>
         </table>
      </div>';
   }
   echo $output;
}
else{
   echo 'Data Not Found';
}

?>