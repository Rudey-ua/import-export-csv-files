<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Import CVSs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

    <form action="/add" class="form-horizontal" method="post" enctype="multipart/form-data">
        <h4>Загрузите CSV файл</h4>
        <input type="file" required accept=".csv" name="csv">
        <button class="btn btn-success">Import</button>
    </form>


    <?php if(count($pageData['users']) > 0):?>
        <button id="view-button" style="display: block" class="btn btn-primary" value="Click" onclick="viewDiv()">View results</button>
    <?php endif;?>


    <table style="display: none" id="table-id" class="table_block">
        <thead>
            <tr>
                <th>UID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
            </tr>
        </thead>

        <?php if(count($pageData['users']) > 0):?>
            <?php foreach ($pageData['users'] as $item): ?>
                <tr>
                    <td><?= $item['UID']?></td>
                    <td><?= $item['name']?></td>
                    <td><?= $item['age']?></td>
                    <td><?= $item['email']?></td>
                    <td><?= $item['phone']?></td>
                    <td><?= $item['gender']?></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>

        <?php if(count($pageData['users']) == 0):?>
            <h3>Table is empty</h3>
        <?php endif;?>

    </table>

    <?php if(count($pageData['users']) > 0):?>
        <form class="mt-2" id="export" style="display: none;" action="/download">
            <button class="btn btn-dark">Export to CSV</button>
        </form>

        <form action="/delete" class="form-horizontal" method="post">
            <button class="btn btn-danger">Clear all records</button>
        </form>
    <?php endif;?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/tablesort.min.js" integrity="sha512-F/gIMdDfda6OD2rnzt/Iyp2V9JLHlFQ+EUyixDg9+rkwjqgW1snpkpx7FD5FV1+gG2fmFj7I3r6ReQDUidHelA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../js/script.js"></script>

    </body>
</html>
