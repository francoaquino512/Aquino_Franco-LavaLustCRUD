<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update</title>
  <style>
    :root {
      --primary: #006989;
      --primary-hover: #005a76;
      --bg: #eaebed;
      --card-bg: #ffffff;
      --text: #1a1a1a;
      --muted: #6b7280;
      --radius: 10px;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg);
      color: var(--text);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      font-size: 2rem;
      font-weight: bold;
      color: var(--primary);
      margin-bottom: 20px;
      letter-spacing: 1px;
    }

    form {
      background: var(--card-bg);
      padding: 30px;
      border-radius: var(--radius);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 400px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: var(--radius);
      background-color: #f9f9f9;
      color: var(--text);
      font-size: 1rem;
      transition: border 0.3s, box-shadow 0.3s;
    }

    input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 6px rgba(0, 105, 137, 0.2);
      outline: none;
      background-color: #ffffff;
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: var(--radius);
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: background 0.3s ease, transform 0.1s ease;
    }

    input[type="submit"]:hover {
      background: var(--primary-hover);
      transform: translateY(-2px);
    }

    input[type="submit"]:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>

  <h1>💥🎯 Update Record 🎯💥</h1>

  <form action="<?=site_url('students/update/'.$student['id']);?>" method="post">
      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" value="<?=html_escape($student['last_name']);?>" required>

      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" value="<?=html_escape($student['first_name']);?>" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?=html_escape($student['email']);?>" required>

      <label for="role">Role</label>
      <input type="text" id="role" name="role" value="<?=html_escape($student['Role']);?>" required>

      <input type="submit" value="Submit">
  </form>

</body>
</html>
