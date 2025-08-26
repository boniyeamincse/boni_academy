# Boni Academy — Module README Pack

This document contains **drop‑in README.md files** for each module of the Boni Academy Laravel LMS. Copy each section’s content into the corresponding path in your repo.

> Repo root assumed: `/opt/lampp/htdocs/boni-academy`

---

## Repository layout (suggested)

```
boni-academy/
├─ app/
│  ├─ Models/
│  ├─ Policies/
│  ├─ Http/
│  │  ├─ Controllers/
│  │  ├─ Requests/
│  │  └─ Resources/
│  ├─ Services/
│  │  ├─ Payments/
│  │  └─ Certificates/
│  └─ View/Components/
├─ database/
│  ├─ factories/
│  ├─ migrations/
│  └─ seeders/
├─ routes/
├─ resources/
│  ├─ views/
│  └─ js/
├─ tests/
└─ modules/   # optional: docs per module
```

---

## 1) Core & App README

**Path:** `README.md`

````markdown
# Boni Academy (Laravel LMS)

Boni Academy is a Laravel‑based Learning Management System with roles for Admin, Instructor, and Student; course authoring; enrollment, quizzes, assignments, discussions; payments (SSLCommerz/bKash/Stripe); certificates; and analytics.

## Requirements
- PHP 8.2+
- Composer 2+
- MySQL 8+ (or MariaDB 10.6+)
- Node 18+ / PNPM or NPM

## Quick start
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan serve
````

## Useful commands

```bash
php artisan storage:link
php artisan queue:work
php artisan optimize:clear
```

## Modules

See `/modules/*/README.md` for details.

```
```

---

## 2) Users & Auth

**Path:** `modules/users/README.md`

````markdown
# Users & Authentication

Provides user registration, login, email verification, password reset, profile management.

## Packages
- Laravel Breeze (Blade)
- Laravel Fortify (optional for 2FA)

## DB
- `users`: id, name, email, email_verified_at, password

## Commands
```bash
php artisan migrate
php artisan make:seeder DemoUsersSeeder
````

## Policies

* Gate: `view-dashboard` (any verified user)

## Endpoints

* `GET /login`, `POST /login`
* `GET /register`, `POST /register`
* `POST /logout`

```
```

---

## 3) Roles & Permissions

**Path:** `modules/rbac/README.md`

````markdown
# Roles & Permissions

Role‑based access control using `spatie/laravel-permission`.

## Roles
- Admin, Instructor, Student

## Setup
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider"
php artisan migrate
````

Seed roles in a seeder and assign via Filament or Tinker.

## Usage

```php
$user->assignRole('Admin');
$user->can('course.create');
```

````

---
## 4) Categories
**Path:** `modules/categories/README.md`

```markdown
# Categories

Hierarchical course categories (optional parent_id).

## DB
- `categories`: id, parent_id, name, slug, description

## Filament
- CategoryResource with tree view (optional plugin) or parent select.
````

````

---
## 5) Courses
**Path:** `modules/courses/README.md`

```markdown
# Courses

Create, manage, and publish courses.

## DB
- `courses`: id, category_id, instructor_id, title, slug, summary, description, price, level, language, thumbnail, status, visibility, published_at

## Relationships
- Course belongs to Category & Instructor
- Course hasMany Modules, Lessons, Quizzes, Announcements

## Routes
- `GET /courses` (catalog)
- `GET /courses/{slug}` (detail)
- Admin CRUD via Filament

## Policies
- Instructors can manage their own courses
- Admin can manage all
````

````

---
## 6) Modules (Sections)
**Path:** `modules/course-modules/README.md`

```markdown
# Course Modules (Sections)

Logical grouping of lessons within a course.

## DB
- `course_modules`: id, course_id, title, sort_order

## Behavior
- Sortable (drag to reorder)
````

````

---
## 7) Lessons
**Path:** `modules/lessons/README.md`

```markdown
# Lessons

Lesson content: video, PDF, or rich text.

## DB
- `lessons`: id, module_id, title, type[video|pdf|text], content_url, duration_seconds, body_html, sort_order, is_preview

## Storage
- Use `spatie/laravel-medialibrary` for attachments & thumbnails
- Video via external storage (S3/Vimeo/YouTube)

## Player
- Gate check: enrolled users or previewable
````

````

---
## 8) Enrollment & Access
**Path:** `modules/enrollment/README.md`

```markdown
# Enrollment & Access

Manages free/paid access to courses.

## DB
- `enrollments`: id, course_id, user_id, price_paid, coupon_code, status, enrolled_at

## Logic
- Enrollment created after successful order/payment or manual admin add
- Check middleware: `EnsureEnrolled`
````

````

---
## 9) Progress Tracking
**Path:** `modules/progress/README.md`

```markdown
# Progress Tracking

Tracks lesson completion & watch time.

## DB
- `lesson_progress`: id, enrollment_id, lesson_id, completed_at, seconds_watched

## API
- `POST /api/lessons/{id}/progress`
````

````

---
## 10) Quizzes & Question Bank
**Path:** `modules/quizzes/README.md`

```markdown
# Quizzes & Questions

Auto‑graded quizzes with attempts.

