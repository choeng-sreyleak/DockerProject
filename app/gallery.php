<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect with Me</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Raleway:wght@300;700&display=swap');
        
        body {
            font-family: 'Kaushan Script', cursive;
            background: url('https://wallpapercave.com/wp/wp7417142.jpg') no-repeat center center/cover;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
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
        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.5);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            width: 100%;
            max-width: 800px;
        }
        h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: #ffcc00;
            text-shadow: 3px 3px 10px rgba(255, 204, 0, 0.8);
            width: 100%;
        }
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            list-style: none;
            padding: 0;
            width: 100%;
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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            margin-top: 20px;
        }
        .btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        .snowflake {
            position: absolute;
            top: -10px;
            background: white;
            border-radius: 50%;
            opacity: 0.8;
            animation: snowfall linear infinite;
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
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="snow"></div>
    <div class="container">
        <h1>Connect with Me</h1>
        <ul class="social-links">
            <li><a href="https://web.facebook.com/uronly1jing/" class="facebook" target="_blank">Facebook</a></li>
            <li><a href="https://www.twitter.com/Jing200424" class="twitter" target="_blank">Twitter</a></li>
            <li><a href="https://www.instagram.com/p/CI5sf8dF2vN/" class="instagram" target="_blank">Instagram</a></li>
            <li><a href="https://www.linkedin.com/in/ssn-tube-0394741a2" class="linkedin" target="_blank">LinkedIn</a></li>
            <li><a href="https://www.tiktok.com/@fb_andreww" class="tiktok" target="_blank">TikTok</a></li>
            <li><a href="https://t.me/Ucancallmejing" class="telegram" target="_blank">Telegram</a></li>
            <li><a href="mailto:pardpand@gmail.com" class="gmail" target="_blank">Gmail</a></li>
        </ul>
        <a href="index.php" class="btn">Log Out</a>
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