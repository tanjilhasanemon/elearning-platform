-- ============================================
-- E-LEARNING PLATFORM - DATABASE SCHEMA (FINAL)
-- ============================================
-- COMPLETE database setup with tables + sample data + all fixes
-- This is the ONLY file you need to create your complete database
-- 
-- INSTRUCTIONS:
-- 1. Open phpMyAdmin (usually at http://localhost/phpmyadmin)
-- 2. Create a new database named 'elearning_db'
-- 3. Select the database and go to SQL tab
-- 4. Copy and paste ALL code from this file
-- 5. Click "Go" to execute
-- 6. Done! Database is ready with sample data

-- ============================================
-- CREATE DATABASE
-- ============================================
CREATE DATABASE IF NOT EXISTS elearning_db;
USE elearning_db;

-- ============================================
-- USERS TABLE
-- ============================================
-- Stores information about all users (students, instructors, admins)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255),
    bio TEXT,
    role ENUM('student', 'instructor', 'admin') DEFAULT 'student',
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (email),
    INDEX (role)
);

-- ============================================
-- COURSES TABLE
-- ============================================
-- Stores all course information
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    instructor_id INT NOT NULL,
    thumbnail VARCHAR(255),
    level ENUM('beginner', 'intermediate', 'advanced') DEFAULT 'beginner',
    price DECIMAL(10, 2) DEFAULT 0.00,
    rating DECIMAL(3, 1) DEFAULT 0.0,
    students_count INT DEFAULT 0,
    duration_hours INT,
    lessons_count INT,
    status ENUM('published', 'draft', 'archived') DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES users(id),
    INDEX (category),
    INDEX (instructor_id)
);

-- ============================================
-- INSTRUCTORS TABLE
-- ============================================
-- Stores detailed information about instructors
CREATE TABLE IF NOT EXISTS instructors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    title VARCHAR(100),
    expertise TEXT,
    experience_years INT,
    courses_created INT DEFAULT 0,
    students_taught INT DEFAULT 0,
    rating DECIMAL(3, 1) DEFAULT 0.0,
    bio TEXT,
    social_twitter VARCHAR(255),
    social_linkedin VARCHAR(255),
    social_website VARCHAR(255),
    verification_status ENUM('verified', 'unverified') DEFAULT 'unverified',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    INDEX (user_id)
);

-- ============================================
-- ENROLLMENTS TABLE
-- ============================================
-- Stores course enrollments and student progress
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completion_percentage INT DEFAULT 0,
    status ENUM('active', 'completed', 'dropped') DEFAULT 'active',
    certificate_earned BOOLEAN DEFAULT FALSE,
    certificate_date DATETIME,
    last_access DATETIME,
    performance_rating DECIMAL(3, 1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    UNIQUE KEY unique_enrollment (student_id, course_id),
    INDEX (student_id),
    INDEX (course_id),
    INDEX (status)
);

-- ============================================
-- LESSONS TABLE
-- ============================================
-- Stores individual lessons within courses
CREATE TABLE IF NOT EXISTS lessons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    video_url VARCHAR(255),
    content TEXT,
    duration_minutes INT,
    lesson_number INT,
    resources VARCHAR(255),
    quiz_available BOOLEAN DEFAULT FALSE,
    status ENUM('published', 'draft') DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    INDEX (course_id)
);

-- ============================================
-- TESTIMONIALS TABLE
-- ============================================
-- Stores student testimonials and reviews
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT,
    display_name VARCHAR(100),
    display_photo VARCHAR(255),
    verified BOOLEAN DEFAULT FALSE,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    INDEX (course_id),
    INDEX (status)
);

-- ============================================
-- CONTACT MESSAGES TABLE
-- ============================================
-- Stores contact form submissions
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'responded') DEFAULT 'new',
    response TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (email),
    INDEX (status)
);

-- ============================================
-- CATEGORIES TABLE
-- ============================================
-- Stores course categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    icon VARCHAR(255),
    courses_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- PROGRESS TABLE
-- ============================================
-- Tracks lesson progress for students
CREATE TABLE IF NOT EXISTS progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enrollment_id INT NOT NULL,
    lesson_id INT NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    completion_date DATETIME,
    quiz_score INT,
    time_spent_minutes INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (enrollment_id) REFERENCES enrollments(id),
    FOREIGN KEY (lesson_id) REFERENCES lessons(id),
    UNIQUE KEY unique_progress (enrollment_id, lesson_id),
    INDEX (enrollment_id),
    INDEX (lesson_id)
);

-- ============================================
-- SAMPLE DATA - USERS
-- ============================================
-- Demo instructor users
INSERT INTO users (fullname, email, password, role, bio) VALUES
('Sarah Johnson', 'sarah@example.com', 'sarah123', 'instructor', 'Web Design Expert with 10+ years experience'),
('Michael Chen', 'michael@example.com', 'michael123', 'instructor', 'Database Design Specialist'),
('Emily Rodriguez', 'emily@example.com', 'emily123', 'instructor', 'JavaScript Expert'),
('David Williams', 'david@example.com', 'david123', 'instructor', 'PHP Backend Developer');

-- Demo student users
INSERT INTO users (fullname, email, password, role) VALUES
('Demo User', 'demo@example.com', 'password123', 'student'),
('John Smith', 'john@example.com', 'john123', 'student'),
('Jane Doe', 'jane@example.com', 'jane123', 'student');

