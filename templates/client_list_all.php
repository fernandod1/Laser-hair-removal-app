<table class="table table-hover">
<thead>
<tr>
    <th scope="col">Alta</th>
    <th scope="col">Cliente</th>
    <th scope="col">Detalles</th>
</tr>
</thead>
<tbody>
<? foreach($data as $one){ 
    extract($one); 
?>
<tr> 
    <td width=90px><small><?php echo $dateadded;?></small></td>
    <td><?php echo $lastname;?>, <?php echo $name;?></td>
    <td><a class="btn btn-outline-primary btn-sm" href="orders.php?op=view&cid=<?php echo $id;?>" role="button">Ficha</a>
    </td>
</tr>
<?php } ?>
</tbody>
</table>