<hr>
</div> <!-- End div container //-->
<script>
function ValidateSearchForm() {  
  var x, text = '';
  x = document.forms["mySearchForm"]["word"].value;
  if (x == "" || x.length < 4){
    text = "<font color=red>Error. Indique palabra +3 letras.</font>";
    document.getElementById("word").innerHTML = text;
    return false;
  }
}
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>