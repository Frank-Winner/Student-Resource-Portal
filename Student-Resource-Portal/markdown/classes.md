# Classes Architecture

Purpose:

This document explains:

✓ What classes exist

✓ Why they exist

✓ Their responsibilities

✓ Their methods

✓ How they interact

✓ What should NOT be placed inside them

---

# Class Relationship Overview

Database
↓
User
↓
Resource

Future:

Database
↓
User
↓
Auth

Database
↓
Resource

---

# Database Class

File:

classes/Database.php

Purpose:

Provide database connection.

Nothing more.

---

# Responsibilities

✓ Create PDO Connection

✓ Configure PDO

✓ Return Connection

---

# Must NOT Handle

✗ Registration

✗ Login

✗ File Uploads

✗ User Deletion

✗ Resource CRUD

---

# Why?

Database class should have ONE responsibility.

Bad:

Database
↓
Connection
↓
Registration
↓
Login
↓
Uploads

Good:

Database
↓
Connection Only

---

# Current Structure

```php
class Database
{
    private $host;
    private $dbname;
    private $user;
    private $password;

    private $conn;

    public function conn()
    {
    }
}
```

---

# Flow

new Database()
↓
conn()
↓
PDO Connection
↓
Return Connection

---

# User Class

File:

classes/User.php

Purpose:

Manage everything related to users.

---

# Responsibilities

✓ Registration

✓ Login

✓ Profile Updates

✓ Password Changes

✓ User Search

✓ User Deletion

✓ Role Management

✓ Email Verification

---

# Why A User Class Exists

Alternative:

register.php
login.php
profile.php

Each file contains:

Validation
SQL
Authentication

Problem:

✓ Repetition

✓ Harder maintenance

✓ Harder debugging

Chosen:

User Class

All user logic lives together.

---

# Constructor

Purpose:

Receive database connection.

Example:

```php
$db = new Database();

$user = new User(
    $db->conn()
);
```

Reason:

One connection.

Shared everywhere.

---

# Method: emailExists()

Purpose:

Determine whether email already exists.

---

# Flow

Email
↓
Database Search
↓
Found?
↓
True / False

---

# Used By

✓ Registration

✓ Profile Update

✓ Email Change

---

# Method: register()

Purpose:

Create new account.

---

# Responsibilities

Validate Data
↓
Check Email Exists
↓
Hash Password
↓
Upload Image
↓
Insert User

---

# Parameters

```php
register(
    $fullname,
    $email,
    $password,
    $profileImage,
    $emailExists
)
```

---

# Return

Possible:

true

or

false

or

message array

---

# Common Mistake

Doing redirects inside method.

Bad:

```php
header(...)
```

inside register()

Reason:

Method should perform registration only.

Page decides what happens next.

---

# Method: login()

Purpose:

Authenticate user.

---

# Flow

Email
↓
Find User
↓
Verify Password
↓
Return User Data

---

# Responsibilities

✓ Locate User

✓ Verify Password

✓ Return User

---

# Must NOT

✗ Create Sessions

✗ Redirect Pages

✗ Print HTML

---

# Why?

Authentication

≠

Session Management

They are related but different.

---

# Method: findById()

Purpose:

Retrieve single user.

---

# Used By

✓ Profile Page

✓ Admin Panel

✓ User Editing

---

# Method: updateProfile()

Purpose:

Update profile information.

---

# Important Requirement

Must support:

Name Only
↓
Update

Email Only
↓
Update

Image Only
↓
Update

Combination
↓
Update

Without affecting untouched fields.

---

# Why?

User may change only one field.

System should not overwrite others.

---

# Method: changePassword()

Purpose:

Change password safely.

---

# Flow

Current Password
↓
Verify
↓
Hash New Password
↓
Update Database

---

# Method: deleteAccount()

Purpose:

Remove account.

---

# Flow

Delete Profile Image
↓
Delete User
↓
Database Deletes Resources

(CASCADE)

---

# Method: promoteUser()

Purpose:

Convert user to admin.

---

# Flow

role=user
↓
role=admin

---

# Method: demoteUser()

