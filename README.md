# 🎓 E-Learning Platform

**Educational Management System** | PHP + MySQL | University DBMS Project ✅

---

## ⚡ Quick Setup (5 Steps)

1. **Extract** → `C:\xampp\htdocs\elearning-platform\`
2. **Start** Apache & MySQL (XAMPP Control Panel)
3. **Create** `elearning_db` in phpMyAdmin (http://localhost/phpmyadmin)
4. **Import** `database/schema-FINAL.sql` via SQL tab
5. **Access** http://localhost/elearning-platform/

---

## 📝 Default Login Credentials

### Student Account
```
Email: student@example.com
Password: password123
```

### Instructor Account
```
Email: instructor@example.com
Password: password123
```

### Demo Account
```
Email: demo@example.com
Password: password123
```

---

## 📄 All Pages

| Home | Courses | Course Detail | Dashboard | Login | Register | About | Contact |

---

## 💾 Database Structure

**9 Tables:** users • courses • enrollments • lessons • progress • instructors • testimonials • categories • contact_messages

**Relationships:**
- courses → users (instructor_id)
- enrollments → courses + users
- lessons → courses
- progress → enrollments + lessons
- testimonials → courses + users

---

## 🗂️ Project Structure

```
elearning-platform/
├── index.php                    # Home page
├── css/                         # Stylesheets
│   ├── style.css               # Main styles
│   ├── responsive.css          # Mobile responsive
│   └── course-images.css       # Image styling
├── js/                         # JavaScript
│   └── main.js                 # Menu & validation
├── includes/                   # Components
│   ├── db_connection.php       # Database config
│   ├── header.php              # Navigation
│   ├── footer.php              # Footer
│   ├── process-login.php       # Login handler
│   ├── process-register.php    # Register handler
│   ├── process-logout.php      # Logout handler
│   ├── process-enroll.php      # Enrollment handler
│   └── process-contact.php     # Contact handler
├── pages/                      # All pages
│   ├── login.php
│   ├── register.php
│   ├── courses.php
│   ├── course-detail.php
│   ├── dashboard.php
│   ├── about.php
│   └── contact.php
├── database/                   # Database
│   └── schema-FINAL.sql        # Full schema + sample data
└── images/                     # Assets (20+ images)
```

---

## ⚙️ Key Configuration

**Database Connection:** `includes/db_connection.php`
```php
$servername = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "elearning_db";
```

---

## 🔧 Features

✅ User Authentication (Login/Register)
✅ Course Browsing & Filtering
✅ Course Enrollment System
✅ Student Dashboard
✅ Progress Tracking
✅ Responsive Mobile Design
✅ Contact Form
✅ Session Management
✅ Database-driven Content

---

## 🛠 Tech Stack

| Component | Technology |
|-----------|-----------|
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP 7.4+ |
| Database | MySQL 5.7+ |
| Server | Apache (XAMPP) |

---

## 🆘 Troubleshooting

| Issue | Solution |
|-------|----------|
| DB connection fails | Check MySQL running; verify `db_connection.php` |
| Blank page | Check PHP errors (F12 > Console) |
| Images missing | Verify `images/` folder & file names |
| Sessions not working | Clear cookies; ensure `session_start()` is first |

---

## ✅ Setup Checklist

- [ ] Extract to `C:\xampp\htdocs\elearning-platform\`
- [ ] Start Apache & MySQL
- [ ] Create `elearning_db` in phpMyAdmin
- [ ] Import `schema-FINAL.sql`
- [ ] Verify `db_connection.php` settings
- [ ] Access http://localhost/elearning-platform/
- [ ] Login with test credentials
- [ ] Browse courses & try enrollment
- [ ] Check dashboard

---

## 📊 Project Stats

- **PHP Files:** 11+
- **CSS Lines:** 400+
- **Database Tables:** 9
- **Sample Courses:** 10+
- **Sample Users:** 3+
- **Status:** ✅ Production Ready

---

## 🔐 Security Notes

- Use `mysqli_real_escape_string()` for SQL injection prevention
- Implement password hashing (MD5/SHA) in production
- Validate sessions before database operations
- Apply client & server-side form validation

---

**License:** MIT | **Stack:** PHP 7.4+ | MySQL 5.7+ | Apache | **Updated:** 2026