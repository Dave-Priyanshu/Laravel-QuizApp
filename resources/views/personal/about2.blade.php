<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Priyanshu Dave</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
</head>
<body>

<div class="profile-header"></div>

<div class="profile-picture">
    <img src="{{ asset('images/default-profile.png') }}" alt="Profile Picture">
</div>

<div class="profile-info">
    <h1>Priyanshu Dave</h1>
    <p class="job-title">Software Developer | Laravel & Magento Enthusiast</p>
    <p><strong>Location:</strong> Ahmedabad, India</p>
    <div class="action-buttons">
            <a href="javascript:void(0);" onclick="copyEmail()">
                <button>
                    <i class="fas fa-envelope"></i> Email
                </button>
            </a>
            <a href="https://github.com/Dave-Priyanshu">
                <button>
                    <i class="fab fa-github"></i> Github
                </button>
            </a>
            <a href="https://www.linkedin.com/in/priyanshu-dave2001/">
                <button>
                    <i class="fab fa-linkedin"></i> linkedin
                </button>
            </a>
    </div>
</div>

<div class="section">
    <h2>About</h2>
    <p>I’m a passionate software developer with experience in Laravel and Magento. Skilled in Software design,testing, Agile Frameworks and Problem Solving Fimiliar with front-end tech(Vue Js, HTML, CSS, JS), databases(SQL, Firebase). Strong problem-solving and communication skills. Also adept at leveraging AI tools for innovative solutions.</p>
</div>
<div class="section">
    <h2>Experience</h2>
    <!-- PHP Trainee at Abbacus Technologies -->
    <div class="experience-item">
        <div class="job-header">
            <h3><strong>PHP Trainee</strong> at <span class="company-name">Abbacus Technologies</span></h3>
            <p class="job-duration">January 2024 - March 2024</p>
            <p class="job-location"><strong>Location:</strong> Ahmedabad, India</p>
        </div>
        <p class="job-description">
            During my time as a PHP Trainee, I developed a Task Management System and a Food Ordering System using Core PHP and OOP concepts. I gained hands-on experience in working with PHP in a real-world setting and collaborated with senior developers to learn and apply industry best practices.
        </p>
    </div>

  <!-- PHP Developer at Abbacus Technologies -->
<div class="experience-item">
    <div class="job-header">
        <h3><strong>PHP Developer</strong> at <span class="company-name">Abbacus Technologies</span></h3>
        <p class="job-duration">March 2024 - Present</p>
        <p class="job-location"><strong>Location:</strong> Ahmedabad, India</p>
    </div>
    <p class="job-description">
        As a PHP Developer, I gained extensive experience in developing and maintaining web applications using Laravel and Magento. I successfully upgraded multiple websites to the latest Magento versions, ensuring smooth transitions and improved functionality. Additionally, I created and updated many custom Magento modules to meet specific business needs, which are available in my <a href="https://github.com/Dave-Priyanshu/Magento2-Custom-Modules" target="_blank" class="text-blue-600 hover:underline">GitHub repository</a>.
    </p>

    <p>To expand my skills, I developed several independent projects:</p>

    <!-- Project container for 3 projects in a row -->
    <div class="projects-container">
        <!-- Project 1: LaraQuiz Game -->
        <div class="project">
            <h4><strong>LaraQuiz Game</strong></h4>
            <p>A live interactive quiz application built with Laravel 11. This project is designed to help users test their knowledge in various topics through quizzes. It features user authentication with OTP verification, quiz management, and score tracking.</p>
            <p><strong>Live Site:</strong> <a href="https://lara-quiz.wuaze.com/home" target="_blank" class="text-blue-600 hover:underline">Visit LaraQuiz Game</a></p>
            <p><strong>GitHub Repository:</strong> <a href="https://github.com/Dave-Priyanshu/Laravel-QuizApp" target="_blank" class="text-gray-600 hover:text-blue-600 ml-2"><i class="fab fa-github"></i> GitHub</a></p>
        </div>

        <!-- Project 2: Job Posting Website -->
        <div class="project">
            <h4><strong>Job Posting Website</strong></h4>
            <p>This web application allows users to post and apply for jobs. It includes features like job listings, user registration, and application management, all powered by Laravel.</p>
            <p><strong>Live Site:</strong> <a href="javascript:void(0);" target="_blank" class="text-blue-600 hover:underline">Visit Job Posting Website</a></p>
            <p><strong>GitHub Repositories:</strong> <a href="https://github.com/Dave-Priyanshu/JobPortal-LaravelApp" target="_blank" class="text-gray-600 hover:text-blue-600 ml-2"><i class="fab fa-github"></i> Job Portal</a> | <a href="https://github.com/Dave-Priyanshu/JobPortal-Second" target="_blank" class="text-gray-600 hover:text-blue-600 ml-2"><i class="fab fa-github"></i> Job Posting Site</a></p>
        </div>

        <!-- Project 3: Blog Posting Website -->
        <div class="project">
            <h4><strong>Blog Posting Website</strong></h4>
            <p>A platform for creating and publishing blog posts. The site features a simple content management system where users can post, edit, and manage blog entries.</p>
            <p><strong>Live Site:</strong> <a href="javascript:void(0);" target="_blank" class="text-blue-600 hover:underline">Visit Blog Posting Website</a></p>
            <p><strong>GitHub Repository:</strong> <a href="https://github.com/Dave-Priyanshu/Laravel-BlogPost" target="_blank" class="text-gray-600 hover:text-blue-600 ml-2"><i class="fab fa-github"></i> GitHub</a></p>
        </div>
    </div>

    <p>My journey has been primarily self-taught, demonstrating my ability to learn and adapt quickly to evolving technologies.</p>
