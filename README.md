# TEAM1 ED8: Santa's Workshop API

This repository contains a base Laravel 11 project that implements a backend system for managing Christmas gift deliveries, children's lists, and elf operations.

## Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm or yarn
- MySQL >= 8.0 (or your preferred database)
- Git

## Installation

1. Clone the repository
```bash
git clone <repository-url>
cd <project-folder>
```

2. Install PHP dependencies
```bash
composer install
```

3. Install frontend dependencies
```bash
npm install
# or using yarn
yarn install
```

4. Environment Setup
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

5. Configure your `.env` file with your database credentials and other necessary settings
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run database migrations
```bash
php artisan migrate
```

## Running the Application

1. Start the development server
```bash
php artisan serve 
```

2. Compile frontend assets
```bash
# For development
npm run dev
# or
yarn dev

# For production
npm run build
# or
yarn build
```

Your application should now be running at `http://localhost:8000`

## Additional Commands

- Clear application cache
```bash
php artisan cache:clear
```

- Clear configuration cache
```bash
php artisan config:clear
```

- Run tests
```bash
php artisan test
```

## Development Standards

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Use git flow for branching
- Create feature branches for new development
- Write tests for new features

## Troubleshooting

If you encounter any issues:

1. Ensure all dependencies are installed correctly
2. Verify your PHP version meets the requirements
3. Make sure your database service is running
4. Check the Laravel logs in `storage/logs`
5. Clear all caches:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## License

This project is licensed under the [MIT License](LICENSE).
