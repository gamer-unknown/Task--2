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
<link
rel="stylesheet"
type="text/css"
href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"
/>
</head>
<body>
<table id="table_id" class="display" style="width:100%">
<thead>
<tr>
<th>Name</th>
<th>Department</th>
<th>Place</th>
<th>Contact No.</th>
<th>DOJ</th>
<th>Email</th>
</tr>
</thead>
</table>
<script
type="text/javascript"
charset="utf8"
src="https://code.jquery.com/jquery-3.3.1.js"
></script>
<script
type="text/javascript"
charset="utf8"
src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
></script>
<script>
$(document).ready(function() {
$("#table_id").DataTable({
ajax: "./ajaxList.txt"
});
});
</script>
</body>
</html>