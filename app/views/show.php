<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <link rel="stylesheet" href="<?=base_url();?>public/css/style.css">
</head>
<body>
    <div class="search-container">
        <form action="<?=site_url('user/show');?>" method="get" class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary" type="button">Search</button>
	</form>
</div>
    <h1>💥🎯Valorant Table View🎯💥</h1><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php foreach($all as $user):?>
            <tr>
                <td><?=$user['id'];?></td>
                <td><?=$user['username'];?></td>
                <td><?=$user['email'];?></td>
                <td><?=$user['role'];?></td>
                <td>
                    <a href="<?=site_url('user/update/'.$user['id']);?>">Update</a>
                    <a href="<?=site_url('user/delete/'.$user['id']);?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <?php
	echo $page;?>
    <a href="<?=site_url('user/create')?>">Create Record</a>
</body>
</html>
