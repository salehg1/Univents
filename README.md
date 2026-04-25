# Univents — University Event Management Platform

Univents is a bilingual (Arabic/English) event management platform built for Taibah University. It centralizes event announcements, allows students to register for events, and gives admins tools to manage attendance — all in one place.

---

## Features

- **Role-based access** — Visitor, Student, and Admin dashboards
- **Event categories** — General Events, Sports Activities, Student Clubs, College Events
- **Student registration** — Students can register for events and track their history
- **Admin panel** — View registered attendees and approve attendance
- **Bilingual UI** — Full Arabic/English language toggle with RTL support
- **Demo portal** — Try all three roles without an account

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP, WordPress (WP_Query, wp_insert_post, post meta) |
| Database | MySQL via WordPress |
| Frontend | HTML, CSS, Vanilla JavaScript |
| Auth | PHP Sessions + WordPress user roles |
| i18n | Custom `lang.js` with `data-translate` / `data-en` / `data-ar` attributes |

---

## Project Structure

```
Univents/
├── portal.php                  # Demo entry point (choose role)
├── demo-auth.php               # Sets demo session role
├── index.php                   # Redirects to portal
├── Entry/
│   ├── LogIn/                  # Login page
│   ├── SignUp/                 # Registration page
│   └── PassReset/             # Password reset flow
├── HomePage/
│   ├── Visitors/               # Visitor dashboard
│   ├── Student/                # Student dashboard + past events
│   ├── Admin/                  # Admin dashboard + add event
│   └── event/                  # Event card, registration, attendees
├── Settings/
│   ├── lang.js                 # Language toggle (AR/EN)
│   ├── main_settings/          # Settings page
│   └── Profile/                # Profile page
└── Dependencies/
    └── functions.php           # Auth guard helper
```

---

## Local Setup

### Requirements
- XAMPP (Apache + MySQL + PHP 8+)
- WordPress installed at `htdocs/wordpress/`

### Steps

1. Clone into `htdocs/`:
   ```bash
   git clone https://github.com/salehg1/Univents.git
   ```

2. Make sure WordPress is running at `localhost/wordpress/` with its own database.

3. Run the setup scripts once from the browser (in order):
   ```
   localhost/Univents/seed-events.php
   localhost/Univents/update-images.php
   localhost/Univents/add-arabic-meta.php
   ```

4. Delete the setup scripts after running them.

5. Visit `localhost/Univents/portal.php` to start.

---

## Demo

Live demo: [salstack.dev/Univents/portal.php](https://salstack.dev/Univents/portal.php)

The portal lets you explore the app as:
- **Visitor** — Browse events, no account needed
- **Student** — Register for events, view profile and past events
- **Admin** — Manage events, view and approve attendee lists

## Authors

Developed by FS WebDev Students — Taibah University Graduation Project.
