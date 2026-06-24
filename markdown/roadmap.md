# Development Roadmap

Purpose:

This document defines EXACTLY what gets built and in what order.

Whenever confused:

READ THIS FILE.

---

# Phase 1

Project Foundation

Status:

✓ Completed

---

Tasks

✓ Folder Structure

✓ Bootstrap Setup

✓ Font Awesome Setup

✓ Local Assets

✓ Responsive Layout

✓ Navigation

✓ User Dashboard UI

✓ Admin Dashboard UI

✓ Sidebar

✓ Mobile Sidebar

---

# Why?

Backend work becomes easier once pages already exist.

---

# Phase 2

Database Design

Status:

✓ Completed

---

Tasks

✓ Create Database

✓ Create Users Table

✓ Create Resources Table

✓ Create Foreign Key

✓ Configure Cascade Delete

---

# Why?

Database structure determines everything else.

---

# Phase 3

Database Class

Status:

✓ Completed

---

Tasks

✓ Create PDO Connection

✓ Configure PDO

✓ Store Connection

✓ Return Connection

---

# Concepts Learned

PDO

OOP

Constructors

Properties

Exceptions

---

# Phase 4

User Class

Status:

Current

---

Tasks

✓ Create Class

✓ Create Constructor

✓ Create Method Skeletons

⏳ Implement Methods

---

# Methods To Build

emailExists()

register()

login()

findById()

updateProfile()

changePassword()

deleteAccount()

---

# Suggested Order

emailExists()
↓
register()
↓
login()

Reason:

Registration depends on emailExists().

Login depends on registered users.

---

# Phase 5

Authentication System

Status:

Not Started

---

Tasks

Create Sessions
↓
Store User Data
↓
Redirect By Role
↓
Logout
↓
Protect Routes

---

# Concepts Learned

Sessions

Cookies

Authorization

Authentication

---

# Phase 6

Profile Management

Status:

Not Started

---

Tasks

View Profile
↓
Update Profile
↓
Change Password
↓
Delete Account

---

# Important Requirement

Partial Updates

User should be able to update:

Name Only

Email Only

Image Only

Without affecting others.

---

# Phase 7

Resource Management

Status:

Not Started

---

Tasks

Create Resource
↓
View Resources
↓
Edit Resource
↓
Delete Resource

---

# Concepts Learned

CRUD

File Uploads

File Deletion

Ownership

Foreign Keys

---

# Phase 8

Admin System

Status:

Not Started

---

Tasks

View Users
↓
Search Users
↓
Promote Users
↓
Demote Users
↓
Delete Users

---

# Concepts Learned

Role Management

Permissions

Administration

---

# Phase 9

Search System

Status:

Not Started

---

Tasks

Search Users
↓
Search Resources

---

# Why?

Large datasets eventually require search.

---

# Phase 10

Email Verification

Status:

Not Started

---

Tasks

Generate Token
↓
Store Token
↓
Send Email
↓
Verify Token
↓
Activate Account

---

# Concepts Learned

Email

Tokens

Security

Verification

---

# Phase 11

Email Change Verification

Status:

Not Started

---

Tasks

Request New Email
↓
Generate Token
↓
Verify New Email
↓
Update Database

---

# Why?

Prevent account takeover.

---

# Phase 12

Project Improvements

Status:

Future

---

Tasks

Dynamic Sidebar Active State

Search Optimization

Pagination

Auth Class

Configuration Files

Reusable Helpers

---

# Completion Checklist

Foundation

✓

Database

✓

Database Class

✓

User Class

⏳

Authentication

⏳

Profile Management

⏳

Resource CRUD

⏳

Admin System

⏳

Search

⏳

Email Verification

⏳

Project Complete

⏳

---

# Rule For Future Development

New Feature
↓
Update Documentation
↓
Review Architecture
↓
Implement Feature
↓
Update Documentation Again

Documentation remains source of truth.
