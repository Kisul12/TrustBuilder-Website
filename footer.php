<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Footer Example</title>
    <style>   
        .social-icons {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .social-icons li {
            margin: 0 10px;
        }

        .social-icons a {
            color: #000;
            font-size: 24px;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: black;
        }

        .footer-divider {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid black;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .footer-rights {
            margin: 0;
            font-size: 14px;
            color: black;
        }

        .footer-links {
            display: flex;
            gap: 15px;
        }

        .footer-links a {
            color: black;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="footer-content">
            <p class="footer-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore illo distinctio accusantium in dicta harum et accusamus repudiandae eligendi! Pariatur assumenda unde nulla fugiat ut maxime aperiam soluta, nostrum quasi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi fuga cum nobis explicabo deleniti id rerum quae qui voluptatem? Corporis atque impedit debitis, placeat rem consequatur eum possimus totam aspernatur!
            </p><br>
            <div class="footer-contact-section">
                <p class="footer-contact">CONTACT US</p>
                <p class="footer-links"><a href="mailto:trustbuild@gmail.id">trustbuild@gmail.id</a></p>
                <?php
                $socialLinks = [
                    'facebook' => 'https://facebook.com',
                    'twitter' => 'https://twitter.com',
                    'instagram' => 'https://instagram.com',
                    'linkedin' => 'https://linkedin.com'
                ];
                ?>
                <ul class="social-icons">
                    <?php foreach ($socialLinks as $name => $link): ?>
                        <li><a href="<?= $link ?>" target="_blank"><i class="fab fa-<?= $name ?>"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <p class="footer-rights">&copy; 2024 BT Project. All Rights Reserved.</p>
                <div class="footer-links">
                    <a href="#">About Us</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
