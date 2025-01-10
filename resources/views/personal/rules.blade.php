<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Game Rules & Regulations</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        .card h1 {
            font-size: 2.5rem;
            color: #333;
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }
        .card h2 {
            font-size: 1.75rem;
            color: #2b6cb0;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        .card h2 i {
            margin-right: 0.5rem;
        }
        .card p {
            font-size: 1rem;
            color: #4a5568;
            line-height: 1.75;
        }
        .card ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }
        .card ul li {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        .card ul li i {
            color: #38b2ac;
            margin-right: 0.5rem;
        }
        .card a {
            color: #3182ce;
            text-decoration: none;
            transition: color 0.2s;
        }
        .card a:hover {
            color: #2b6cb0;
        }
        .footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.875rem;
            color: #718096;
        }
        .back-button {
            display: inline-block;
            background-color: #3182ce;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 1rem;
            text-decoration: none;
            margin-bottom: 1.5rem;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="{{ route('landing.page') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Landing Page
        </a>

        <div class="card">
            <h1><i class="fas fa-gamepad text-blue-600"></i> Quiz Game Rules & Regulations</h1>

            <section>
                <h2><i class="fas fa-sign-in-alt"></i> How to Play the Game</h2>
                <p>
                    To participate in the quiz game, you need to sign up and verify your email. Once you are registered and logged in, you can start playing the quiz. 
                    During the game, you will be presented with a series of questions, and you'll need to select the correct answers within the time limit.
                </p>
            </section>

            <section>
                <h2><i class="fas fa-tasks"></i> Game Rules</h2>
                <ul>
                    <li><i class="fas fa-check-circle"></i> The game consists of Timed questions. Each question has a time limit.</li>
                    <li><i class="fas fa-check-circle"></i> You can only answer one question at a time. Once you proceed to the next question, you cannot change your answer in Timed Questions mode.</li>
                    <li><i class="fas fa-check-circle"></i> Points are awarded based on the accuracy and speed of your answers. The faster and more accurate your answer, the higher your points.</li>
                    <li><i class="fas fa-check-circle"></i> If you answer incorrectly, no points will be awarded for that question.</li>
                    <li><i class="fas fa-check-circle"></i> There is no limit to how many times you can play the quiz, but you must wait for the game to reset to start again.</li>
                </ul>
            </section>

            <section>
                <h2><i class="fas fa-cogs"></i> General Etiquette</h2>
                <p>
                    Please be respectful of other players during the game. Any form of cheating, offensive behavior, or harassment will result in disqualification from the game.
                </p>
            </section>

            <section>
                <h2><i class="fas fa-trophy"></i> Scoring & Winning</h2>
                <p>
                    Currently there is no ranking system.You will se your own score in the anaylysis section.
                </p>
            </section>
        </div>

        <div class="footer">
            <p>&copy; 2025 Quiz Game. All Rights Reserved.</p>
        </div>
    </div>

</body>
</html>
