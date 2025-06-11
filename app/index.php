<?php
session_start();

// Debugging: Check session variables (remove after testing)
if (isset($_SESSION['user_id'])) {
    error_log("Session active: user_id=" . $_SESSION['user_id'] . ", username=" . $_SESSION['username']);
} else {
    error_log("No session active");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | PHP Login System</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Raleway:wght@300;700&display=swap');
        
        body {
            font-family: 'Raleway', Arial, sans-serif;
            background: url('https://wallpapercave.com/wp/wp7417142.jpg') no-repeat center center/cover;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }
        
        .snow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .main-container {
            text-align: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.5);
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
        }
        
        h1 {
            font-family: 'Kaushan Script', cursive;
            font-size: 42px;
            margin-bottom: 20px;
            color: #ffcc00;
            text-shadow: 3px 3px 10px rgba(255, 204, 0, 0.8);
        }
        
        .welcome-section {
            margin-bottom: 30px;
        }
        
        .login-section {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: all 0.3s;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #545b62;
        }
        
        .btn-logout {
            background: #dc3545;
        }
        
        .btn-logout:hover {
            background: #a71d2a;
        }
        
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }
        
        .social-links a {
            display: inline-block;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
            border-color: yellow;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .snowflake {
            position: absolute;
            top: -10px;
            background: white;
            border-radius: 50%;
            opacity: 0.8;
            animation: snowfall linear infinite;
        }
        
        .user-welcome {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ffcc00;
        }
        
        @keyframes snowfall {
            to {
                transform: translateY(100vh);
            }
        }
        
        @media (max-width: 600px) {
            h1 {
                font-size: 30px;
            }
            
            .main-container {
                padding: 20px;
            }
            
            .btn {
                padding: 10px 20px;
                margin: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="snow"></div>
    
    <div class="main-container">
        <div class="welcome-section">
            <h1>Welcome to PHP Login System</h1>
            
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<p class="user-welcome">Welcome back, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
                echo '<a href="logout.php" class="btn btn-logout">Logout</a>';
            } else {
                echo '<p style="font-size: 18px; margin-bottom: 20px;">Please choose an option below to get started</p>';
                echo '<div class="login-section">';
                echo '<a href="login.php" class="btn">Login</a>';
                echo '<a href="register.php" class="btn btn-secondary">Register</a>';
                echo '</div>';
            }
            ?>
        </div>
        
        <div class="connect-section">
            <h2>Connect With Me</h2>
            <ul class="social-links">
                <li><a href="https://www.facebook.com/share/1NwTDikbSd/" target="_blank">Facebook</a></li>
                <li><a href="https://www.twitter.com/Jing200424" target="_blank">Twitter</a></li>
                <li><a href="https://www.instagram.com/ezomaki.riko?igsh=MW5iYzV4ZTBlMzd2aA==" target="_blank">Instagram</a></li>
                <li><a href="https://www.linkedin.com/in/ssn-tube-0394741a2" target="_blank">LinkedIn</a></li>
                <li><a href="https://www.tiktok.com/@leak2222kkxbz?_t=ZS-8x5oyS61vDl&_r=1" target="_blank">TikTok</a></li>
                <li><a href="https://t.me/ImyourYihan" target="_blank">Telegram</a></li>
                <li><a href="mailto:pardpand@gmail.com" target="_blank">Gmail</a></li>
            </ul>
        </div>
    </div>
    
    <audio autoplay loop>
        <source src="2MDIE - ឆាឆាឆា ( CHA CHA CHA ) FT. McSeyCG Official Audio.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    
    <script>
        function createSnowflakes() {
            const snowContainer = document.querySelector('.snow');
            for (let i = 0; i < 100; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = Math.random() * 5 + 'px';
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = Math.random() * 100 + 'vw';
                snowflake.style.animationDuration = (Math.random() * 5 + 3) + 's';
                snowContainer.appendChild(snowflake);
            }
        }
        createSnowflakes();
    </script>
</body>
</html>