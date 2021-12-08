<html>
<head>
    <title>Meter Dashboard</title>
    <meta http-equiv="refresh" content="2"> <!-- Refreshes the browser every 1 second -->
    <!-- All the CSS styling for our Web Page, is inside the style tag below -->
    <style type="text/css">
       * {
            margin: 0;
            padding: 0;
        }
        body {
            background: url('https://images.theconversation.com/files/17787/original/tcsj7997-1353301647.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=926&fit=clip') no-repeat center center;
            background-attachment: fixed;
            background-size: cover;
            display: grid;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family:Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        .container {
            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
            border-radius: 1rem;
            position: relative;
            z-index: 1;
            background: inherit;
            overflow: hidden;
                text-align:center;
                padding: 5rem;
            font-size:40px;
                color: white;
        }
        .container:before {
            content: "";
            position: absolute;
            background: inherit;
            z-index: -1;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            box-shadow: inset 0 0 2000px rgba(255, 255, 255, .5);
            filter: blur(10px);
            margin: -20px;
        }         
            h1{
               font-size: 40px;
            }
        p{
            margin: 60px 0 0 0;
        }
  </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #EAF4F7;">
          <div class="container-fluid">
          <a href="index.htm"><img src="logo.png" alt="Logo" style="width:60px; height: 60px; margin-left: 10px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.htm"><b>Home&nbsp;</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="dbread.php"><b>Dashboard&nbsp;</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><b>About&nbsp;</b></a>
                </li> 
                <li class="nav-item">
                  <a class="nav-link" href="mailto:vikrantsingh.ece19@chitkarauniversity.edu.in"><b>Contact me&nbsp;&nbsp;</b></a>
                </li> 
              </ul>
            </div>
          </div>
        </nav><br><br><br>
    <?php
        $host = "localhost";  // host = localhost because database hosted on the same server where PHP files are hosted
        $dbname = "meter";  // Database name
        $username = "admin";  // Database username
        $password = "root"; // Database password
        // Establish connection to MySQL database
        $conn = new mysqli($host, $username, $password, $dbname);
        // Check if connection established successfully
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Query the single latest entry from the database. -> SELECT * FROM table_name ORDER BY col_name DESC LIMIT 1
        $sql = "SELECT * FROM readings ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            //Will come handy if we later want to fetch multiple rows from the table
            while($row = $result->fetch_assoc()) { //fetch_assoc fetches a row from the result of our query iteratively for every row in our result.
                //Returning HTML from the server to show on the webpage.
                echo '<div class="container">';
                echo '<u><h1>Live Meter Reading</h1></u>';
                echo '<p>';
                echo '   <span class="dht-labels">Vrms = </span>';
                echo '   <span id="Vrms">'.$row["Vrms"].' Volts</span>';
                echo ' </p>';
                echo '<p>';
                echo '   <span class="hum dht-labels">Irms = </span>';
                echo '   <span id="Irms">'.$row["Irms"].' Amps</span>';
                echo ' </p>';
                echo '<p>';
                echo '   <span class="hum dht-labels">Power = </span>';
                echo '   <span id="poweru">'.$row["poweru"].' Watts</span>';
                echo ' </p>';
                echo '<p>';
                echo '   <span class="hum dht-labels">Energy Used = </span>';
                echo '   <span id="energy">'.$row["energy"].' KWh</span>';
                echo ' </p>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
    ?>
</body>
</html>