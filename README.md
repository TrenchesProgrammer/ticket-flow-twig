# TicketFlow

TicketFlow is a simple ticket management system built with PHP, Twig, and Tailwind CSS. It allows users to sign up, log in, create tickets, and manage their status.

## Features

-   **User Authentication:** Users can sign up and log in to their accounts.
-   **Ticket Management:** Create, view, update, and delete tickets.
-   **Dashboard:** View a summary of ticket statuses (total, open, in progress, closed).
-   **Responsive Design:** The application is designed to work on various screen sizes.

## Technologies Used

-   **Backend:** PHP
-   **Frontend:** Twig (template engine), Tailwind CSS
-   **Data Storage:** JSON files

## Getting Started

### Prerequisites

-   PHP installed on your system.
-   Composer for managing dependencies.

### Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/ticket-flow-twig.git
    cd ticket-flow-twig
    ```

2.  **Install dependencies:**

    ```bash
    composer install
    ```

3.  **Run the application:**

    You can use the built-in PHP server to run the application:

    ```bash
    php -S localhost:8000 -t public
    ```

    The application will be available at `http://localhost:8000`.

## Project Structure

```
.
├── data/
│   ├── tickets.json
│   └── users.json
├── public/
│   ├── index.php
│   ├── ... (other public files)
├── src/
│   ├── auth.php
│   └── tickets.php
├── templates/
│   ├── dashboard.html.twig
│   ├── index.html.twig
│   ├── login.html.twig
│   ├── signup.html.twig
│   └── tickets.html.twig
├── vendor/
├── composer.json
└── .env
```

-   `data/`: Stores the user and ticket data in JSON files.
-   `public/`: The web server's document root. Contains the front controller (`index.php`) and static assets.
-   `src/`: Contains the application's business logic (authentication and ticket management).
-   `templates/`: Twig templates for rendering the UI.
-   `vendor/`: Composer dependencies.
-   `composer.json`: Defines the project's dependencies.

## How It Works

-   **Routing:** The application uses a simple routing mechanism in the `public/*.php` files to handle different pages.
-   **Authentication:** User authentication is handled in `src/auth.php`. User data is stored in `data/users.json`.
-   **Ticket Management:** Ticket-related functionality is managed in `src/tickets.php`. Ticket data is stored in `data/tickets.json`.
-   **Templating:** The UI is rendered using Twig templates located in the `templates/` directory.
