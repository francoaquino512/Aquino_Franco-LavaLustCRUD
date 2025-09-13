<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url();?>public/css/style.css">
    <title>Update</title>
</head>
<body>
    <h1>💥🎯Valorant Update View🎯💥</h1>
    <form action="<?=site_url('user/update/'.$user['id'])?>" method="post">
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" value="<?=html_escape($user['username']);?>"><br>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="<?=html_escape($user['email']);?>"><br>
        <label for="role">Role</label><br>
        <input type="text" name="role" id="role" value="<?=html_escape($user['role']);?>"><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
