<?php
require_once 'config/database.php';
require_once 'classes/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System | User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --info: #560bad;
            --white: #ffffff;
            --gray: #6c757d;
            --dark-blue: #1a2a6c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--white);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            position: relative;
            font-weight: 700;
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
        }
        
        .content {
            padding: 2rem;
        }
        
        .status-card {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            background: var(--light);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .status-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .status-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .success-card {
            border-left: 4px solid var(--success);
        }
        
        .success-card .status-icon {
            background: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }
        
        .error-card {
            border-left: 4px solid var(--danger);
        }
        
        .error-card .status-icon {
            background: rgba(247, 37, 133, 0.1);
            color: var(--danger);
        }
        
        .status-text {
            flex-grow: 1;
        }
        
        .status-text h3 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }
        
        .status-text p {
            font-size: 0.9rem;
            color: var(--gray);
        }
        
        .user-table-container {
            overflow-x: auto;
            margin: 2rem 0;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .user-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 600px;
        }
        
        .user-table thead th {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);
            color: var(--white);
            padding: 1rem 1.5rem;
            text-align: left;
            font-weight: 600;
            position: sticky;
            top: 0;
        }
        
        .user-table th:first-child {
            border-top-left-radius: 12px;
        }
        
        .user-table th:last-child {
            border-top-right-radius: 12px;
        }
        
        .user-table tbody tr {
            transition: all 0.2s ease;
        }
        
        .user-table tbody tr:nth-child(even) {
            background-color: rgba(248, 249, 250, 0.5);
        }
        
        .user-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.1);
            transform: translateX(4px);
        }
        
        .user-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .user-count {
            text-align: center;
            margin: 1.5rem 0;
            font-size: 1.1rem;
            color: var(--gray);
        }
        
        .user-count strong {
            color: var(--primary);
            font-weight: 600;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--white);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            border: none;
            cursor: pointer;
            margin-top: 1rem;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        }
        
        .btn i {
            margin-right: 0.5rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--light);
            border-radius: 12px;
            margin: 2rem 0;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: var(--gray);
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .empty-state p {
            color: var(--gray);
            max-width: 500px;
            margin: 0 auto;
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            .content {
                padding: 1.5rem;
            }
            
            .user-table td, 
            .user-table th {
                padding: 0.8rem 1rem;
            }
        }
        
        @media (max-width: 576px) {
            body {
                padding: 1rem 0.5rem;
            }
            
            .header {
                padding: 1.5rem 1rem;
            }
            
            .header h1 {
                font-size: 1.8rem;
            }
            
            .content {
                padding: 1rem;
            }
            
            .status-card {
                padding: 1rem;
            }
            
            .btn {
                width: 100%;
                padding: 1rem;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animated {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <div class="container animated">
        <div class="header">
            <h1><i class="fas fa-users"></i> User Management</h1>
            <p>View and manage all registered users in the system</p>
        </div>
        
        <div class="content">
            <?php
            try {
                $database = new Database();
                $db = $database->getConnection();
                
                if ($db) {
                    echo '<div class="status-card success-card animated delay-1">';
                    echo '    <div class="status-icon"><i class="fas fa-check-circle"></i></div>';
                    echo '    <div class="status-text">';
                    echo '        <h3>Database Connection Successful</h3>';
                    echo '        <p>Connected to the database server successfully</p>';
                    echo '    </div>';
                    echo '</div>';
                    
                    $stmt = $db->query("SHOW TABLES LIKE 'users'");
                    if ($stmt->rowCount() > 0) {
                        echo '<div class="status-card success-card animated delay-2">';
                        echo '    <div class="status-icon"><i class="fas fa-table"></i></div>';
                        echo '    <div class="status-text">';
                        echo '        <h3>Users Table Exists</h3>';
                        echo '        <p>The users table was found in the database</p>';
                        echo '    </div>';
                        echo '</div>';
                        
                        $stmt = $db->query("SELECT id, username, email FROM users");
                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        echo '<div class="user-table-container animated delay-3">';
                        echo '    <table class="user-table">';
                        echo '        <thead>';
                        echo '            <tr>';
                        echo '                <th><i class="fas fa-id-card"></i> ID</th>';
                        echo '                <th><i class="fas fa-user"></i> Username</th>';
                        echo '                <th><i class="fas fa-envelope"></i> Email</th>';
                        echo '            </tr>';
                        echo '        </thead>';
                        echo '        <tbody>';
                        
                        if (count($users) > 0) {
                            foreach ($users as $user) {
                                echo '<tr>';
                                echo '    <td>' . htmlspecialchars($user['id']) . '</td>';
                                echo '    <td>' . htmlspecialchars($user['username']) . '</td>';
                                echo '    <td>' . htmlspecialchars($user['email']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">';
                            echo '    <div class="empty-state">';
                            echo '        <i class="fas fa-user-slash"></i>';
                            echo '        <h3>No Users Found</h3>';
                            echo '        <p>The users table exists but doesn\'t contain any records yet.</p>';
                            echo '    </div>';
                            echo '</td></tr>';
                        }
                        
                        echo '        </tbody>';
                        echo '    </table>';
                        echo '</div>';
                        
                        if (count($users) > 0) {
                            echo '<div class="user-count animated delay-3">';
                            echo '    Total users in database: <strong>' . count($users) . '</strong>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="status-card error-card animated delay-2">';
                        echo '    <div class="status-icon"><i class="fas fa-exclamation-circle"></i></div>';
                        echo '    <div class="status-text">';
                        echo '        <h3>Users Table Missing</h3>';
                        echo '        <p>The users table was not found in the database</p>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="status-card error-card animated delay-1">';
                    echo '    <div class="status-icon"><i class="fas fa-times-circle"></i></div>';
                    echo '    <div class="status-text">';
                    echo '        <h3>Database Connection Failed</h3>';
                    echo '        <p>Could not establish a connection to the database server</p>';
                    echo '    </div>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                echo '<div class="status-card error-card animated delay-1">';
                echo '    <div class="status-icon"><i class="fas fa-bug"></i></div>';
                echo '    <div class="status-text">';
                echo '        <h3>Database Error</h3>';
                echo '        <p>' . htmlspecialchars($e->getMessage()) . '</p>';
                echo '    </div>';
                echo '</div>';
            }
            ?>
            
            <a href="index.php" class="btn animated delay-3">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </div>
</body>
</html>