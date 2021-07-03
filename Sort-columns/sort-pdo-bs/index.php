<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenação de colunas com PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<?php
require_once 'conexao.php';

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('id', 'nome', 'email');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $pdo->query('SELECT * FROM clientes ORDER BY ' . $column . ' ' . $sort_order)) {
    // Some variables we need for the table.
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    ?>

    <!DOCTYPE html>
    <html>
        <head>
        <title>PHP & MySQL Table Sorting by CodeShack</title>
        <meta charset="utf-8">
        </head>
    <body>
    <div class="container">
    <br>
    <h1 class="text-center">Ordenação dos campos de uma tabela com PHP</h1>
    <hr>
    <table class="table table-striped table-sm table-bordered table-hover">
    <tr style="background:dark-gray">
    <th><a href="index.php?column=id&order=<?=$asc_or_desc?>">ID<i class="fas fa-sort<?=$column == 'id' ? '-' . $up_or_down : ''?>"></i></a></th>
    <th><a href="index.php?column=nome&order=<?=$asc_or_desc?>">Nome<i class="fas fa-sort<?=$column == 'nome' ? '-' . $up_or_down : ''?>"></i></a></th>
    <th><a href="index.php?column=email&order=<?=$asc_or_desc?>">E-mail<i class="fas fa-sort<?=$column == 'email' ? '-' . $up_or_down : ''?>"></i></a></th>
    </tr>
    <?php while ($row = $result->fetch()){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['email']; ?></td>
    </tr>
    <?php } ?>
    </table>
    </div>
  </body>
</html>
    <?php
    }
?>
<br>
<br>
Crédito - https://codeshack.io/how-to-sort-table-columns-php-mysql/
