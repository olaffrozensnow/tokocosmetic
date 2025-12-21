<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <style>
    /* Reset dan dasar */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f6f8;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100vh;
      background: linear-gradient(135deg, #4a90e2, #357ABD);
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }

    .sidebar h2 {
      margin-bottom: 30px;
      font-weight: 700;
      letter-spacing: 2px;
      text-align: center;
    }

    .sidebar nav a {
      color: white;
      text-decoration: none;
      padding: 12px 15px;
      margin-bottom: 10px;
      border-radius: 6px;
      display: block;
      transition: background-color 0.3s ease;
      font-weight: 600;
    }

    .sidebar nav a:hover, .sidebar nav a.active {
      background-color: rgba(255, 255, 255, 0.2);
    }

    /* Main content */
    .main-content {
      margin-left: 250px;
      padding: 30px;
      flex-grow: 1;
      background-color: #fff;
      min-height: 100vh;
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .header h1 {
      font-weight: 700;
      color: #4a90e2;
    }

    .header .profile {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .header .profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
      border: 2px solid #4a90e2;
    }

    /* Cards */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }

    .card {
      background: #4a90e2;
      color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(74, 144, 226, 0.5);
    }

    .card h3 {
      font-weight: 700;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 1.8rem;
      font-weight: 700;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border-radius: 12px;
      overflow: hidden;
    }

    thead {
      background-color: #357ABD;
      color: white;
    }

    th, td {
      padding: 15px 20px;
      text-align: left;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #e6f0ff;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        flex-direction: row;
        padding: 10px 20px;
        justify-content: space-around;
      }

      .sidebar h2 {
        display: none;
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
      }

      .cards {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 480px) {
      .cards {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <aside class="sidebar">
    <h2>ADMIN</h2>
    <nav>
      <a href="#" class="active">Dashboard</a>
      <a href="#">Users</a>
      <a href="#">Orders</a>
      <a href="#">Products</a>
      <a href="#">Settings</a>
      <a href="#">Logout</a>
    </nav>
  </aside>

  <main class="main-content">
    <header class="header">
      <h1>Dashboard</h1>
      <div class="profile">
        <img src="https://i.pravatar.cc/40" alt="Profile Picture" />
        <span>Admin</span>
      </div>
    </header>
<section class="cards">
  <div class="card">
    <h3>Users</h3>
    <p><?= $total_users ?></p>
  </div>
  <div class="card">
    <h3>Orders</h3>
    <!-- <p></p> -->
  </div>
  <div class="card">
    <h3>Revenue</h3>
  
  </div>
  <div class="card">
    <h3>Products</h3>
 
  </div>
</section>

<section>
  <h2>Recent Orders</h2>
  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Status</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
     
    </tbody>
  </table>
</section>
</main>
</body>
</html>
