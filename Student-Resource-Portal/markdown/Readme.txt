student-resource-portal/
│
├── assets/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── fonts/
│
├── includes/
│   ├── header.php
│   ├── navbar.php
│   ├── footer.php
│   └── sidebar.php
│
├── config/
│   └── database.php
│
├── classes/
│   ├── Database.php
│   ├── User.php
│   ├── Auth.php
│   └── Resource.php
│
├── auth/
│   ├── register.php
│   ├── login.php
│   └── logout.php
│
├── dashboard/
│   ├── index.php
│   ├── profile.php
│   ├── resources.php
│   ├── create-resource.php
│   ├── edit-resource.php
│   └── change-password.php
│
├── admin/
│   ├── users.php
│   └── resources.php
│
├── uploads/
│
└── index.php








1. Database Design
2. Database Connection
3. Registration
4. Login
5. Sessions
6. Logout
7. Route Protection
8. Profile Update
9. Change Password
10. Resource CRUD
11. File Uploads
12. Remember Me Cookies
13. Admin Permissions
14. Account Deletion



Plan architecture
↓
Build UI structure
↓
Verify navigation
↓
Design database
↓
Build backend


########## USERS TABLE ###########

id
fullname
email
password
role
profile_image
email_verified
created_at

########## RESOURCES TABLE ###########

id
user_id
title
category
description
file_name
created_at




✓ Folder structure
✓ Frontend pages
✓ User/Admin separation
✓ Database created
✓ Users table
✓ Resources table
✓ Foreign key relationship
✓ Cascade delete



Database Class
↓
Registration
↓
Login
↓
Logout
↓
Route Protection
↓
Profile
↓
Resource CRUD
↓
Admin Features
↓
Email Verification





############# ENHANCEMENTS ############
✓ Dynamic sidebar active state
✓ Search users
✓ Search resources
✓ Email verification
✓ Verification tokens
✓ Email-change verification
✓ Partial updates
✓ Separate user/admin navigation



#################### User class must have and handle ##########
User Registration
User Login
User Authentication
User Profile
User Passwords
User Email Verification
User Role Management
User Search
User Deletion


1. Connect registration form
    ↓
    Test user creation

2. Connect login form
    ↓
    Test authentication

3. Sessions
    ↓
    Store logged-in user

4. Route Protection
    ↓
    Protect dashboard pages

5. Role Redirects
    ↓
    User → dashboard/
    Admin → admin/