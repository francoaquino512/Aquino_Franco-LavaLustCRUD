<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: " . site_url('auth/login'));
    exit;
}
$role = $_SESSION['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Showdata</title>
  <style>
    :root {
      --bg: linear-gradient(135deg, #dbeafe, #f0f5ff);
      --card-bg: rgba(255, 255, 255, 0.85);
      --primary: #6c63ff;
      --accent: #ffb6b9;
      --text: #333;
      --muted: #888;
      --white: #ffffff;
      --radius: 12px;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg);
      margin: 0;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      color: var(--text);
    }

    h1 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 25px;
      color: var(--primary);
      text-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .search-box {
      width: 90%;
      margin-bottom: 20px;
      text-align: right;
    }

    .search-box input[type="text"] {
      padding: 8px 12px;
      border: 1px solid var(--accent);
      border-radius: var(--radius);
      background: var(--white);
      color: var(--text);
    }

    .search-box button {
      padding: 8px 14px;
      margin-left: 5px;
      background: var(--primary);
      color: var(--white);
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .search-box button:hover {
      background: var(--accent);
      color: var(--text);
    }

    table {
      width: 90%;
      border-collapse: collapse;
      background: var(--card-bg);
      border-radius: var(--radius);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    th, td {
      padding: 14px 16px;
      text-align: left;
    }

    th {
      background: var(--primary);
      color: var(--white);
      text-transform: uppercase;
      letter-spacing: 1px;
      font-size: 0.85rem;
    }

    tr:nth-child(even) {
      background: #f0f0ff;
    }

    tr:hover {
      background: #e9e4ff;
    }

    td {
      color: var(--text);
      font-size: 0.95rem;
    }

    a {
      display: inline-block;
      margin-right: 6px;
      padding: 6px 12px;
      border-radius: var(--radius);
      font-size: 0.85rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    a[href*="update"] {
      background: #a7c7ff;
      color: #1e3a8a;
    }

    a[href*="update"]:hover {
      background: #7fb0ff;
    }

    a[href*="delete"] {
      background: #ffb6b9;
      color: #8b0000;
    }

    a[href*="delete"]:hover {
      background: #ff9496;
    }

    .create-btn {
      margin-top: 25px;
      background: var(--primary);
      color: var(--white);
      padding: 12px 20px;
      border-radius: var(--radius);
      font-size: 1rem;
      font-weight: bold;
      text-transform: uppercase;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .create-btn:hover {
      background: var(--accent);
      color: var(--text);
    }

    .logout-btn {
      margin-top: 15px;
      background: #ef4444;
      color: var(--white);
    }

    .logout-btn:hover {
      background: #dc2626;
    }

    .pagination {
      margin: 20px 0;
      display: flex;
      justify-content: center;
      gap: 8px;
      list-style: none;
      padding: 0;
    }

    .pagination a,
    .pagination strong {
      padding: 8px 14px;
      border: 1px solid var(--primary);
      background: var(--white);
      color: var(--primary);
      text-decoration: none;
      font-weight: bold;
      border-radius: var(--radius);
      transition: all 0.3s ease;
    }

    .pagination a:hover {
      background: var(--primary);
      color: var(--white);
    }

    .pagination strong {
      background: var(--primary);
      color: var(--white);
      cursor: default;
    }
  </style>
</head>
<body>
  <h1>💥🎯 Valorant Show Data 🎯💥</h1>

  <!-- 🔍 Search Form -->
  <div class="search-box">
    <form method="get" action="<?=site_url('/students');?>">
      <input type="text" name="q" placeholder="Search..." value="<?=isset($_GET['q']) ? html_escape($_GET['q']) : '';?>">
      <button type="submit">Search</button>
    </form>
  </div>

  <!-- 📊 Table -->
  <table>
    <tr>
      <th>ID</th>
      <th>Lastname</th>
      <th>Firstname</th>
      <th>Email</th>
      <th>Role</th>
      <?php if ($role === 'admin'): ?>
        <th>Action</th>
      <?php endif; ?>
    </tr>
    <?php if (!empty($students)): ?>
      <?php foreach(html_escape($students) as $student): ?>
        <tr>
          <td><?= $student['id']; ?></td>
          <td><?= $student['last_name']; ?></td>
          <td><?= $student['first_name']; ?></td>
          <td><?= $student['email']; ?></td>
          <td><?= $student['Role']; ?></td>
          <?php if ($role === 'admin'): ?>
          <td>
            <a href="<?= site_url('students/update/' . $student['id']); ?>">Update</a>
            <a href="<?= site_url('students/delete/' . $student['id']); ?>">Delete</a>
          </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="6">No records found.</td></tr>
    <?php endif; ?>
  </table>

  <!-- 📄 Pagination -->
  <?php if (!empty($page)): ?>
    <ul class="pagination">
      <?= $page; ?>
    </ul>
  <?php endif; ?>

  <!-- ➕ Create Record -->
  <?php if ($role === 'admin'): ?>
    <a href="<?=site_url('students/create');?>" class="create-btn">+ Create Record</a>
  <?php endif; ?>

  <!-- 🚪 Logout -->
  <a href="<?=site_url('auth/logout');?>" class="create-btn logout-btn">Logout</a>
</body>
</html>
