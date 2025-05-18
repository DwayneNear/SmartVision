<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Vision</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional styles for connection states */
        .connected {
            background-color: rgba(46, 204, 113, 0.2) !important;
        }

        /* Sticky Navigation Bar */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px;
            transition: 0.3s;
        }

        nav ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        /* Ensure content is not hidden behind the fixed navbar */
        .content-wrapper {
            padding-top: 60px;
        }

        /* Download button style */
        .download-btn {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #e74c3c;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .download-btn:hover {
            background-color: #c0392b;
        }

        /* Hover box wrapper for download button */
        .download-box {
            display: inline-block;
            padding: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .download-box:hover {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>
    <div class="background-container">
        <video autoplay muted loop id="background-video">
            <source src="video3.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <audio id="background-audio" autoplay loop>
            <source src="audio.mp3" type="audio/mpeg">
            Your browser does not support the audio tag.
        </audio>
        <div class="overlay"></div>
    </div>

    <div class="content-wrapper">
        <header>
            <div class="logo"><span class="red">SMART</span> VISION</div>
            <nav>
                <ul>
                    <li><a href="#home" class="scroll-link">Home</a></li>
                    <li><a href="#third-page" class="scroll-link">Legal Policies</a></li>
                    <li><a href="#next-page" class="scroll-link">About Us</a></li>
                    <li><a href="http://localhost/Smart_Vision/index.php" target="_blank" id="contact-button">Contact</a></li>
                    <li><a href="http://localhost/Smart_Vision/signup.php" id="sign-in-button">Sign up</a></li>
                    <li><a href="http://localhost/Smart_Vision/login_dashboard.php" id="admin-button">Admin</a></li>
                </ul>
            </nav>
        </header>

        <section id="home" class="hero-section">
            <div class="download-section" style="text-align: center; padding: 100px 20px;">
                <h1 style="color: white; font-size: 32px;">Experience the Future of Attendance</h1>
                <p style="color: white; margin-bottom: 30px;">Download the Smart Vision system and streamline your classroom attendance today.</p>
                <div class="download-box">
                    <a href="http://localhost/Smart_Vision/purchase.php" id="dashboard-button" class="download-btn">
                        Download Smart Vision
                    </a>
                </div>
            </div>

            <!-- Google-style scroll indicator -->
            <div class="scroll-indicator">
                <a href="#next-page" class="scroll-link">
                    <div class="chevron"></div>
                    <div class="chevron"></div>
                    <div class="chevron"></div>
                </a>
            </div>
        </section>

        <section id="next-page" class="next_page">
            <div class="hero-page">
                <h1>About Us</h1>
                <div class="additional-content">
                    <h2>Our Services</h2>
                    <p>Revolutionizing attendance tracking with cutting-edge facial recognition technology! Our system automatically detects multiple faces in real time, logs attendance seamlessly, and integrates with Learning Management Systems (LMS) for effortless monitoring. With cloud based & local storage, anti-spoofing measures, and adaptability to different lighting conditions, we ensure accuracy, security, and efficiency in educational institutions.
                    </p>Say goodbye to manual roll calls — experience the future of attendance tracking today!
                    <h2>Our Team</h2>
                    <p>We are a passionate team of innovators dedicated to transforming attendance tracking through AI-driven facial recognition technology. With expertise in software development, machine learning, and system integration, we are committed to creating smart, efficient, and secure solutions for educational institutions.</p>
                    <p>Driven by innovation and a vision for the future, we work tirelessly to ensure seamless automation, real-time monitoring, and enhanced security in classroom attendance systems. Together, we build technology that makes a difference!</p>
                </div>
            </div>
        </section>

        <section id="third-page" class="content-section">
            <div class="container">
                <h2>Legal Policies</h2>
                <p><strong>Privacy Policy</strong><br>
                We value your privacy and are committed to protecting any personal information you share with us. When using SMART VISION, we collect information, such as your name, email address, and usage data, to improve your experience and provide the best service possible. We utilize strong encryption protocols to ensure the safety of your data and restrict access to authorized personnel only. We do not share or sell your personal information to third parties without your consent, unless required by law. Additionally, you have the right to request access to, update, or delete your personal information at any time.</p>

                <p><strong>Terms of Service</strong><br>
                The Terms of Service govern the use of SMART VISION’s platform and services. By using our services, you agree to adhere to these terms. This includes agreeing not to misuse our technology for unlawful purposes, ensuring that you do not engage in activities that may disrupt the functionality of the system, or violate any applicable laws. We also reserve the right to update or change these terms as needed, and we will notify users of significant updates. It’s important to review these terms regularly to stay informed of any changes.</p>

                <p><strong>Disclaimer</strong><br>
                SMART VISION provides facial recognition-based attendance and multi-entry detection systems with the aim of improving efficiency and security in educational institutions. While we strive to offer reliable services, we cannot guarantee that the platform will be error-free or uninterrupted. SMART VISION is provided "as is," and we are not liable for any damages, losses, or inconveniences caused by the use of our services, including technical issues, data breaches, or any failure of the system. It is the responsibility of users to ensure that their data is backed up regularly and to use our platform in accordance with our guidelines.</p>

                <p><strong>Cookie Policy</strong><br>
                SMART VISION uses cookies to enhance your experience on our website. Cookies are small files stored on your device that help us track user behavior and personalize your experience. These cookies also enable us to analyze web traffic and improve our services. You can manage or disable cookies through your browser settings, although this may affect certain features of our platform. By continuing to use our website, you consent to the use of cookies as described in this policy.</p>

                <p><strong>Conclusion</strong><br>
                By using SMART VISION’s services, you acknowledge and accept these legal policies. We reserve the right to modify or update these policies at any time, and any such changes will be communicated to you. For any inquiries or clarifications regarding our policies, feel free to contact us. Your continued use of our platform after any changes to these policies will signify your acceptance of those changes.</p>
            </div>
        </section>
    </div>

    <!-- Import database connection script and main script as modules -->
    <script type="module" src="script.js"></script>
</body>
</html>