Purpose:

Convert admin to user.

---

# Flow

role=admin
↓
role=user

---

# Method: searchUsers()

Purpose:

Find users quickly.

---

# Reason

Admin may eventually manage:

100+
500+
1000+

users.

Manual scrolling becomes impractical.

=================================================================================================

# Resource Class

File:

classes/Resource.php

Purpose:

Manage uploaded resources.

---

# Responsibilities

✓ Create Resource

✓ Retrieve Resource

✓ Update Resource

✓ Delete Resource

✓ Search Resources

---

# Why Separate Resource Class?

Alternative:

Put resource logic in User class.

Problem:

User class becomes huge.

Harder to maintain.

Chosen:

Dedicated Resource Class.

---

# Method: createResource()

Purpose:

Upload resource.

---

# Flow

Validate
↓
Upload File
↓
Insert Database Record

---

# Method: getResources()

Purpose:

Retrieve resources.

---

# Used By

Resources Page

Admin Resources

Search Results

---

# Method: findResource()

Purpose:

Retrieve single resource.

---

# Used By

Edit Page

View Page

Delete Page

---

# Method: updateResource()

Purpose:

Modify resource.

---

# Requirement

Update:

Title

Category

Description

File

Individually or together.

---

# Method: deleteResource()

Purpose:

Remove resource.

---

# Flow

Delete Physical File
↓
Delete Database Record

---

# Why Delete File First?

Avoid:

Database Deleted
↓
File Remains

Creates wasted storage.

---

# Method: searchResources()

Purpose:

Search resources.

---

# Search Fields

Title

Category

Description

---

# Future Auth Class

File:

classes/Auth.php

Status:

Future Enhancement

---

# Purpose

Handle:

Sessions

Authorization

Login State

Role Checks

---

# Methods

isLoggedIn()

isAdmin()

logout()

---

# Reason

Authentication logic eventually becomes separate from user logic.

Current project may keep some of this in User temporarily.

====================================================================================================

# STUDENT RESOURCE PORTAL — RESOURCE MODULE

## Status

Current Phase:

```text
AUTHENTICATION
    ✓ Complete

RESOURCE MODULE
    ⏳ In Progress
```

---

# Purpose

The Resource Module allows users to upload, manage, and organize educational resources.

Each resource belongs to exactly one user.

Relationship:

```text
User
↓
Many Resources
```

Database:

```text
users.id
    ↓
resources.user_id
```

This relationship allows:

✓ User-specific resources

✓ Ownership verification

✓ Automatic deletion of user resources when account is deleted

✓ Resource filtering

✓ Future analytics

---

# Resource Table

```sql
resources
```

Columns:

```text
id

user_id

title

category

description

file

created_at
```

---

# Why user_id Exists

Every uploaded resource must belong to a user.

Example:

```text
User ID = 5

Resource:
    title = PHP Notes
    user_id = 5
```

When displaying resources:

```sql
SELECT *
FROM resources
WHERE user_id = 5
```

Only that user's uploads appear.

---

# Categories

Categories are NOT manually typed.

Reason:

Prevent inconsistent values.

Bad:

Programming
programming
PROGRAMMING

Good:

Dropdown selection only.

Current Categories:

- Programming
- Mathematics
- Physics
- Chemistry
- Biology
- Engineering
- Business
- Others

---

# Resource Class

File:

classes/Resource.php

Purpose:

Handle all resource-related business logic.

Constructor:

```php
__construct($conn)
```

Stores PDO connection.

---

# Method: create()

Purpose:

Upload and create a resource.

Parameters:

```text
title

category

description

file

user_id
```

Flow:

```text
Validate fields
↓
Validate file
↓
Move uploaded file
↓
Insert database record
↓
Return success
```

---

# Method: getUserResources()

Purpose:

Retrieve all resources belonging to a specific user.

Parameters:

```text
user_id
```

Query Pattern:

```sql
SELECT *
FROM resources
WHERE user_id = ?
ORDER BY created_at DESC
```

Usage:

Dashboard resources page.

---

# Method: getResourceById()

