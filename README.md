# 📚 Student Resource Portal

A full-stack PHP-based web application for uploading, managing, and sharing academic resources. The system includes user authentication, role-based access control, and an admin dashboard for managing users and content.

---

## 🚀 Features

### 👤 User Features
- User registration and login system
- Secure password hashing (`password_hash`)
- Email uniqueness validation
- Profile update (name, email, profile image)
- Password change functionality
- Upload academic resources (PDF, DOCX, PPT, etc.)
- View own uploaded resources
- Delete account (with full cleanup of files + data)

---

### 🛠 Admin Features
- Admin dashboard
- View all registered users
- Search users by name or email
- Promote users to admin
- Demote admins to user
- Delete users (including uploaded files and resources)

---

### 📁 Resource Management
- Upload files with validation (type + size limit)
- File storage in `/uploads`
- Database tracking of file metadata
- User-linked resources
- Admin-level resource control (planned extension)

---

## 🧱 Tech Stack

- Backend: PHP (OOP)
- Database: MySQL (PDO)
- Frontend: HTML, Bootstrap 5
- Server: XAMPP / Apache
- Security: Password hashing, session-based auth

---

## 📂 Project Structure
Student-Resource-Portal/
│
├── auth/ # Login, register, logout pages
├── admin/ # Admin dashboard pages
├── dashboard/ # User dashboard
├── classes/ # Core PHP classes (User, Resource, Database)
├── includes/ # Header, footer, auth guards, sidebar
├── uploads/ # Uploaded files storage
├── config/ # Database configuration (if applicable)
└── index.php # Landing page


---

## 🔐 Authentication System

- Session-based authentication
- Role-based access control (`user`, `admin`)
- Route protection via auth guards:
  - `auth.php` → protects user routes
  - `admin-auth.php` → protects admin routes

---

## 🧠 Core Classes

### User Class
Handles:
- Registration
- Login
- Profile update
- Password update
- Account deletion
- Admin actions (promote, demote, delete users)

---

### Resource Class
Handles:
- File uploads
- Validation (file type, size)
- Resource creation
- Fetching user resources
- Resource retrieval by ID

---

### Database Class
- PDO connection handler
- Centralized DB access layer

---

## 📌 Security Features

- Password hashing (`password_hash`)
- Prepared statements (SQL injection prevention)
- Session-based authentication
- File type validation for uploads
- Admin action restrictions (self-protection rules)

---

## ⚙️ Planned Improvements

- Convert admin actions to POST (replace GET queries)
- Add CSRF protection
- Email verification workflow (improved version)
- Advanced search & filtering (users + resources)
- Pagination for large datasets
- Soft delete instead of hard delete
- Admin analytics dashboard

---

## 📸 UI Overview

- Bootstrap-based responsive dashboard
- Sidebar navigation for user/admin
- Card-based forms (`form-card`)
- Alert system for error and success messages

---

## 📌 Notes

This project is built as a learning-focused backend system to understand:
- PHP OOP design
- Authentication systems
- Role-based authorization
- File handling
- CRUD architecture

---

## 🧑‍💻 Author

Built as a full-stack PHP OOP project focused on backend architecture and real-world system design.
