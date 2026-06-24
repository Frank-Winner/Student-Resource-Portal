# Future Features & Enhancements

Purpose:

This file contains features that are NOT required for the initial completion of the project but have already been discussed and approved.

These features may be implemented after the core project is working.

---

# Feature Categories

✓ User Experience

✓ Security

✓ Admin Tools

✓ Code Quality

✓ Scalability

---

==================================================
USER EXPERIENCE
==================================================

# Dynamic Active Sidebar

Status:

Planned

Priority:

High

---

Current

Every page manually contains:

```html
class="active"
```

Problem:

Wrong page may appear active.

Requires editing multiple files.

---

Future

Current URL
↓
Determine Current Page
↓
Apply Active Class Automatically

---

Benefits

✓ Easier Maintenance

✓ Less Repetition

✓ More Professional

---

Affected Files

|-- includes/sidebar.php

|-- admin/sidebar.php

---

# Dynamic Navbar State

Status:

Planned

Priority:

High

---

Current

Guest Navigation

```text
Home
Login
Register
```

---

Future

Guest
↓
Guest Navbar

User
↓
User Navbar

Admin
↓
Admin Navbar

---

Benefits

✓ Cleaner Navigation

✓ Better User Experience

✓ Better Role Separation

---

==================================================
SEARCH FEATURES
==================================================

# User Search

Status:

Planned

Priority:

High

---

Reason

Admin may eventually manage many users.

Example

10 Users
↓
Easy

1000 Users
↓
Need Search

---

Search Fields

✓ Name

✓ Email

---

Affected Areas

Admin Users Page

---

# Resource Search

Status:

Planned

Priority:

High

---

Search By

✓ Title

✓ Category

✓ Description

---

Benefits

Users locate resources quickly.

---

==================================================
SECURITY FEATURES
==================================================

# Email Verification

Status:

Planned

Priority:

Very High

---

Reason

Prevent fake accounts.

---

Flow

Register
↓
email_verified = 0
↓
Send Verification Email
↓
User Clicks Link
↓
email_verified = 1

---

Benefits

✓ Real Emails

✓ Better Security

✓ Better User Validation

---

# Temporary Verification Tokens

Status:

Planned

Priority:

Very High

---

Requirements

✓ Unique

✓ Random

✓ Expire Automatically

---

Example Flow

Generate Token
↓
Store Token
↓
Set Expiration
↓
Send Email
↓
Verify
↓
Delete Token

---

Reason

Prevents token abuse.

---

# Email Change Verification

Status:

Planned

Priority:

High

---

Reason

Current Email

```text
john@example.com
```

User Requests

```text
newjohn@example.com
```

System should verify ownership first.

---

Flow

Request Change
↓
Generate Token
↓
Send Email
↓
Verify
↓
Update Database

---

Benefits

✓ Prevents Account Theft

✓ Protects Accounts

---

==================================================
PROFILE FEATURES
==================================================

# Partial Profile Updates

Status:

Approved

Priority:

Required

---

User May Update

✓ Name Only

✓ Email Only

✓ Image Only

✓ Any Combination

---

Reason

Avoid forcing user to update every field.

---

# Profile Image Support

Status:

Approved

Priority:

Required

---

Current

Default Image

or

NULL

---

Future

Upload New Image
↓
Delete Old Image
↓
Save New Image

---

Benefits

✓ Cleaner Storage

✓ No Duplicate Images

---

==================================================
RESOURCE FEATURES
==================================================

# Partial Resource Updates

Status:

Approved

Priority:

Required

---

User May Update

✓ Title

✓ Category

✓ Description

✓ File

Independently.

---

Reason

Same philosophy as profile updates.

---

# Resource Ownership

Status:

Approved

Priority:

Required

---

Rule

User should only modify resources they own.

---

Flow

Current User ID
↓
Compare Owner ID
↓
Allow or Deny

---

Benefits

✓ Security

✓ Data Integrity

---

==================================================
ACCOUNT FEATURES
==================================================

# Account Deletion

Status:

Approved

Priority:

Required

---

Flow

Delete Account
↓
Delete Profile Image
↓
Delete User
↓
Cascade Delete Resources

---

Benefits

✓ Clean Database

✓ Clean File Storage

