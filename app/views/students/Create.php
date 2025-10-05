<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <style>
:root {
  --primary: #006989;
  --primary-dark: #005a76;
  --bg: #f0f4f8;
  --text: #1a1a1a;
  --muted: #6b7280;
  --card-bg: #ffffff;
  --radius: 10px;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: var(--bg);
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  color: var(--text);
}

form {
  background: var(--card-bg);
  padding: 40px 30px;
  border-radius: var(--radius);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

h1 {
  font-size: 26px;
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
  padding: 12px 10px;
  margin-bottom: 18px;
  border: 1px solid #d1d5db;
  border-radius: var(--radius);
  font-size: 1rem;
  background: #fff;
  color: var(--text);
  transition: border-color 0.2s, box-shadow 0.2s;
}

input::placeholder,
select {
  color: var(--muted);
}

input:focus,
select:focus {
  border-color: var(--primary);
  box-shadow: 0 0 6px rgba(0, 105, 137, 0.4);
  outline: none;
}

input[type="submit"] {
  width: 100%;
  padding: 14px;
  background: var(--primary);
  border: none;
  border-radius: var(--radius);
  color: #fff;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: background 0.3s ease, transform 0.1s ease;
}

input[type="submit"]:hover {
  background: var(--primary-dark);
  transform: translateY(-2px) scale(1.02);
}
  </style>
</head>
<body>
  <form action="<?=site_url('students/create');?>" method="post">
    <h1>💥🎯 Valorant Create User 🎯💥</h1>
    
    <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
    <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
    <input type="email" id="email" name="email" placeholder="Email" required>
    
    <select id="role" name="role" required>
      <option value="" disabled selected>Select Role</option>
      <option value="controllers">Controllers</option>
      <option value="duelists">Duelists</option>
      <option value="initiators">Initiators</option>
      <option value="sentinels">Sentinels</option>
      <option value="multi">Multi-Role</option>
    </select>

    <input type="submit" value="Submit">
  </form>
</body>
</html>
