# Subject Allocation System README

## Introduction
This repository contains PHP files for a Subject Allocation System, which allows administrators to manage teacher information and allocate subjects to them in an educational institution.

## Files Included
- **add-branch.php**: PHP script to add a new branch/course to the system.
- **add-course.php**: PHP script to add a new course to the system.
- **add-subject.php**: PHP script to add a new subject to the system.
- **add-teacher.php**: PHP script to add a new teacher to the system.
- **allocate-subject.php**: PHP script to allocate a subject to a teacher.
- **dashboard.php**: The dashboard interface for administrators to navigate through various functionalities.
- **dbconnection.php**: PHP script for establishing a connection to the database.
- **delete-teacher.php**: PHP script to delete a teacher record from the system.
- **edit-teacher.php**: PHP script to edit teacher information.
- **includes/**: Directory containing PHP files for header, footer, and sidebar navigation.
- **logout.php**: PHP script to log out the administrator.
- **teacher-details.php**: PHP script to display detailed information about a teacher.
- **update-teacher.php**: PHP script to update teacher details in the system.

## Installation
1. Clone this repository to your local machine.
2. Make sure you have PHP and a web server (e.g., Apache) installed on your system.
3. Import the provided SQL dump file (`tsasdb.sql`) into your MySQL/MariaDB database.
4. Update the database connection details in `dbconnection.php` file.
5. Place the cloned repository in your web server's root directory.
6. Access the application through your web browser.

## Usage
- Navigate to `dashboard.php` to access the admin dashboard.
- From the dashboard, you can add, view, edit, and delete teacher records, branches, courses, subjects, and allocate subjects to teachers.
- Use the sidebar navigation to access different functionalities.

## Dependencies
- This project requires a web server with PHP support.
- It uses MySQL/MariaDB as the database management system.

## Contributors
- [Sarfraz Sindagi] - [sarfrazsindagi151@gmail.com ]