-- ============================================
-- SAMPLE DATA - COURSES (with thumbnail images properly linked)
-- ============================================
INSERT INTO courses (title, description, category, instructor_id, thumbnail, level, price, rating, duration_hours, lessons_count, status, students_count) VALUES
('Modern Web Design Fundamentals', 'Learn the essentials of creating beautiful and responsive websites using HTML, CSS, and JavaScript.', 'Web Development', 1, 'course-web-design.png', 'beginner', 49.99, 4.9, 20, 15, 'published', 1250),
('Database Design with MySQL', 'Master database design principles and learn SQL queries to build scalable applications.', 'Database', 2, 'course-database.png', 'intermediate', 59.99, 4.8, 25, 18, 'published', 850),
('JavaScript for Interactive Web', 'Learn JavaScript fundamentals and create interactive web experiences your users will love.', 'JavaScript', 3, 'course-javascript.png', 'beginner', 49.99, 4.9, 22, 16, 'published', 2100),
('Backend Development with PHP', 'Build dynamic web applications using PHP and understand server-side programming concepts.', 'Programming', 4, 'course-php.png', 'intermediate', 59.99, 4.7, 24, 17, 'published', 650),
('Responsive Web Design', 'Create mobile-friendly websites that look perfect on all devices using modern CSS techniques.', 'Web Development', 1, 'course-responsive.png', 'beginner', 49.99, 4.8, 18, 14, 'published', 1800),
('Full Stack Web Development', 'Become a complete web developer by learning frontend, backend, and database technologies together.', 'Web Development', 2, 'course-fullstack.png', 'advanced', 99.99, 4.9, 50, 32, 'published', 500),
('Python for Beginners', 'Start your programming journey with Python. Learn basics, functions, and object-oriented programming.', 'Programming', 2, 'course-python.png', 'beginner', 39.99, 4.8, 20, 15, 'published', 1500),
('Advanced CSS Techniques', 'Master advanced CSS including flexbox, grid, animations, and modern design patterns.', 'Web Development', 1, 'course-advanced-css.png', 'intermediate', 54.99, 4.7, 16, 12, 'published', 600),
('SQL Mastery Bootcamp', 'Learn advanced SQL for database queries, optimization, and data analysis.', 'Database', 2, 'course-sql.png', 'intermediate', 69.99, 4.9, 28, 20, 'published', 400),
('React.js Fundamentals', 'Build modern web applications with React. Learn components, hooks, and state management.', 'JavaScript', 3, 'course-react.png', 'intermediate', 64.99, 4.8, 26, 19, 'published', 900);

-- ============================================
-- SAMPLE DATA - LESSONS
-- ============================================
INSERT INTO lessons (course_id, title, description, duration_minutes, lesson_number, status) VALUES
(1, 'Introduction to Web Design', 'Learn the basics of web design and what you will achieve in this course.', 15, 1, 'published'),
(1, 'HTML Fundamentals', 'Master HTML structure, semantic markup, and best practices.', 45, 2, 'published'),
(1, 'CSS Basics and Styling', 'Learn CSS selectors, properties, and create beautiful designs.', 50, 3, 'published'),
(1, 'Responsive Design with CSS', 'Create layouts that work on all devices using media queries.', 40, 4, 'published'),

(2, 'Database Concepts', 'Understand relational databases and normalization.', 30, 1, 'published'),
(2, 'SQL Basics', 'Learn SELECT, INSERT, UPDATE, DELETE statements.', 50, 2, 'published'),
(2, 'Advanced SQL Queries', 'Master JOINs, subqueries, and complex queries.', 55, 3, 'published'),

(3, 'JavaScript Syntax and Variables', 'Learn JavaScript basics including variables, data types, and operators.', 40, 1, 'published'),
(3, 'Functions and Scope', 'Understand functions, scope, and closures in JavaScript.', 45, 2, 'published'),
(3, 'DOM Manipulation', 'Learn how to interact with HTML elements using JavaScript.', 50, 3, 'published'),

(4, 'PHP Basics', 'Introduction to PHP syntax and fundamentals.', 35, 1, 'published'),
(4, 'Working with Forms', 'Handle form submissions and validate user input.', 40, 2, 'published'),
(4, 'Database Integration', 'Connect PHP applications to MySQL databases.', 50, 3, 'published');

-- ============================================
-- SAMPLE DATA - INSTRUCTORS
-- ============================================
INSERT INTO instructors (user_id, title, experience_years, courses_created) VALUES
(1, 'Senior Web Designer', 10, 5),
(2, 'Database Administrator', 12, 4),
(3, 'JavaScript Developer', 8, 3),
(4, 'Full Stack Developer', 9, 4);

-- ============================================
-- VERIFICATION QUERIES
-- ============================================
-- Uncomment the queries below to verify your data:
-- SELECT COUNT(*) AS total_users FROM users;
-- SELECT COUNT(*) AS total_courses FROM courses;
-- SELECT id, title, thumbnail FROM courses;
-- SELECT * FROM users WHERE role = 'instructor';

-- ============================================
-- TEST CREDENTIALS
-- ============================================
-- Demo Account:
--   Email: demo@example.com
--   Password: password123
--   Role: student
--
-- Instructor Accounts:
--   Email: sarah@example.com, Password: sarah123
--   Email: michael@example.com, Password: michael123
--   Email: emily@example.com, Password: emily123
--   Email: david@example.com, Password: david123
--
-- Student Accounts:
--   Email: john@example.com, Password: john123
--   Email: jane@example.com, Password: jane123
--
-- NOTE: All passwords stored in PLAIN TEXT for this demo
-- For PRODUCTION: Use proper password hashing with password_hash() and password_verify()

-- ============================================
-- DATABASE READY!
-- ============================================
-- Your complete database is now set up with:
-- ✓ All 9 tables created
-- ✓ Sample data loaded
-- ✓ All course thumbnails properly linked
-- ✓ Test accounts created
-- Start developing your e-learning platform!