## DB
- `quizzes`
- `questions` (type: mcq, tf, single, multiple)
- `options` (is_correct)
- `quiz_attempts` (score)
- `answers`

## Routes
- `GET /learn/{course}/quiz/{quiz}`
- `POST /quiz/{quiz}/attempt`

## Scoring
- Score = sum(points for correct answers)
````

````

---
## 11) Assignments & Submissions
**Path:** `modules/assignments/README.md`

```markdown
# Assignments & Submissions

Instructor‑graded submissions with feedback.

## DB
- `assignments`: id, course_id, title, body, due_at, max_points
- `submissions`: id, assignment_id, user_id, file_url/text, submitted_at, score, feedback

## Flow
- Student uploads -> Instructor reviews -> Grade & feedback -> Gradebook
````

````

---
## 12) Orders & Payments
**Path:** `modules/payments/README.md`

```markdown
# Orders & Payments

Payment gateways: SSLCommerz, bKash (and Stripe for test).

## DB
- `orders`: id, user_id, total_amount, currency, status, gateway, transaction_id
- `order_items`: id, order_id, course_id, price

## Service
- `app/Services/Payments/{Gateway}Driver.php`
- Interface: `PaymentDriver` with `create`, `verify`, `refund` (optional)

## Webhooks
- `/payments/sslcommerz/callback`
- `/payments/bkash/callback`
````

````

---
## 13) Certificates
**Path:** `modules/certificates/README.md`

```markdown
# Certificates

Auto‑generate completion certificates (PDF) and verify by code.

## DB
- `certificates`: id, user_id, course_id, code(uuid), issued_at

## Package
- `barryvdh/laravel-dompdf`

## Routes
- `GET /certificate/{code}` (verify)
````

````

---
## 14) Announcements & Discussions
**Path:** `modules/community/README.md`

```markdown
# Announcements & Discussions

Course announcements and threaded Q&A.

## DB
- `announcements`
- `discussions`, `discussion_replies`

## Moderation
- Policy: instructors & admins can moderate
````

````

---
## 15) Admin Panel (Filament)
**Path:** `modules/admin/README.md`

```markdown
# Admin Panel (Filament)

Rapid CRUD & dashboards for admins/instructors.

## Setup
```bash
composer require filament/filament:"^3.2"
php artisan make:filament-user
````

## Resources

* Users, Roles, Categories, Courses, Modules, Lessons, Quizzes, Assignments, Orders

## Access

* Restrict to `Admin` (and limited Instructor pages)

```
```

---

## 16) Media & Files

**Path:** `modules/media/README.md`

````markdown
# Media & Files

Use `spatie/laravel-medialibrary` for uploads and conversions.

## Setup
```bash
composer require spatie/laravel-medialibrary
php artisan vendor:publish --provider="Spatie\\MediaLibrary\\MediaLibraryServiceProvider" --tag=migrations
php artisan migrate
php artisan storage:link
````

````

---
## 17) Notifications
**Path:** `modules/notifications/README.md`

```markdown
# Notifications

Use Laravel Notifications (mail + database). Optional SMS provider.

## Events
- Enrollment created, Assignment graded, Quiz passed, Certificate issued
````

````

---
## 18) Public Site (Catalog & Learn)
**Path:** `modules/site/README.md`

```markdown
# Public Site

Catalog, course details, student dashboard, lesson player.

## Routes
- `/` Home
- `/courses` Catalog
- `/courses/{slug}` Detail
- `/dashboard` Student dashboard
- `/learn/{course}/{lesson}` Player
````

````

---
## 19) API (Optional)
**Path:** `modules/api/README.md`

```markdown
# API (Optional)

Provide REST/JSON endpoints for mobile or SPA.

## Auth
- Laravel Sanctum

## Example endpoints
- `GET /api/courses`
- `POST /api/courses/{id}/enroll`
- `GET /api/progress`
````

````

---
## 20) DevOps & Environments
**Path:** `modules/devops/README.md`

```markdown
# DevOps & Environments

## Envs
- `local`, `staging`, `production`

## Commands
```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
````

## Backups

* `spatie/laravel-backup` (cron daily)

```
```

---

## 21) Security & Compliance

**Path:** `modules/security/README.md`

```markdown
# Security & Compliance

- Enforce policies & gates; test with Pest
- CSRF, rate limit, email verification, (optional) 2FA
- Validate uploads and limit file size; ClamAV optional
- Regular dependency updates
```

````

---
## 22) Localization (BN/EN)
**Path:** `modules/i18n/README.md`

```markdown
# Localization

- `APP_TIMEZONE=Asia/Dhaka`
- Set `APP_LOCALE` to `bn` or `en`
- Store copy in `lang/bn` and `lang/en`
````

````

---
## Copy helper (optional script)
**Path:** `scripts/copy-readmes.sh`

```bash
#!/usr/bin/env bash
set -euo pipefail
mkdir -p modules/{users,rbac,categories,courses,course-modules,lessons,enrollment,progress,quizzes,assignments,payments,certificates,community,admin,media,notifications,site,api,devops,security,i18n}
# Copy from this doc manually or redirect each section to the target README.md
````
