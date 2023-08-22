<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thin Client Report</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            font-size: 16px;
        }

        #form-container {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        #answer {
            width: 100px;
            margin-right: 20px;
        }

        #date-form {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        #date-form label,
        #date-form input {
            margin: 0 10px;
        }

        #submit-button {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <h1>Report Generation</h1>
    <form method="post">
        <label for="dropdown"></label>
        <select id="dropdown" name="selected_option">
            <option value="EIG">EIG</option>
            <option value="MSG">MSG</option>
            <option value="MC&MFCG">MC&MFCG</option>
            <option value="RDTG">RDTG</option>
            <option value="FRFCF">FRFCF</option>
            <option value="ESG">ESG</option>
            <option value="SQ&MRG">SQ&MRG</option>
            <option value="RpG">RpG</option>
            <option value="MMG">MMG</option>
            <option value="RFG">RFG</option>
            <option value="IC">IC</option>
            <option value="CEG">CEG</option>
            <option value="DPS">DPS</option>
            <option value="MG">MG</option>
            <option value="SQRMG">SQRMG</option>
            <option value="NRB">NRB</option>
            <option value="MCMFCG">MCMFCG</option>
            <option value="IGC">IGC</option>
            <option value="DAE">DAE</option>
            <option value="BHAVINI">BHAVINI</option>
            <option value="HSEG">HSEG</option>
        </select>

        <label for="start-date">Start Date:</label>
        <input type="date" id="start-date" name="start-date">
        <label for="end-date">End Date:</label>
        <input type="date" id="end-date" name="end-date">
        <input id="submit-button" type="submit" value="Submit">
    </form>
    </div>
    </div>
</body>

</html>
<html>

<head>
    <style>
        /* Add CSS styles here */
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 16px;
            /* Increase font size */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<br>

<body>
    <table id='Summary' class='Display'>
        <tr>
            <th>VMIP</th>
            <th>vmname</th>
            <th>ThinClientIP</th>
            <th>grp</th>
        </tr>
        <?php
        // Create a connection
        $conn = new mysqli('localhost', 'root', '', 'task2');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $start = $_POST['start-date'];
        $end = $_POST['end-date'];
        $answer = $_POST["selected_option"];
        echo "<h3><pre> Selected group: $answer   Start-date: $start   End-date: $end</h3>";

        $sql = "SELECT VMIP,vmname,ThinClientIP,grp FROM vdi where grp='$answer' and DATE_FORMAT(STR_TO_DATE(AssignedDate, '%d.%m.%Y'), '%Y-%m-%d')  between '$start' and '$end'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["VMIP"] . "</td>";
                echo "<td>" . $row["vmname"] . "</td>";
                echo "<td>" . $row["ThinClientIP"] . "</td>";
                echo "<td>" . $row["grp"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }

        $conn->close();
        ?>

    </table>
</body>

</html>