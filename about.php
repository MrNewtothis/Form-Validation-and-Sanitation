<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: registration.php");
    exit();
}

$userData = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="media/pic/ian.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>𝚄𝚜𝚎𝚛 𝙸𝚗𝚏𝚘</title>
</head>
<body>
    <audio id="background-music" autoplay loop>
        <source src="audio/genshinbg.mp3" type="audio/mpeg">
        If this shows up, audio bg is not supported.
    </audio>

    <video class="video-background" autoplay muted loop>
        <source src="media/vid/Genshin.mp4" type="video/mp4">
        If this shows up, it's not supported.
    </video>

    <div class="volume-control">
        <input type="range" id="volume-slider" min="0" max="1" step="0.01" value="0.5" style="position: absolute; top: 10px; right: 10px;">
    </div>

    <div class="container mt-5">
        <div class="card shadow-lg" style="opacity: 0.9;"> <!-- Adjusted opacity for transparency -->
            <div class="card-body">
                <h2 class="text-center mb-4">𝚄𝚜𝚎𝚛 𝙸𝚗𝚏𝚘𝚛𝚖𝚊𝚝𝚒𝚘𝚗</h2>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?php echo htmlspecialchars($userData['name']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo htmlspecialchars($userData['email']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Facebook URL:</strong></td>
                        <td><a href="<?php echo htmlspecialchars($userData['facebook']); ?>" target="_blank"><?php echo htmlspecialchars($userData['facebook']); ?></a></td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong></td>
                        <td><?php echo htmlspecialchars($userData['gender']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Country:</strong></td>
                        <td><?php echo htmlspecialchars($userData['country']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Skills:</strong></td>
                        <td><?php echo htmlspecialchars(implode(", ", $userData['skills'])); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Biography:</strong></td>
                        <td><?php echo htmlspecialchars($userData['biography']); ?></td>
                    </tr>
                </table>
                <a href="registration.php" class="btn btn-primary mt-3">Back to Registration</a>
                <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
    </div>

    <script>
        const audio = document.getElementById('background-music');
        const volumeSlider = document.getElementById('volume-slider');

        volumeSlider.addEventListener('input', function() {
            audio.volume = volumeSlider.value; 
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
