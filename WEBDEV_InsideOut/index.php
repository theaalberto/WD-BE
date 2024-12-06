<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Core Memories</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwpFLE9ttwV7aTtw7lYvC9Fl7YNl5MIyUwoA&s" type="image/x-icon">
    <style>
    body {
        background-color: #655C9E; 
     }
    .w3-row {
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        box-sizing: border-box;
        max-width: 100%;
    }
    .w3-half {
        max-width: 300px;
        flex: 1 1 auto;
        margin: 20px;
        padding-left: 10px;
        padding-right: 10px;
        box-sizing: border-box;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .w3-topbar {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        text-align: left;
        border-width: 2px;
        border-style: solid;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: box-shadow 0.3s ease;
    }
    .w3-half:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    .w3-topbar:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    .memory-image {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        display: block;
        margin-bottom: 10px;
    }
    .w3-topbar h2 {
        margin: 5px 0;
    }
    .w3-topbar p {
        margin: 0;
    }
</style>
</head>
<body>
    <div class="w3-display-container" style="margin-bottom: 50px;">
        <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/47cd7395-d3c9-4621-8bd3-09a331d1aaaf/dhoi83j-6980d53a-43dd-4da5-81af-e4317e69d7ed.jpg/v1/fit/w_828,h_414,q_70,strp/inside_out_2_background_by_oliviarosesmith_dhoi83j-414w-2x.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NjQwIiwicGF0aCI6IlwvZlwvNDdjZDczOTUtZDNjOS00NjIxLThiZDMtMDlhMzMxZDFhYWFmXC9kaG9pODNqLTY5ODBkNTNhLTQzZGQtNGRhNS04MWFmLWU0MzE3ZTY5ZDdlZC5qcGciLCJ3aWR0aCI6Ijw9MTI4MCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS5vcGVyYXRpb25zIl19.aNWrgnDDGS7MdqOyNN9S0o6aWKaiQAKyH2O9jvq8Q7c" style="width: 100%;">
        <div class="w3-display-bottomleft w3-container w3-hide-small" style="bottom: 10%; opacity: 1; width: 70%;">
            <h2><b>My Core Memories<br>A collection of significant moments that shaped who I am today.</b></h2>
        </div>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "corememories";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT name, shortDescription, color, image FROM islandsofpersonality";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $counter++;
            $imageData = base64_encode($row['image']);
            $imageSrc = 'data:image/jpeg;base64,' . $imageData;

            if ($counter === 1) {
                echo '<a href="..\lover\lover.php?name=' . urlencode($row['name']) . '" style="text-decoration: none;">';
            } 
            if ($counter === 2) {
                echo '<a href="student\student.php?name=' . urlencode($row['name']) . '" style="text-decoration: none;">';
            }
            if ($counter === 3) {
                echo '<a href="friends\friends.php?name=' . urlencode($row['name']) . '" style="text-decoration: none;">';
            }
            if ($counter === 4) {
                echo '<a href="social_media\social_media.php?name=' . urlencode($row['name']) . '" style="text-decoration: none;">';
            }

            echo '<div class="w3-half">';
            echo '<div class="w3-topbar" style="border-color:' . htmlspecialchars($row['color']) . '; background-color:' . htmlspecialchars($row['color']) . ';">';
            echo '<img src="' . $imageSrc . '" class="memory-image">';
            echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
            echo '<p>' . htmlspecialchars($row['shortDescription']) . '</p>';
            echo '</div>';
            echo '</div>';

            echo '</a>';
        }
    } else {
        echo '<p>No data found in the database.</p>';
    }
    $conn->close();
    ?>

</body>
</html>
