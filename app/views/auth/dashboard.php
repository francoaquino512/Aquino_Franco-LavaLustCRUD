<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Rajdhani', sans-serif;
      background: #f0f4f8;
      color: #1a1a1a;
    }

    .ocean-container {
      background-color: #ffffff;
      border: 1px solid #d0d7de;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .ocean-btn {
      background: #006989;
      color: #ffffff;
      padding: 10px 20px;
      border-radius: 0.5rem;
      font-weight: bold;
      letter-spacing: 1px;
      transition: all 0.3s;
    }

    .ocean-btn:hover {
      background: #005a76;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 0.5rem;
      overflow: hidden;
    }

    th {
      background: #006989;
      color: white;
      text-transform: uppercase;
      font-weight: bold;
      padding: 12px;
    }

    td {
      padding: 12px;
      background: #f9f9f9;
      border-bottom: 1px solid #e1e4e8;
    }

    tr:hover td {
      background: #eaf3f6;
      transition: 0.3s;
    }

    .search-input {
      padding: 10px;
      border: 1px solid #ccc;
      border-right: none;
      border-radius: 0.5rem 0 0 0.5rem;
      background-color: #fff;
      color: #333;
    }

    .search-input:focus {
      outline: none;
      border-color: #006989;
    }
  </style>
</head>
<body class="p-6">

  <!-- User Info -->
  <div class="mb-6 text-center">
    <h1 class="text-5xl font-bold tracking-widest text-[#006989]">STUDENTS DASHBOARD</h1>
    <p class="mt-2 text-lg">Welcome, 
      <span class="font-bold">
        <?= $this->call->library('session');('username') ?>
      </span>
    </p>
    <p class="text-gray-600">Role: 
      <?= $this->call->library('session');('role') ?>
    </p>
  </div>

  <!-- Search Bar -->
  <form method="get" action="<?= site_url('/students') ?>" class="mb-6 flex justify-center">
    <input 
      type="text" 
      name="q" 
      value="<?= html_escape($_GET['q'] ?? '') ?>" 
      placeholder="Search student..." 
      class="search-input w-64"
    >
    <button type="submit" class="ocean-btn rounded-l-none rounded-r-md">🔍</button>
  </form>

  <!-- Container -->
  <div class="max-w-5xl mx-auto ocean-container">
    <table>
      <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
      <?php foreach (html_escape($students) as $student): ?>
      <tr>
        <td><?= $student['id']; ?></td>
        <td><?= $student['first_name']; ?></td>
        <td><?= $student['last_name']; ?></td>
        <td><?= $student['email']; ?></td>
      </tr>
      <?php endforeach; ?>
    </table>

    <!-- Pagination + Logout -->
    <div class="mt-6 flex justify-between items-center">
      <div class="pagination flex space-x-2 text-[#006989] font-bold">
        <?= $page ?? '' ?>
      </div>
      <a class="ocean-btn" href="<?= site_url('auth/logout'); ?>">Logout</a>
    </div>
  </div>

</body>
</html>
