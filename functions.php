<? 

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function isPositiveValue($value){
    return ((int)$value == $value && (int)$value > 0);
}

function paginate($connection,$page,$type,$word = null){
  $limit = 10;
  $adjacents = 1;
  if($type=="all")
    $total_rows = $connection->numRows("SELECT id FROM clients");
  else if ($type=="search")
    $total_rows = $connection->numRows("SELECT id FROM clients WHERE lastname LIKE '%".$word."%'  ");
  
  $total_pages = ceil($total_rows / $limit);     
  if(isset($page) && $page != "") {      
    $offset = $limit * ($page-1);
  } else {
    $page = 1;
    $offset = 0;
  }
  if($total_pages <= (1+($adjacents * 2))) {
      $start = 1;
      $end   = $total_pages;
  } else {
      if(($page - $adjacents) > 1) { 
          if(($page + $adjacents) < $total_pages) { 
            $start = ($page - $adjacents);            
            $end   = ($page + $adjacents);         
          } else {             
            $start = ($total_pages - (1+($adjacents*2)))+1;  
            $end   = $total_pages;               
          }
      } else {               
          $start = 1;                                
          $end   = (1+($adjacents * 2));             
      }
  }
  if($total_pages > 1) {
    echo "<nav aria-label='Page navigation'>";
    echo "<ul class='pagination justify-content-center'>\n";
    echo "<!-- Link of the first page -->\n";
    echo "<li class='page-item ";
    ($page <= 1 ? print 'disabled' : '');
    echo "'>\n";
    echo "<a class='page-link' href='clients.php?page=1'><<</a>\n";
    echo "</li>\n";
    echo "<!-- Link of the previous page -->\n";
    echo "<li class='page-item ";
    ($page <= 1 ? print 'disabled' : '');
    echo "'>\n";
    echo "<a class='page-link' href='clients.php?page=";
    ($page>1 ? print($page-1) : print 1);      
    echo "'><</a>\n";
    echo "</li>\n";
    echo "<!-- Links of the pages with page number -->";      

    for($i=$start; $i<=$end; $i++) { 
      echo "<li class='page-item ";
      ($i == $page ? print 'active' : '');
      echo "'>";
      echo "<a class='page-link' href='clients.php?page=$i'>$i</a>";
      echo "</li>";
    } 

    echo "<!-- Link of the next page -->\n";
    echo "<li class='page-item ";
    ($page >= $total_pages ? print 'disabled' : '');
    echo"'>\n";
    echo "<a class='page-link' href='clients.php?page=";
    ($page < $total_pages ? print($page+1) : print $total_pages);
    echo "'>></a>\n";
    echo "</li>\n";
    echo "<!-- Link of the last page -->\n";
    echo "<li class='page-item ";
    ($page >= $total_pages ? print 'disabled' : '');
    echo "'>\n";
    echo "<a class='page-link' href='clients.php?page=$total_pages'>>>\n";
    echo "</a>\n";
    echo "</li>\n";
    echo "</ul>";
    echo "</nav>";
  } 
  return $offset;
}




?>