<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwpFLE9ttwV7aTtw7lYvC9Fl7YNl5MIyUwoA&s" type="image/x-icon">
    <style>
        body {
            background-color: #655C9E;
        }
        .w3-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: stretch;
            gap: 20px;
            padding: 0;
            margin: 0 auto;
            height: 100vh;
            box-sizing: border-box;
        }

        .w3-half {
            flex: 1;
            min-width: 300px;
            max-width: 33%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .w3-topbar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            border-width: 2px;
            border-style: solid;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            height: 100%;
            background-color: #f8f8f8;
        }

        .memory-image {
            max-height: 70%;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin-bottom: 15px;
        }

        .w3-topbar h2 {
            margin: 10px 0;
            font-size: 24px;
        }

        .w3-topbar p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="w3-row w3-container" style="margin: 0;">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "corememories";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT image, content, color FROM islandcontents WHERE islandContentID IN (401, 402, 403) AND image IS NOT NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="w3-row w3-container" style="margin: 0;">';
        while ($row = $result->fetch_assoc()) {
            $imageData = base64_encode($row['image']);
            $imageSrc = 'data:image/jpeg;base64,' . $imageData;

            echo '<div class="w3-half">';
            echo '<div class="w3-topbar" style="border-color:' . htmlspecialchars($row['color']) . '; background-color:' . htmlspecialchars($row['color']) . ';">';
            echo '<img src="' . $imageSrc . '" class="memory-image">';
            echo '<h2>' . htmlspecialchars($row['content']) . '</h2>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No data found for the specified islandContentID.</p>';
    }
    $conn->close();
    ?>
    </div>
</body>
</html>
