📘 StudentHub – Student Community Portal
🚀 Overview

StudentHub is a web-based student community portal where like-minded students can gather, discuss technological advancements, and share their ideas & projects.
It’s built using PHP, MySQL, Bootstrap 5, and CSS with a modern design, including a background image and white text for readability.

✨ Features

🔐 User Authentication – Register, Login, Logout

📝 Post Creation – Students can share articles, project ideas, and research

💬 Discussions – Comment on posts (extendable)

👤 User Profiles – View profile details

🎨 Modern UI – Responsive Bootstrap 5, background image, white text

⚙️ Technologies Used

Frontend: HTML5, CSS3, Bootstrap 5

Backend: PHP 8

Database: MySQL / MariaDB

Server: Apache (XAMPP / LAMP / MAMP)

📂 Project Structure
community-portal/
├─ public/
│  ├─ index.php        # homepage
│  ├─ register.php     # user signup
│  ├─ login.php        # user login
│  ├─ logout.php       # user logout
│  ├─ new_post.php     # create a new post
│  ├─ post.php         # view a single post
│  ├─ profile.php      # user profile
│  └─ assets/
│     ├─ css/styles.css
│     └─ images/img.jpg
├─ includes/
│  ├─ config.php       # DB connection + session
│  ├─ header.php       # top navigation + background
│  └─ footer.php       # footer
└─ sql/
   └─ init.sql         # database setup

🛠️ Installation & Setup

Clone / Copy Project
Place community-portal/ inside your htdocs/ (XAMPP) or www/ folder.

Create Database

Open http://localhost/phpmyadmin

Import sql/init.sql

Configure Database
Edit includes/config.php if your DB username/password differs:

$host = "127.0.0.1";
$db   = "community_portal";
$user = "root"; 
$pass = "";


Run Project
Open in browser:

http://localhost/community-portal/public/

🎯 Future Enhancements

✅ Add comment system for posts

✅ Like/Dislike functionality

✅ Real-time chat between users

✅ Admin panel for moderation

👨‍💻 Author

Developed as a model technical project for students exploring community platforms and PHP development.