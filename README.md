# mizuki

## Overview

**mizuki** is a PHP-based project developed by [tiesen243](https://github.com/tiesen243).
This repository is public and open for contributions and feedback.

## Features

- Written primarily in PHP
- Designed for extensibility and easy integration

## Getting Started

1. **Clone the repository:**

   ```bash
   git clone https://github.com/tiesen243/mizuki.git
   cd mizuki
   ```

2. **Install dependencies:**

   ```bash
   composer install
   bun install
   ```

3. **Configure environment variables:**

   ```bash
   cp .env.example .env
   ```

   Edit `.env` with your settings.

4. **Set up the database:**

   ```bash
   docker compose up db -d
   php console.php migrate
   ```

5. **Start the development server:**

   ```bash
   bun dev
   ```

## License

This project is licensed under the MIT License. See the [LICENSE](./LICENSE) file for details.
