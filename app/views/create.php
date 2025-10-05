<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create User</title>
  <style>
    :root {
      --primary: #006989;
      --primary-dark: #005a76;
      --bg: #eaebed;
      --card-bg: #ffffff;
      --text: #1a1a1a;
      --muted: #999;
      --radius: 10px;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      color: var(--text);
    }

    form {
      background: var(--card-bg);
      padding: 35px 28px;
      border-radius: var(--radius);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      width: 100%;
      max-width: 380px;
      text-align: center;
      transition: box-shadow 0.3s ease;
    }

    form:hover {
      box-shadow: 0 12px 32px rgba(0, 105, 137, 0.2);
    }

    h1 {
      font-size: 1.7rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 24px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: var(--radius);
      background: #f9f9f9;
      font-size: 1rem;
      transition: border 0.3s, background 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    select:focus {
      border-color: var(--primary);
      background: #ffffff;
      outline: none;
    }

    select {
      color: var(--text);
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      background: var(--primary);
      border: none;
      border-radius: var(--radius);
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: background 0.3s ease, transform 0.1s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    input[type="submit"]:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <form action="<?=site_url('students/create');?>" method="post">
    <h1>💥🎯 Create User 🎯💥</h1>
    <input type="text" id="last_name" name="last_name" placeholder="Last Name" required />
    <input type="text" id="first_name" name="first_name" placeholder="First Name" required />
    <input type="email" id="email" name="email" placeholder="Email" required />
    
    <select id="role" name="role" required>
      <option value="" disabled selected>Select Role</option>
      <option value="controllers">Controllers</option>
      <option value="duelists">Duelists</option>
      <option value="initiators">Initiators</option>
      <option value="sentinels">Sentinels</option>
      <option value="multi">Multi-Role</option>
    </select>

    <input type="submit" value="Submit" />
  </form>
</body>
</html>
