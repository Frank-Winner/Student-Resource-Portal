# Database Design

Database Name:

student_resource_portal

Storage Engine:

InnoDB

Reason:

✓ Supports Foreign Keys

✓ Supports Transactions

✓ Better Data Integrity

---

# Users Table

Purpose:

Store all user accounts.

---

Structure

id
fullname
email
password
role
profile_image
email_verified
created_at

---

# id

Type:

INT

Properties:

✓ Primary Key

✓ Auto Increment

Reason:

Unique identifier.

Example:

1
2
3
4

Never reused manually.

---

# fullname

Type:

VARCHAR(255)

Reason:

Stores user's full name.

Required:

✓ Yes

---

# email

Type:

VARCHAR(255)

Required:

✓ Yes

Unique:

✓ Yes

Reason:

No two accounts should share an email.

Example:

john@example.com

Cannot exist twice.

---

# password

Type:

VARCHAR(255)

Reason:

Stores hashed password.

Never store:

✗ Plain text password

Always:

Password
↓
Hash
↓
Store

---

# role

Type:

VARCHAR(50)

Default:

user

Possible Values:

user
admin

Reason:

Role-based access control.

---

# profile_image

Type:

VARCHAR(255)

Default:

NULL

Reason:

Stores image path.

Example:

uploads/profiles/avatar.jpg

---

# email_verified

Type:

TINYINT(1)

Default:

0

Meaning:

0 = Not Verified

1 = Verified

Reason:

Restrict certain functionality until verified.

---

# created_at

Type:

TIMESTAMP

Default:

CURRENT_TIMESTAMP

Reason:

Automatically records creation date.

---

# Resources Table

Purpose:

Store uploaded resources.

---

Structure

id
user_id
title
category
description
file_name
created_at

---

# user_id

Type:

INT

Required:

✓ Yes

Reason:

Links resource to owner.

Example:

users.id = 5
↓
resources.user_id = 5

Ownership established.

---

# title

Type:

VARCHAR(255)

Required:

✓ Yes

Purpose:

Resource title.

---

# category

Type:

VARCHAR(100)

Required:

✓ Yes

Reason:

Classification.

Chosen Approach:

Hardcoded categories.

Reason:

Consistency.

Avoids:

Programming
programming
PROGRAMMING

being treated differently.

---

# description

Type:

TEXT

Reason:

Can contain large content.

VARCHAR would be limiting.

---

# file_name

Type:

VARCHAR(255)

Reason:

Stores uploaded file name/path.

Example:

php-notes.pdf

---

# Foreign Key Design

Relationship:

users.id
↓
resources.user_id

---

# Why Foreign Keys?

Without Foreign Keys:

Resource could reference:

user_id = 999

when user 999 doesn't exist.

Bad data.

---

# ON DELETE CASCADE

Reason:

Account Deletion

Flow:

Delete User
↓
Delete Resources

Automatically.

No orphaned records.

---

# Why Not Store User Name In Resources?

Bad:

resource
↓
owner_name

Problem:

Name changes.

Data becomes inconsistent.

Chosen:

resource
↓
user_id

Always references actual user.

---

# Future Tables

Likely:

email_verifications

Purpose:

Store verification tokens.

Structure (planned):

id
user_id
token
expires_at
created_at
