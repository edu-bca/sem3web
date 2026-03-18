<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="logo">Attendance Tracker</div>
    <a href="index.php" class="active">Dashboard</a>
    <a href="students.php">Students List</a>
</nav>

<main>
    <header>
        <div>
            <h1>Daily Attendance</h1>
            <p>BCA </p>
        </div>
        <div class="status-badge"><?php echo date('M d, Y'); ?></div>
    </header>

  

    <div class="stats-grid">
        <div class="stat-card">
            <span>Enrolled</span>
            <h3>Enrolled Students Data </h3>
        </div>
        <div class="stat-card">
            <span>Present</span>
            <h3 style="color:var(--success)">Present Student Data</h3>
        </div>
        <div class="stat-card">
            <span>Absent</span>
            <h3 style="color:var(--danger)">Absent Student Data</h3>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Roll Number</th>
                    <th>Student Name</th>
                    <th>Current Status</th>
                    <th>Update Attendance</th>
                </tr>
            </thead>
            <tbody>
               <?php
               include "../Backend/conn.php";
                $sqlqry = "SELECT s.id, s.name, s.roll_no, a.status 
                            FROM students s 
                            LEFT JOIN attendance a ON s.id = a.student_id
                            ORDER BY s.roll_no ASC";
                $result = mysqli_query($conn,$sqlqry);

                while($row = mysqli_fetch_assoc($result)) {
                    $status_val = $row['status'];
                    
                    // Status Styles
                    if ($status_val === null) {
                        $class = "Pending";
                        $text = "pending";
                    } else if ($status_val == 1){
                        $class = "present";
                        $text = "Present";
                    } else{
                        $class = "absent";
                        $text = "Absent";
                    }

                    echo "<tr>
                            <td><b>{$row['roll_no']}</b></td>
                            <td>{$row['name']}</td>
                            <td><span class='status-badge badge-{$class}' id='status-{$row['id']}'>$text</span></td>
                            <td>
                                <div class='btn-group'>
                                    <button class='btn-action btn-present' onclick='mark({$row['id']}, \"Present\")'>Present</button>
                                    <button class='btn-action btn-absent' onclick='mark({$row['id']}, \"Absent\")'>Absent</button>
                                </div>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>


</body>
</html>