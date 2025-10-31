# 🧩 CRM System — Laravel 12 Practical Task

This project is a **basic CRM System** built with **Laravel 12.x** practical test.  
It includes Customer Management, Messaging to Active Customers, Validation, and Role-based restrictions.

---

## ⚙️ Tech Stack

- **Laravel 12.0**
- **PHP 8.3+**
- **Bootstrap 5**
- **MySQL**

---

## 🚀 Features Overview

| Feature | Description |
|----------|-------------|
|  Customer Management | Create, view, update, and delete customers |
|  Status Control | Customers can be `Active`, `Inactive`, or `Lead` |
|  Messaging | Send messages to active customers only |
|  Restrict inactive | Inactive customers are blocked from messaging |
|  Validation | Both **client-side (JS)** and **server-side (Laravel)** validation |
|  Logs & Error Handling | Proper success/error flash messages |
|  Clean Blade Layout | Simple and reusable `layouts/app.blade.php` and `layouts/guest.blade.php` |

---

## 🛠️ Setup Instructions

### 1️⃣ Clone & Install
```bash
git clone <repo-url>
cd crm-system
composer install
npm install && npm run build
