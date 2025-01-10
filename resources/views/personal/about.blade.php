<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Priyanshu Dave</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            margin: 0;
            padding: 0;
            background: #f3f6f9;
        }

        /* Profile Header */
        .profile-header {
            width: 100%;
            height: 200px;
            background-image: url('{{ asset('images/banner.png') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        /* Profile Image */
        .profile-picture {
            background-color: white;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white;
            position: absolute;
            left: 20px;
            top: 130px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Profile Details */
        .profile-info {
            text-align: left;
            margin-left: 190px;
            margin-top: 10px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-info h1 {
            font-size: 1.8em;
            margin: 0;
            color: #333;
        }

        .profile-info p {
            margin: 5px 0;
            color: #666;
        }

        .action-buttons {
            margin-top: 15px;
        }

        .action-buttons button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background-color: #0073b1;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #005582;
        }

        /* Additional Sections */
        .section {
            margin-top: 20px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #0073b1;
        }

        .section p {
            color: #333;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<div class="profile-header"></div>

<div class="profile-picture">
    <img src="{{ asset('images/default-profile.png') }}" alt="Profile Picture">
</div>

<div class="profile-info">
    <h1>Priyanshu Dave</h1>
    <p>Software Developer | Laravel & Magento Enthusiast</p>
    <p>Location: Anytown, India</p>

    <div class="action-buttons">
        <button>Connect</button>
        <button>Message</button>
    </div>
</div>

<!-- About Section -->
<div class="section">
    <h2>About</h2>
    <p>I’m a passionate software developer with experience in Laravel and Magento. I believe in the power of technology to bring positive changes and am dedicated to continuous improvement and learning.</p>
</div>

<!-- Experience Section -->
<div class="section">
    <h2>Experience</h2>
    <p>Software Developer at XYZ Company</p>
    <p>January 2022 - Present</p>
</div>

<!-- Education Section -->
<div class="section">
    <h2>Education</h2>
    <p>Bachelor's in Computer Science from ABC University</p>
</div>

<!-- Skills Section -->
<div class="section">
    <h2>Skills</h2>
    <p>Laravel, Magento, PHP, HTML, CSS, JavaScript</p>
</div>

</body>
</html>