Purpose:

Retrieve a single resource.

Used For:

✓ Editing

✓ Deleting

✓ Resource details page

✓ Ownership verification

---

# Method: update()

Purpose:

Update an existing resource.

Requirements:

✓ Partial updates supported

✓ Existing file retained when no new file uploaded

✓ Existing values retained when not changed

Flow:

```text
Retrieve resource
↓
Determine changed fields
↓
Update only changed values
↓
Save
```

---

# Method: delete()

Purpose:

Delete a resource.

Flow:

```text
Delete physical file
↓
Delete database record
↓
Return success
```

---

# Ownership Verification

Users must NEVER modify another user's resources.

Required Check:

```sql
SELECT *
FROM resources
WHERE id = ?
AND user_id = ?
```

If no match:

```text
Access Denied
```

---

# File Upload Rules

Upload Directory:

uploads/

Allowed Extensions:

```text
pdf

doc

docx

ppt

pptx

zip
```

Blocked Extensions:

```text
php

js

exe

bat
```

Validation:

```text
File exists
↓
Extension allowed
↓
Size allowed
↓
Move file
```

---

# User Resource Pages

add-resource.php

Purpose:

Create resource.

---

resources.php

Purpose:

Display user's resources.

---

edit-resource.php

Purpose:

Update resource.

---

delete-resource.php

Purpose:

Delete resource.

---

# Future Enhancements

✓ Resource Search

✓ Resource Filters

✓ Pagination

✓ Resource Download Tracking

✓ Resource Statistics

✓ File Preview Support

====================================================================================

# STUDENT RESOURCE PORTAL — PENDING USER METHODS

## Status

Authentication Methods:

```text
✓ emailExists()

✓ register()

✓ login()

✓ logout()
```

Core User Management:

```text
⏳ Pending
```

---

# Method: getUserById()

Purpose:

Retrieve a single user's information.

Used For:

✓ Profile page

✓ Dashboard greeting

✓ Edit profile form

✓ Admin user management

Parameters:

```text
user_id
```

Returns:

```text
User Object
```

---

# Method: updateProfile()

Purpose:

Update user profile information.

Fields:

```text
fullname

email

profile_image
```

Requirements:

✓ Partial updates supported

✓ Existing image preserved when no new image uploaded

✓ Existing fullname preserved when unchanged

✓ Existing email preserved when unchanged

---

# Method: updatePassword()

Purpose:

Allow user to change password.

Requirements:

✓ Verify current password

✓ Verify confirmation password

✓ Hash new password

✓ Update database

Flow:

```text
Verify current password
↓
Verify confirmation
↓
Hash password
↓
Update record
```

---

# Method: deleteAccount()

Purpose:

Permanently remove user account.

Requirements:

✓ Delete user's resources first

✓ Delete uploaded files

✓ Delete user account

Flow:

```text
Delete user resources
↓
Delete resource files
↓
Delete user
↓
Logout
```

---

# Email Verification System

Status:

Planned

---

# Method: sendVerificationEmail()

Purpose:

Send email verification link.

Requirements:

✓ Unique token

✓ Temporary token

✓ Expiration support

---

# Method: verifyEmailToken()

Purpose:

Validate verification token.

Flow:

```text
Receive token
↓
Verify token
↓
Mark account verified
↓
Delete token
```

---

# Email Change Verification

Status:

Planned

Purpose:

Prevent unverified email updates.

Flow:

```text
User enters new email
↓
Verification email sent
↓
User verifies
↓
Email updated
```

---

# Admin User Management

Status:

Pending

---

# Method: getAllUsers()

Purpose:

Admin user listing.

---

# Method: searchUsers()

Purpose:

Find users quickly.

Search Fields:

```text
fullname

email
```

Reason:

Avoid scrolling through large user lists.

---

# Method: promoteUser()

Purpose:

Convert user into admin.

Flow:

```text
Find user
↓
Update role
↓
User becomes admin
```

---

# Optional Future Methods

demoteUser()

adminDeleteUser()

suspendUser()

restoreUser()

These are not required for the current version.

====================================================================================================
