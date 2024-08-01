<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Equipment</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Equipment</h1>
    <button class="button" onclick="window.location.href='./add-new-equipment/'" type="button">Add New Equipment</button>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Model Name</th>
                    <th>Model Number</th>
                    <th>Serial Number</th>
                    <th>Purchase Date</th>                    
                    <th>Purchase Price</th>
                    <th>Warranty Start</th>
                    <th>Warranty End</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Computer</td>
                    <td>HP Z2 Small Form Factor G5 Workstation</td>
                    <td>WS-118</td>
                    <td>Doe</td>
                    <td>555-555-5555</td>
                    <td>555-555-5555</td>
                    <td>555</td>
                    <td>jdoe@johndoe.com</td>
                    <td>Janitor</td>                    
                    <td><img class="garbage-can garbage-can1 user-garbage-can user-garbage-can1" src="../images/garbage-can.svg" alt="Garbage Can 1"></td>
                </tr>                            
            </tbody>
        </table>
    </div>
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>