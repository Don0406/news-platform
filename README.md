# News Publication Platform

## 🚀 Quick Start for Developers

### Prerequisites:
- PHP 8.0+
- Composer
- Node.js 16+
- MySQL/MariaDB

### Installation:
```bash
# 1. Clone repository
git clone https://github.com/YOUR_USERNAME/news-platform.git
cd news-platform

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
# Edit .env with your database credentials

# 4. Generate key and setup database
php artisan key:generate
php artisan migrate --seed

# 5. Start development servers
# Terminal 1: Frontend assets
npm run dev

# Terminal 2: Laravel server
php artisan serve