---

==================================================
ADMIN FEATURES
==================================================

# Promote User To Admin

Status:

Approved

Priority:

Required

---

Flow

user
↓
admin

---

Reason

Allow creation of additional admins.

---

# Demote Admin

Status:

Approved

Priority:

Required

---

Flow

admin
↓
user

---

Reason

Administrative control.

---

# Admin Password Page

Status:

Approved

Priority:

Required

---

Reason

Admin should not use user dashboard password page.

Separate interface.

---

==================================================
ARCHITECTURE FEATURES
==================================================

# Auth Class

Status:

Future

Priority:

Medium

---

Current

Authentication may live partly in User class.

---

Future

Auth Class

Responsibilities

✓ Session Checks

✓ Login State

✓ Role Checks

✓ Route Protection

---

Reason

Better separation of concerns.

---

# Configuration File

Status:

Future

Priority:

Medium

---

Current

Database credentials stored inside class.

---

Future

config/database.php

or

.env

---

Benefits

✓ Cleaner Configuration

✓ Easier Deployment

---

==================================================
PERFORMANCE FEATURES
==================================================

# Pagination

Status:

Future

Priority:

Medium

---

Reason

Large datasets.

---

Example

Users
↓
Page 1
Page 2
Page 3

Instead of loading everything.

---

# Search + Pagination Combination

Status:

Future

Priority:

Medium

---

Reason

Scalable Admin Panel.

---

==================================================
COMPLETION NOTES
==================================================

These features are NOT forgotten.

Whenever a feature is implemented:

Feature
↓
Update PROJECT Documentation
↓
Mark Implemented
↓
Record Changes

This file serves as the project's memory and future enhancement tracker.

====================================================================================================================

# Project Update — URL & Path Management

Date: 2026-06-06

Status: Deferred Until Core Backend Completion

---

## Problem Discovered

When the project was moved from the VS Code PHP Server to XAMPP's htdocs directory, asset paths and navigation links broke.

Examples:

```html
../assets/css/style.css
```

```html
href="/auth/login.php"
```

These paths behaved differently depending on:

- Current page location
- Include location
- Server environment

Result:

- Missing CSS
- Missing JavaScript
- Broken navigation
- 404 errors

---

## Temporary Solution Implemented

Navigation links and asset paths were changed to use:

```text
/student-resource-portal/
```

Examples:

```html
href="/student-resource-portal/auth/login.php"
```

```html
href="/student-resource-portal/dashboard/index.php"
```

```html
href="/student-resource-portal/assets/css/style.css"
```

This restores functionality while development continues.

---

## Why This Decision Was Made

At the current stage:

- Backend learning is the priority.
- Routing architecture is not the priority.
- Time was being lost fighting path issues.

Therefore a simple working solution was preferred.

---

## Future Improvement

Create centralized configuration.

Example:

```php
define('BASE_URL', '/student-resource-portal');
```

Then use:

```php
<?= BASE_URL ?>/auth/login.php
```

```php
<?= BASE_URL ?>/dashboard/index.php
```

```php
<?= BASE_URL ?>/assets/css/style.css
```

---

## Future Benefits

✓ Easier deployment

✓ Easier maintenance

✓ Change project location once

✓ Change project name once

✓ No project-wide search-and-replace

---

## Planned Refactor Stage

Recommended Time:

After:

✓ User Class

✓ Authentication

✓ Resource CRUD

✓ Admin System

Before:

✓ Final Project Cleanup

✓ Deployment

---

## Important Note

Current hardcoded paths are NOT considered technical debt that must be fixed immediately.

The project should continue development using the working solution until the core PHP learning objectives are completed.

==============================================================================================================

Resource Module Future Enhancement ==== 14|06|2026

□ Generate unique filenames during upload

Reason:

Current implementation stores original filenames.

Problem:

notes.pdf
notes.pdf

Second upload overwrites first upload.

Future Solution:

timestamp_filename.ext

or

uniqueid_filename.ext

Examples:

1718123456_notes.pdf

64af1d7_notes.pdf

FUTURE ADMIN SECURITY UPDATE

✓ Convert promote actions to POST

✓ Convert delete actions to POST

✓ Add CSRF protection

✓ Add action confirmation modal
