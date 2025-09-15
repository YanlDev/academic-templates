# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel application for selling academic Excel templates. The application includes:

- **Frontend**: Public catalog of templates with categories, featured items, and template details
- **Backend**: Admin panel for managing templates and categories
- **Authentication**: Laravel Jetstream with Sanctum for API authentication
- **E-commerce**: Template purchasing and download system with shopping cart functionality
- **File Management**: Excel file storage and image handling for template previews

## Technology Stack

- **Framework**: Laravel 12.0 (PHP 8.2+)
- **Authentication**: Laravel Jetstream with Livewire
- **Frontend**: Vite + TailwindCSS + Alpine.js (via Jetstream)
- **Database**: Configured for SQLite (development) and other databases
- **File Processing**: Intervention Image for image handling
- **Excel**: Maatwebsite Excel package for file operations
- **Additional**: Spatie Sluggable for SEO-friendly URLs, Shopping Cart package

## Architecture

### Models & Relationships
- **Template**: Core model with categories, purchases, features, images, and YouTube videos as JSON columns
- **TemplateCategory**: Organizes templates hierarchically
- **Purchase**: Tracks template purchases by users
- **User**: Extended with Jetstream features (2FA, API tokens, teams)
- **DownloadLog**: Tracks template download history

### Controllers
- **TemplateController**: Public template catalog and details
- **Admin/CategoryController**: CRUD operations for template categories
- **Admin/DashboardController**: Admin dashboard overview
- **CartController**: Shopping cart functionality

### Views Structure
- `resources/views/templates/` - Public template views
- `resources/views/admin/` - Admin panel views
- `resources/views/components/` - Reusable Blade components
- Uses Blade templating with Jetstream layouts and components

### Routes
- `/` - Public template catalog (home)
- `/admin/*` - Admin routes (requires authentication + admin verification)
- API routes available via `routes/api.php`

## Development Commands

### Main Development Workflow
```bash
# Start full development environment (recommended)
composer run dev
# This runs: server, queue worker, logs (Pail), and Vite in parallel

# Individual services
php artisan serve          # Development server
php artisan queue:listen   # Queue worker
php artisan pail           # Real-time logs
npm run dev               # Vite asset compilation
```

### Testing & Quality
```bash
# Run tests with proper setup
composer run test
# Equivalent to: php artisan config:clear && php artisan test

# Code formatting
./vendor/bin/pint         # Laravel Pint code formatter

# Build for production
npm run build
```

### Database & Migrations
```bash
php artisan migrate              # Run migrations
php artisan migrate:fresh --seed # Fresh migration with seeders
php artisan db:seed             # Run seeders only
```

### Asset Management
```bash
# Development
npm run dev        # Start Vite dev server with HMR

# Production
npm run build      # Build optimized assets for production
```

### Storage & Cache
```bash
php artisan storage:link        # Create public storage symlink
php artisan config:cache        # Cache configuration
php artisan route:cache         # Cache routes
php artisan view:cache          # Cache Blade templates
```

## Key Development Notes

### File Uploads & Storage
- Template Excel files stored in `storage/app/public/templates/`
- Template images stored in `storage/app/public/images/`
- Use `storage:link` to create public symlinks for file access
- Intervention Image handles image processing and optimization

### JSON Columns
Several Template model attributes use JSON storage:
- `preview_images` - Array of image paths
- `features` - Array of template features/benefits
- `youtube_videos` - Array of video URLs/IDs
- `tags` - Array of searchable tags

### Admin Authentication
Admin routes use middleware stack: `['auth:sanctum', config('jetstream.auth_session'), 'verified']`
Ensure proper admin role verification is implemented in your middleware.

### Shopping Cart
Uses `hardevine/shoppingcart` package for cart functionality. Cart data persists across sessions.

### Slugs & SEO
Templates use Spatie Sluggable for URL-friendly slugs generated from template names.

## Database Considerations

- Default SQLite for development (see `database/database.sqlite`)
- Migration files include Jetstream's authentication features
- Use factories and seeders for development data
- Consider indexing on frequently queried fields (category_id, active, featured)