<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <link rel="stylesheet" href="<?=base_url();?>public/css/style.css">
</head>
<body>
    <h1>💥🎯Valorant Table View🎯💥</h1><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php foreach(html_escape($users) as $user):?>
            <tr>
                <td><?=$user['id'];?></td>
                <td><?=$user['username'];?></td>
                <td><?=$user['email'];?></td>
                <td><?=$user['role'];?></td>
                <td>
                    <a href="<?=site_url('user/update/'.$user['id']);?>">Update</a>
                    <a href="<?=site_url('user/soft-delete/'.$user['id']);?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <a href="<?=site_url('user/create')?>">Create Record</a>
</body>
</html>
