<?php
$conn = new mysqli("localhost", "root", "", "user_image_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <title>User Management System</title>
    <style>
   
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color:rgb(191, 195, 218);
        color: #333;
        line-height: 1.6;
        padding: 40px 20px;
        
    }

    h2 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 30px;
        color: #222;
        font-weight: 600;
    }

    
    form {
        max-width: 600px;
        margin: 0 auto 50px;
        background:rgb(175, 161, 100) ;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        transition: box-shadow 0.3s ease-in-out;
    }

    form:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="file"],
    form button {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px 16px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #dcdcdc;
        transition: border-color 0.3s;
    }

    form input:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.15);
    }

    form button {
        background-color: #111827;
        color: #fff;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: background 0.3s ease;
    }

    form button:hover {
        background-color: #374151;
    }


    table {
        width: 95%;
        max-width: 1200px;
        margin: 0 auto;
        border-collapse: collapse;
        background-color:rgb(175, 161, 100);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.07);
    }

    th, td {
        padding: 16px;
        text-align: center;
        border-bottom: 1px solid #eee;
        font-size: 15px;
    }

    th {
        background-color: #111827;
        color: white;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tr:hover {
        background-color:rgb(144, 167, 202);
    }

   
    img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #ccc;
        transition: transform 0.2s ease;
    }

    img:hover {
        transform: scale(1.05);
        border-color: #7c3aed;
    }

   
    a {
        display: inline-block;
        color: white;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.2s ease;
        background-color: red;
        border-radius: 10px;
        width: 60px;
    }

    a:hover {
        color: black;
        
    }

    
    @media (max-width: 768px) {
        form, table {
            width: 95%;
        }

        th, td {
            font-size: 13px;
            padding: 12px;
        }

        img {
            width: 40px;
            height: 40px;
        }
    }
</style>


</head>
<body>

<h2>Add New User</h2>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="file" name="profile_image" accept="image/*" required>
    <button type="submit">Submit</button>
</form>

<h2>All Users</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Profile Image</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td>
                <img src="uploads/<?= htmlspecialchars($row['image_path']); ?>" alt="Profile">
            </td>
            <td><?= $row['created_at']; ?></td>
            <td>
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
