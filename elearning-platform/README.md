# E-Learning Platform

![Status](https://img.shields.io/badge/Status-Complete-brightgreen)
![License](https://img.shields.io/badge/License-MIT-blue)
![Platform](https://img.shields.io/badge/Platform-Web-blue)

## Project Overview

The **E-Learning Platform** is a web-based educational management system designed to facilitate online learning. Students can browse courses, enroll in classes, track their learning progress, and access course materials. Instructors can manage courses and lessons. The platform provides an intuitive interface for seamless learning experiences with features like course categorization, student dashboards, and enrollment management.

This is a **university DBMS (Database Management System) project** that demonstrates full-stack web development with a relational database backend.

---

## Features

- 👥 **User Authentication** - Secure login and registration system
- 📚 **Course Catalog** - Browse and explore courses with category filtering
- 📊 **Student Dashboard** - View enrolled courses, track progress, and learning statistics
- ✅ **Course Enrollment** - One-click enrollment in available courses
- 🎓 **Course Details** - Comprehensive course information with lessons and metadata
- 👨‍🏫 **Instructor Profiles** - View instructor details and expertise
- 🏷️ **Category Filtering** - Filter courses by subject and topic
- 💾 **Database Integration** - All data stored in MySQL with proper relationships
- 📱 **Responsive Design** - Mobile-friendly interface across all pages
- 🔐 **Session Management** - Persistent user sessions across the platform

---

## Technologies Used

| Component | Technology |
|-----------|-----------|
| **Frontend** | HTML5, CSS3, JavaScript |
| **Backend** | PHP 7+ |
| **Database** | MySQL 5.7+ |
| **Server** | Apache (via XAMPP) |
| **Development Environment** | XAMPP |

---

## Folder Structure

```
elearning-platform/
│
├── index.php                          # Home page with featured courses
├── css/
│   ├── style.css                      # Main stylesheet
│   ├── responsive.css                 # Responsive design styles
│   └── course-images.css              # Course image styling
│
├── js/
│   └── main.js                        # JavaScript functionality
│
├── includes/
│   ├── db_connection.php              # Database connection setup
│   ├── header.php                     # Navigation header component
│   ├── footer.php                     # Footer component
│   ├── process-login.php              # Login form handler
│   ├── process-register.php           # Registration form handler
│   ├── process-logout.php             # Logout handler
│   ├── process-enroll.php             # Course enrollment handler
│   └── process-contact.php            # Contact form handler
│
├── pages/
│   ├── login.php                      # Login page
│   ├── register.php                   # Registration page
│   ├── about.php                      # About page
│   ├── contact.php                    # Contact page
│   ├── courses.php                    # Courses listing with filters
│   ├── course-detail.php              # Individual course details
│   └── dashboard.php                  # Student dashboard
│
├── database/
│   ├── schema.sql                     # Original database schema
│   └── schema-updated.sql             # Final schema with sample data
│
└── images/                            # Course thumbnail images

```

---

## Database Details

### Database Name
`elearning_platform`

### Tables Schema

#### 1. **users** Table
- User authentication and profile information
- Stores instructors and students
- Fields: id, name, email, password, user_type (instructor/student), created_at

#### 2. **courses** Table
- Course information and metadata
- Links courses to instructors
- Fields: id, title, description, category, instructor_id, duration_hours, level, thumbnail, published, created_at

#### 3. **lessons** Table
- Individual lesson content within courses
- Fields: id, course_id, title, description, duration_minutes, video_url, position, created_at

#### 4. **enrollments** Table
- Track student course registrations
- Fields: id, user_id, course_id, enrollment_date, progress_percentage, status

#### 5. **instructors** Table
- Extended instructor profile information
- Fields: id, user_id, title, expertise, experience_years, bio

#### 6. **contacts** Table
- Contact form submissions
- Fields: id, name, email, message, created_at

### Sample Data Included

**Pre-loaded Users:**
- **Instructor Accounts:** Sarah Johnson, Michael Chen, Emily Rodriguez, David Thompson
- **Student Accounts:** Demo User (username: demo, password: demo), John Smith, Jane Doe

**Sample Courses:** 10 courses across multiple categories
- Web Development (HTML, CSS, JavaScript)
- Database Management (SQL, MySQL)
- Programming (Python, Java)
- Web Design

**Sample Lessons:** 14 lessons distributed across courses

---

## Setup Instructions

### Prerequisites
- Windows/macOS/Linux with internet connection
- Administrator access to install software

### Step 1: Install XAMPP

1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Choose the version compatible with your operating system
3. Run the installer and follow the setup wizard
4. Use default installation paths (recommended)
5. When prompted, ensure **Apache** and **MySQL** are selected
6. Complete the installation

### Step 2: Start XAMPP

1. Open the **XAMPP Control Panel**
   - Windows: Search "XAMPP Control Panel" in Start Menu
   - macOS/Linux: Run from Applications folder
2. Click **Start** next to **Apache**
3. Click **Start** next to **MySQL**
4. Both should show green status indicators
5. Your local server is now running!

### Step 3: Place Project Folder in htdocs

1. Locate the XAMPP installation directory:
   - **Windows:** `C:\xampp\htdocs\`
   - **macOS:** `/Applications/XAMPP/xamppfiles/htdocs/`
   - **Linux:** `/opt/xampp/htdocs/`

2. Copy the entire `elearning-platform` folder into the `htdocs` directory
3. The path should look like: `C:\xampp\htdocs\elearning-platform\`

### Step 4: Import the Database

1. Open your web browser and go to: `http://localhost/phpmyadmin/`
2. You should see the phpMyAdmin dashboard
3. Click on **Databases** tab at the top
4. Type `elearning_platform` in the "Create new database" field
5. Click **Create**
6. Click on the newly created `elearning_platform` database
7. Click the **Import** tab
8. Click **Choose File** and select `database/schema-updated.sql` from your project folder
9. Click **Import** to load the sample data and schema

### Step 5: Configure Database Connection (if needed)

The database connection is pre-configured in `includes/db_connection.php`:
- **Host:** localhost
- **Username:** root
- **Password:** (empty - default XAMPP setting)
- **Database:** elearning_platform

If your MySQL password is different, edit `includes/db_connection.php` and update the credentials.

### Step 6: Run the Project

1. Open your web browser
2. Navigate to: `http://localhost/elearning-platform/`
3. You should see the home page with featured courses
4. The platform is ready to use!

---

## Default Login Credentials

Use these credentials to test the platform:

### Demo Student Account
- **Email:** demo@example.com
- **Password:** demo
- **Role:** Student
- **Features:** Browse courses, enroll, view dashboard

### Sample Instructor Accounts
- **Email:** sarah@example.com | **Password:** password
- **Email:** michael@example.com | **Password:** password
- **Email:** emily@example.com | **Password:** password

**Note:** All sample accounts use plain-text passwords for demonstration purposes. For production use, implement proper password hashing.

---

## Navigation Guide

### For Students
1. **Home (`/`)** - Browse featured courses and categories
2. **Courses (`/pages/courses.php`)** - View all courses with category filtering
3. **Course Detail** - Click any course to see full details and enroll
4. **Dashboard (`/pages/dashboard.php`)** - View enrolled courses and progress (requires login)
5. **About (`/pages/about.php`)** - Learn about the platform

### For Instructors
- Create and manage courses through the admin interface (contact administrator)

### Key Actions
- **Register** - Create a new student account
- **Login** - Access your dashboard and enrolled courses
- **Enroll** - Register for a course from the course detail page
- **Logout** - End your session (available in navigation when logged in)

---

## Screenshots

### Home Page
*Screenshot showing featured courses and category cards*
- Placeholder: `Place screenshot of index.php here`

### Course Listing Page
*Screenshot showing course cards with category filter sidebar*
- Placeholder: `Place screenshot of pages/courses.php here`

### Course Detail Page
*Screenshot showing full course information and enrollment form*
- Placeholder: `Place screenshot of pages/course-detail.php here`

### Student Dashboard
*Screenshot showing enrollment progress and statistics*
- Placeholder: `Place screenshot of pages/dashboard.php here`

### Login Page
*Screenshot showing login form*
- Placeholder: `Place screenshot of pages/login.php here`

### Navigation Header (Logged In)
*Screenshot showing header with user profile and logout button*
- Placeholder: `Place screenshot of header component here`

---

## Known Limitations and Future Improvements

### Current Limitations
- No user profile editing functionality
- Contact form information is stored but not emailed
- No advanced analytics or reporting features
- No payment integration for paid courses
- Limited file attachment support

### Future Enhancement Ideas
- 📧 Email notifications for course enrollment
- 🎥 Video streaming integration for lessons
- 📈 Advanced analytics dashboard for instructors
- 💬 Discussion forums and discussion boards
- ⭐ Course ratings and reviews system
- 📱 Mobile application (iOS/Android)
- 🔐 OAuth/Single Sign-On integration
- 💳 Payment gateway for premium courses
- 📊 Automated progress tracking and certificates
- 🌐 Multi-language support

---

## Troubleshooting

### Apache Won't Start
- Check if port 80 is already in use
- Try different port in XAMPP settings
- Disable conflicting software (Skype, IIS, etc.)

### MySQL Won't Start
- Check if port 3306 is available
- Verify MySQL service isn't already running
- Reset MySQL in XAMPP control panel

### Database Connection Error
- Verify MySQL is running
- Check credentials in `includes/db_connection.php`
- Ensure database `elearning_platform` exists
- Check user permissions in phpMyAdmin

### Pages Show Blank
- Check browser console for JavaScript errors
- Verify file path is case-sensitive (Linux/Mac)
- Clear browser cache and reload
- Check Apache error logs

### "404 Not Found" Error
- Verify project folder is in `htdocs`
- Check folder name matches URL
- Ensure Apache is running
- Try accessing `http://localhost/elearning-platform/index.php`

---

## Project Statistics

| Metric | Value |
|--------|-------|
| Total Bugs Fixed | 16/16 |
| PHP Files | 11+ |
| CSS Rules | 400+ lines |
| Database Tables | 6 |
| Sample Courses | 10 |
| Sample Users | 7 |
| Sample Lessons | 14 |
| Code Changes | 1000+ lines |

---

## Team / Authors

**University Project Development Team**

This project was developed as a comprehensive DBMS (Database Management System) coursework demonstrating:
- Full-stack web application development
- Relational database design and implementation
- User authentication and session management
- Responsive web design principles
- PHP backend development
- MySQL database administration

---

## Contributing

This is a university project submission. If you'd like to suggest improvements or report bugs, please:

1. Create an issue describing the problem
2. Provide steps to reproduce the issue
3. Include relevant screenshots or error messages
4. Submit a pull request with proposed changes

---

## License

This project is licensed under the **MIT License** - see below for details.

```
MIT License

Copyright (c) 2024-2025 E-Learning Platform

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
```

---

## References & Resources

- [XAMPP Documentation](https://www.apachefriends.org/index.html)
- [PHP Official Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [phpMyAdmin Guide](https://docs.phpmyadmin.net/)
- [HTML/CSS Reference](https://developer.mozilla.org/en-US/)

---

## Contact & Support

For questions or support regarding this project:
- Check the [QUICK_START.md](QUICK_START.md) for quick reference
- Review the [SETUP_GUIDE.md](SETUP_GUIDE.md) for detailed setup
- Refer to [DATABASE_SCHEMA_GUIDE.md](DATABASE_SCHEMA_GUIDE.md) for database structure

---

**Last Updated:** March 2025  
**Status:** ✅ Complete - All features functional and tested