</div>

</div>

<div class="section">
    <h2>Education</h2>

    <div class="education-item">
        <h4><strong>L.J Institute of Computer Application</strong></h4>
        <p>2019 - 2024</p>
        <p>Integrated Master of Computer Application (CPI - 7.74)</p>
    </div>

    <div class="education-item">
        <h4><strong>Shraddha VidyaMandir</strong></h4>
        <p>March 2019</p>
        <p>Higher Secondary Board (Percentile - 89.36)</p>
    </div>

    <div class="education-item">
        <h4><strong>Shraddha VidyaMandir</strong></h4>
        <p>March 2017</p>
        <p>Secondary School Certificate (Percentile - 80.45)</p>
    </div>
</div>


<div class="section">
    <h2>Techincal Skills</h2>
    <div class="skills-container">
        <span class="skill-badge">HTML</span>
        <span class="skill-badge">CSS</span>
        <span class="skill-badge">Tailwind CSS</span>
        <span class="skill-badge">JavaScript</span>
        <span class="skill-badge">PHP</span>
        <span class="skill-badge">MySQl</span>
        <span class="skill-badge">Laravel</span>
        <span class="skill-badge">Vue Js</span>
        <span class="skill-badge">Magento</span>
        <span class="skill-badge">Git & Github</span>
    </div>
    <h2>Project Management & Collaboration</h2>
    <div class="skills-container">
        <span class="skill-badge">Requirement Analysis</span>
        <span class="skill-badge">Project Planning & Execution</span>
        <span class="skill-badge">Analytical Skills</span>
        <span class="skill-badge">Communication</span>
        <span class="skill-badge">Teamwork</span>
        <span class="skill-badge">Decision Making</span>
    </div>  
    <h2>Communication & Documentation</h2>
    <div class="skills-container">
        <span class="skill-badge">Verbal & Written Communication</span>
        <span class="skill-badge">Technical Doucumentation</span>
        <span class="skill-badge">Presentation Skills</span>
        <span class="skill-badge">Project Documentation</span>
    </div>  
    {{-- <div class="skill-bar-container">
        <label>Laravel</label>
        <div class="skill-bar">
            <div class="skill-bar-fill laravel">90%</div>
        </div>
        <label>Vue Js</label>
        <div class="skill-bar">
            <div class="skill-bar-fill laravel">40%</div>
        </div>
        <label>Magento</label>
        <div class="skill-bar">
            <div class="skill-bar-fill magento">50%</div>
        </div>
        <label>PHP</label>
        <div class="skill-bar">
            <div class="skill-bar-fill php">80%</div>
        </div>
        <label>HTML</label>
        <div class="skill-bar">
            <div class="skill-bar-fill html">50%</div>
        </div>
        <label>CSS</label>
        <div class="skill-bar">
            <div class="skill-bar-fill css">50%</div>
        </div>
        <label>JavaScript</label>
        <div class="skill-bar">
            <div class="skill-bar-fill javascript">40%</div>
        </div>
        <label>Git & Github</label>
        <div class="skill-bar">
            <div class="skill-bar-fill Git & Github">40%</div>
        </div>
    </div> --}}
</div>

<div class="section">
    <h2>Projects</h2>
    
    <!-- LaraQuiz Game -->
    <p><strong>LaraQuiz Game</strong> - A live interactive quiz application built with Laravel 11. It features user authentication, quiz management, and score tracking. 
        <a href="https://lara-quiz.wuaze.com/home" target="_blank" class="text-blue-600 hover:underline">Visit Live Site</a> | 
        <a href="https://github.com/Dave-Priyanshu/Laravel-QuizApp" target="_blank" class="text-blue-600 hover:underline">View GitHub</a>
    </p>

    <!-- Job Posting Website -->
    <p><strong>Job Posting Website</strong> - A web application that allows users to post and apply for jobs, with features like job listings and user registration. 
        {{-- <a href="javascript:void(0);" target="_blank" class="text-blue-600 hover:underline">Visit Live Site</a> |  --}}
        <a href="https://github.com/Dave-Priyanshu/JobPortal-LaravelApp" target="_blank" class="text-blue-600 hover:underline">View GitHub</a> 
        {{-- <a href="https://github.com/Dave-Priyanshu/JobPortal-Second" target="_blank" class="text-blue-600 hover:underline">View GitHub (Secondary)</a> --}}
    </p>

    <!-- Blog Posting Website -->
    <p><strong>Blog Posting Website</strong> - A platform for creating and publishing blog posts with a simple content management system. 
        {{-- <a href="javascript:void(0);" target="_blank" class="text-blue-600 hover:underline">Visit Live Site</a> |  --}}
        <a href="https://github.com/Dave-Priyanshu/Laravel-BlogPost" target="_blank" class="text-blue-600 hover:underline">View GitHub</a>
    </p>

    <!-- Magento Customization -->
    <p><strong>Magento Customization</strong> - Custom features for a Magento 2 platform. [<a href="https://github.com/Dave-Priyanshu/Magento2-Custom-Modules">View Project</a>]</p>
</div>

<div class="section">
    <h2>Interests</h2>
    <p>Drums, Gaming, Workout, Video Editing</p>
</div>

<div class="section">
    <h2>Languages</h2>
    <p>Hindi, English,Gujarati</p>
</div>

<!-- Notification Pop-up -->
<div class="notification" id="notification">
    Email copied to clipboard!
</div>

<script>
    function copyEmail() {  
            const email = "priyanshu@example.com";
            navigator.clipboard.writeText(email).then(() => {
                const notification = document.getElementById('notification');
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 2000);
            });
        }
</script>

</body>
</html>
