<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Icons</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .social-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style-type: none;
            padding: 0;
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
            color: #007bff;
        }
    </style>
</head>
<body>
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
</body>
</html>
