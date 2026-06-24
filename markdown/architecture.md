# Architecture Decisions

This file explains WHY decisions were made.

---

# Why Use OOP?

Alternative:

```php
register.php
login.php
profile.php

All SQL everywhere.
```

Problem:

```text
Difficult to maintain
Difficult to reuse
Difficult to scale
```

Chosen:

```text
Database Class
↓
User Class
↓
Resource Class
```

Reason:

✓ Better organization

✓ Easier maintenance

✓ Easier learning

---

# Why Use PDO?

Alternative:

```php
mysqli
```

Reason PDO was chosen:

✓ More modern

✓ Better flexibility

✓ Prepared statements

✓ Easier exception handling

✓ Industry standard

---

# Why Use Classes?

Without classes:

```php
register.php

SQL
Validation
Authentication
Uploads

All mixed together.
```

Problem:

Everything becomes difficult to understand.

Chosen:

```text
User Class
    ↓
User Logic

Resource Class
    ↓
Resource Logic

Database Class
    ↓
Connection Logic
```

Each class has one responsibility.

---

# Why Database Class?

Purpose:

```text
Centralized Database Connection
```

Without it:

```php
new PDO(...)
new PDO(...)
new PDO(...)
new PDO(...)
```

Repeated everywhere.

Problem:

✓ Repetition

✓ Harder maintenance

Chosen:

```php
$db = new Database();
$conn = $db->conn();
```

Single reusable source.

---

# Why User Class?

Purpose:

```text
Manage Users
```

Responsibilities:

✓ Registration

✓ Login

✓ Profile Updates

✓ Password Changes

✓ Account Deletion

Reason:

User-related logic belongs together.

---

# Why Resource Class?

Purpose:

```text
Manage Resources
```

Responsibilities:

✓ Create Resource

✓ Read Resource

✓ Update Resource

✓ Delete Resource

Reason:

Resource logic should not be mixed with user logic.

---

# Why Separate Admin and User Areas?

Alternative:

```text
One Dashboard
```

Problem:

Complex permission checks.

Chosen:

```text
dashboard/
    ↓
Users

admin/
    ↓
Admins
```

Benefits:

✓ Cleaner

✓ Easier permission control

✓ Easier navigation

---

# Why Future Auth Class?

Current:

```text
Authentication logic may temporarily live in User class.
```

Future:

```text
Auth Class
```

Purpose:

✓ Login State

✓ Sessions

✓ Role Checks

✓ Route Protection

Reason:

Authentication is different from user management.

---

# Why Local Assets?

Reason:

User develops locally.

Requirements:

✓ Bootstrap Local

✓ Font Awesome Local

✓ Fonts Local

Benefits:

✓ Faster

✓ No internet dependency

✓ Reliable testing

---

# Why Documentation-First Workflow?

Problem discovered during project:

Architecture was evolving while coding.

Result:

Need to repeatedly ask:

```text
What's next?
Why did we do this?
```

Solution:

Documentation becomes source of truth.

Flow:

Plan
↓
Document
↓
Review
↓
Implement
↓
Update Documentation

Before I proceed to login(). Explain the current architecture to me, why the auth folder, config, class, and how the config will even make use of the class to connectr db and feed the frontend? I don't really understand it. I don't just want to be carried along, I want to understand why I have every folder, how they link and work together (not the basic assets or includes or dashboard folder, I know why those exist), so I can know the why and how and things to consider in the future when planning alone. Make it very comprehensive, and even create a new md for it so I can go back to it later to learn and understand.

# STUDENT RESOURCE PORTAL — ARCHITECTURE EXPLAINED

## Purpose

This document explains WHY the project is structured the way it is.

The goal is not just to write code but to understand how applications are designed.

---

# Core Principle

Every folder and file should have one primary responsibility.

Bad architecture:

Everything mixed together.

Good architecture:

Each part handles one job.

---

# Application Flow

Browser
↓
Page
↓
Class
↓
Database

Example:

User submits login form
↓
login.php receives request
↓
User class validates credentials
↓
Database queried
↓
Result returned
↓
login.php displays response

---

# Config Folder

Purpose:

Store application configuration.

Examples:

- Database credentials
- Base URL
- Root path
- Environment settings

This folder should not contain business logic.

Think:

Application Settings

---

# Classes Folder

Purpose:

Store business logic.

Examples:

User.php

Responsibilities:

- Register users
- Login users
- Update profile
- Delete account

Database.php

Responsibilities:

- Create PDO connection
- Return connection object

Future:

Resource.php

Responsibilities:

- Create resource
- Update resource
- Delete resource
- Search resources

Rule:

Classes represent application objects and their actions.

---

# Auth Folder

Purpose:

Authentication.

Examples:

- login.php
- register.php
- forgot-password.php
- reset-password.php

Question answered:

Who are you?

---

# Dashboard Folder

Purpose:

Authenticated user area.

Examples:

- Dashboard Home
- Profile
- Resources
- Change Password

Question answered:

What can the user do after login?

---

# Admin Folder

Purpose:

Administrative functionality.

Examples:

- Manage Users
- Promote Users
- Delete Users
- Manage Resources

Question answered:

What can administrators control?

---

# Database Flow

Database Class
↓
Creates PDO
↓
Returns PDO
↓
User Class Receives PDO
↓
Queries Database

Example:

$db = new Database();

$conn = $db->conn();

$user = new User($conn);

Why?

Because User.php should focus on users, not database setup.

---

# Dependency Injection

Current:

$user = new User($conn);

Meaning:

Connection is provided to User.

Benefits:

✓ Separation of concerns

✓ Easier testing

✓ Reusable code

✓ Cleaner architecture

---

# Future Growth Strategy

As features increase:

classes/

|-- Database.php

|-- User.php

|-- Resource.php

|-- Admin.php

|-- Upload.php

|-- Validator.php

Each class should have one responsibility.

---

# Project Design Questions

Whenever starting a new project:

1. What objects exist?

Examples:

- User
- Resource
- Admin

2. What actions do they perform?

User:

- register()
- login()
- logout()

Resource:

- create()
- update()
- delete()

Admin:

- promoteUser()
- deleteUser()

The answers usually reveal the classes that should exist.

---

# Golden Rule

Never design folders first.

Design responsibilities first.

Folders are created to organize responsibilities.

Not the other way around.
