<!DOCTYPE html>
<html>
<head>
  <title>Maid Dashboard</title>
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    #dashboard {
      display: flex;
    }

    #menu {
      width: 250px;
      background: #f2f2f2;
      padding: 20px;
    }

    #content {
      flex: 1;
      padding: 20px;
    }

    #profile {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #ccc;
      margin-bottom: 20px;
    }

    #menu ul {
      list-style-type: none;
      padding: 0;
    }

    #menu ul li {
      margin-bottom: 10px;
    }

    #menu ul li a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }

    #bookings {
      margin-top: 20px;
    }

    #bookings h2 {
      margin-bottom: 10px;
    }

    .booking-item {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
    }

    .booking-item button {
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div id="dashboard">
    <div id="menu">
      <img id="profile" src="maid_profile_picture.jpg" alt="Profile Picture">
      <ul>
        <li><a href="#">View Bookings</a></li>
      </ul>
    </div>
    <div id="content">
      <div id="bookings">
        <h2>Available Bookings</h2>
        <div class="booking-item">
          <p>Booking details go here...</p>
          <button onclick="acceptBooking()">Accept</button>
          <button onclick="rejectBooking()">Reject</button>
        </div>
        <div class="booking-item">
          <p>Booking details go here...</p>
          <button onclick="acceptBooking()">Accept</button>
          <button onclick="rejectBooking()">Reject</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function acceptBooking() {
      alert("Booking accepted!");
    }

    function rejectBooking() {
      alert("Booking rejected!");
    }
  </script>
</body>
</html>

