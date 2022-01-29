<div id='main'>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>


    <h1>News Section</h1>
    <form id='insertForm'>
        <input type="text" name="Title" placeholder="Title for Article">
        </br>
        <input type="text" name="text" placeholder="Text for article">
        </br>
        <input type="submit" value="Add Article">
    </form>
    </br>
    <h1>Search News</h1>
    <form id='searchForm'>
        <input type="text" name="search" placeholder="Search for Article">
        </br>
        <input type="submit" value="Search">
    </form>
    </br>
    <h1>Table Data</h1>
    <div id='tabledata'>
        <table>
            <tr>
                <th>Id</th>
                <th>News</th>
                <th>Text</th>
                <th>Action</th>
            </tr>
            <?php foreach ($results as $row) : ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><input type="text" name="news" value="<?= $row->title ?>"></td>
                    <td><input type="text" name="text" value="<?= $row->text ?>"></td>
                    <td><button id="edit">Edit</button><br /><button id="delete">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#insertForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>News/setNews',
                type: 'POST',
                data: $('#insertForm').serialize(),
                success: function(data) {
                    console.log(data);
                    $("#tabledata").load(location.href + " #tabledata");
                }
            });
        });
    });

    $(document).ready(function() {
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>News/searchNews',
                type: 'POST',
                data: $('#searchForm').serialize(),
                success: function(data) {
                    console.log(data);
                    $("#main").html(data);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#tabledata').on('click', '#edit', function() {
            var id = $(this).closest('tr').find('td:first').text();
            var news = $(this).closest('tr').find('td:nth-child(2) input').val();
            var data = $(this).closest('tr').find('td:nth-child(3) input').val();
            $.ajax({
                url: '<?php echo base_url(); ?>News/updateNews',
                type: 'POST',
                data: {
                    id: id,
                    news: news,
                    data: data
                },
                success: function(data) {
                    console.log(data);
                    $("#tabledata").load(location.href + " #tabledata");
                }
            });
        });
    });

    $(document).ready(function() {
        $('#tabledata').on('click', '#delete', function() {
            var id = $(this).closest('tr').find('td:first').text();
            console.log(id);
            $.ajax({
                url: '<?php echo base_url(); ?>News/deleteNews',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $("#tabledata").load(location.href + " #tabledata");
                }
            });
        });
    });
</script>