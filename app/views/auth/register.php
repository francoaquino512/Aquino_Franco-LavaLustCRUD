<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Ocean Style</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0077b6;
      --primary-dark: #023e8a;
      --background: linear-gradient(to right, #caf0f8, #ade8f4, #90e0ef);
      --input-bg: #ffffff;
      --input-border: #90e0ef;
      --text: #023047;
      --white: #ffffff;
      --radius: 0.75rem;
    }

    body {
      font-family: 'Rajdhani', sans-serif;
      background: var(--background);
      color: var(--text);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .register-container {
      background: var(--white);
      padding: 2.5rem;
      border-radius: var(--radius);
      box-shadow: 0 10px 30px rgba(0, 119, 182, 0.2);
      width: 100%;
      max-width: 400px;
    }

    h1 {
      font-size: 2rem;
      color: var(--primary);
      text-align: center;
      margin-bottom: 1.5rem;
      letter-spacing: 2px;
    }

    .input-field {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--input-border);
      border-radius: var(--radius);
      background-color: var(--input-bg);
      margin-bottom: 1rem;
      transition: all 0.3s ease;
    }

    .input-field:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 6px var(--primary);
      background: #f1fcff;
    }

    .ocean-btn {
      background: var(--primary);
      color: var(--white);
      padding: 12px;
      border: none;
      border-radius: var(--radius);
      font-weight: bold;
      width: 100%;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .ocean-btn:hover {
      background: var(--primary-dark);
      transform: scale(1.03);
    }

    .show-btn {
      position: absolute;
      right: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      font-size: 0.875rem;
      color: var(--primary);
      font-weight: bold;
      cursor: pointer;
    }

    .link {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h1>💥🎯 CREATE ACCOUNT 🎯💥</h1>

    <form method="post" class="space-y-4">
      <!-- Username -->
      <input type="text" name="username" placeholder="Username" required class="input-field">

      <!-- Password -->
      <div class="relative">
        <input type="password" id="register-password" name="password" placeholder="Password" required class="input-field pr-16">
        <button type="button" onclick="togglePassword('register-password', this)" class="show-btn">Show</button>
      </div>

      <!-- Role -->
      <select name="role" class="input-field">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>

      <!-- Register button -->
      <button type="submit" class="ocean-btn">REGISTER</button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      Already have an account?
      <a href="<?= site_url('auth/login') ?>" class="link">Login</a>
    </p>
  </div>

<script>
function togglePassword(id, btn) {
  const input = document.getElementById(id);
  if (input.type === "password") {
    input.type = "text";
    btn.textContent = "Hide";
  } else {
    input.type = "password";
    btn.textContent = "Show";
  }
}
</script>

</body>
</html>
