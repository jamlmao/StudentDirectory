<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Import Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container-fluid {
            max-width: 40rem;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: orange;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .border-dark-subtle {
            border: 1px solid #ddd;
            background-color: orange; /* Set background color to orange */
        }
        .p-3 {
            padding: 1rem;
        }
        .w-50 {
            width: 100%;
            padding-right: 10px;
        }
        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: black;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1>Add Student Info</h1>
        <fieldset class="border border-dark-subtle p-3">
            <form action="add_item.php" method="post" class="row">
                <!-- Student Info Input Fields -->
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Student ID: </label>
                    <input type="text" name="Student_ID" class="form-control" pattern="[0-9]+" title="Please enter only numeric values">
                </div>
                <!-- Other input fields for student info -->
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">First Name: </label>
                    <input type="text" class="form-control" name="firstname">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Last Name: </label>
                    <input type="text" class="form-control" name="lastname">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Birth Date: </label>
                    <input type="date" class="form-control" name="birthdate">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Home Address: </label>
                    <input type="text" class="form-control" name="homeadd">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Boarding Address: </label>
                    <input type="text" class="form-control" name="boardingadd">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Contact No.: </label>
                    <input type="tel" class="form-control" name="contact">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Sex: </label>
                    <input type="text" class="form-control" name="Sex">
                </div>
                <div class="mb-3 w-50">
                    <label class="form-label mb-0">Course: </label>
                    <input type="text" class="form-control" name="Course">
                </div>
                <div class="text-right w-100">
                    <center><button type="submit" name="btnSave" class="btn btn-primary">Add</button></center>
                </div>
            </form>
        </fieldset>
    </div>

    <!-- JavaScript Section -->
    <script>
        // JavaScript functions for searching and loading items
        function search(event){
            // Implement search functionality
        }

        function loadItems(){
            // Implement item loading functionality
        }
    </script>
</body>
</html>
