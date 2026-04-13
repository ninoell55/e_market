# 🛍️ E-Market Fashion: Professional Laravel E-Commerce

Welcome to the **E-Market Fashion** repository. This is a robust e-commerce web application built using the latest Laravel ecosystem. This project serves as a comprehensive implementation of modern web development patterns, focusing on scalability, clean UI, and efficient inventory management.

---

## 👤 Developer Profile

- **Lead Developer:** Nino Adityo Nugroho
- **GitHub:** [@ninoell55](https://github.com/ninoell55)
- **Institution:** SMKN 1 Cirebon (XI-RPL 2)

---

## 📝 Project Overview

**E-Market Fashion** is a high-performance fashion retail platform. Beyond basic shopping, it integrates advanced logic for inventory tracking, role-based access control (Admin & Courier), and automated business reporting.

### Core Features:

- **Dynamic Catalog:** Real-time product filtering and category management.
- **Advanced Authentication:** Secure multi-role authentication (Admin, Courier, and Customer).
- **E-Kantin Logic Integration:** Specialized pre-ordering system with transaction scheduling.
- **Digital Receipt Protocol:** Automated, aesthetic thermal-style digital receipts for every successful transaction.
- **Executive Analytics:** Automated PDF reporting for monthly revenue, top-selling stock, and inventory audits.
- **Modern UI/UX:** Built with a "Clean & Interactive" philosophy, featuring minimized sidebars and responsive layouts.

---

## 🛠️ Tech Stack

- **Backend:** [Laravel 12 (Latest)](https://laravel.com/)
- **Frontend:** [Tailwind CSS v4](https://tailwindcss.com/), [Alpine.js](https://alpinejs.dev/)
- **Templating:** Blade Engine
- **Database:** MySQL (Relational Schema with optimized indexing)
- **PDF Engine:** DomPDF / Barryvdh-Dompdf
- **Icons:** Lucide Icons / Heroicons

---

## 🚀 Local Installation

Follow these steps to set up the development environment:

1.  **Clone the Repository**

    ```bash
    git clone https://github.com/ninoell55/e_market.git
    cd e-market-fashion
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    npm install && npm run dev
    ```

3.  **Environment Configuration**
    Create your environment file and generate the application key.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Setup**
    Configure your `.env` database settings, then run the migrations.

    ```bash
    php artisan migrate --seed
    ```

5.  **Launch Application**
    ```bash
    php artisan serve
    ```
    Visit `http://127.0.0.1:8000` or `http://e_market.test` in your browser.

---

## 📊 Business Intelligence & Reporting

This project includes an **Executive Summary Generator** that exports professional PDF reports including:

- **Net Revenue Tracking**
- **Inventory Velocity Analysis** (Top vs. Under-performing stock)
- **Transaction Audit Logs**

---

## 🤝 Contribution & Feedback

As this project is part of my continuous learning journey in Software Engineering, I highly value technical feedback. Feel free to open an _issue_ or submit a _pull request_.

---

Copyright © 2026 **Nino Adityo Nugroho** | The Archive Digital Protocol
