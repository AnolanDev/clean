# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Bagisto** ecommerce application - a Laravel-based open-source ecommerce framework. Bagisto is built on Laravel 11 with a modular architecture using packages for different business domains.

## Development Commands

### Build and Development
- `npm run dev` - Start Vite development server
- `npm run build` - Build assets for production
- `php artisan serve` - Start Laravel development server

### Testing
- `./vendor/bin/phpunit` - Run PHPUnit tests
- `./vendor/bin/pest` - Run Pest tests (alternative test runner)
- `./vendor/bin/phpunit --testsuite="Admin Feature Test"` - Run specific test suite
- `./vendor/bin/phpunit --testsuite="Core Unit Test"` - Run Core unit tests
- `./vendor/bin/phpunit --testsuite="Shop Feature Test"` - Run Shop feature tests

### Code Quality
- `./vendor/bin/pint` - Run Laravel Pint code formatter (configured in `pint.json`)
- `./vendor/bin/pint --test` - Check code style without fixing

### Docker Development
- `docker-compose up -d` - Start all services (MySQL, Redis, Elasticsearch, Kibana, Mailpit)
- `./vendor/bin/sail up` - Laravel Sail wrapper for Docker

## Architecture Overview

### Modular Package Structure
Bagisto uses a modular architecture with packages located in `packages/Webkul/`. Key packages include:

**Core Business Packages:**
- `Admin/` - Admin panel interface and functionality
- `Shop/` - Frontend storefront
- `Core/` - Core framework functionality, system config, localization
- `Product/` - Product management, catalog, pricing
- `Category/` - Product categorization
- `Customer/` - Customer management, authentication, profiles
- `Sales/` - Order management, invoicing
- `Checkout/` - Shopping cart and checkout process
- `Payment/` - Payment method integrations
- `Shipping/` - Shipping method integrations
- `Inventory/` - Stock management

**Feature Packages:**
- `CMS/` - Content management system
- `Marketing/` - SEO, campaigns, URL rewrites
- `CartRule/` - Shopping cart promotions and coupons
- `CatalogRule/` - Product catalog pricing rules
- `BookingProduct/` - Booking and appointment products
- `Tax/` - Tax calculation and management
- `DataGrid/` - Data grid components for listings
- `DataTransfer/` - Import/export functionality
- `Theme/` - Theme management and customization
- `User/` - Admin user management
- `Attribute/` - Product attribute management
- `Notification/` - System notifications
- `GDPR/` - GDPR compliance features
- `SocialLogin/` - Social media authentication
- `Sitemap/` - XML sitemap generation
- `MagicAI/` - AI integration (OpenAI, Gemini, etc.)

### Custom Clean Package
This project includes a custom `Clean` package in `packages/Clean/` with:
- `Core/` - Core Clean functionality with models, repositories, services, and migrations for brands, categories, ingredients, and products
- `Admin/` - Admin interface extensions with analytics, brands, categories, ingredients, products, and safety views
- `Catalog/` - Catalog management features
- `Theme/` - Theme customizations with TailwindCSS configuration

### Key Technologies
- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Vue.js, Vite, TailwindCSS
- **Database**: MySQL 8.0
- **Search**: Elasticsearch 7.17.0
- **Cache**: Redis
- **Queue**: Laravel Queues
- **Mail**: Mailpit for local development
- **AI**: OpenAI, Gemini, Ollama integration

### Database Architecture
- Uses Laravel migrations in `database/migrations/`
- Package-specific migrations in `packages/Webkul/*/src/Database/migrations/`
- Seeders for initial data setup
- Supports multi-language with translatable models

### Frontend Assets
- Main app assets in `resources/js/app.js` and `resources/css/app.css`
- Custom Clean Theme assets in `packages/Clean/Theme/resources/assets/css/app.css`
- Package-specific assets in individual package directories
- Build process handled by Vite with custom configuration (`vite.config.mjs`)
- TailwindCSS configuration for Clean theme in `tailwind.config.js`
- Admin and Shop themes have separate asset builds

### Configuration
- Standard Laravel configuration in `config/`
- Package-specific configs in `packages/Webkul/*/src/Config/`
- Environment-based configuration using `.env`
- System configuration stored in database via `core_config` table

### Testing Structure
- Feature tests in `packages/Webkul/*/tests/Feature/`
- Unit tests in `packages/Webkul/*/tests/Unit/`
- Pest and PHPUnit supported with configuration in `tests/Pest.php`
- Test configuration in `phpunit.xml` with package-specific test suites
- Memory limit set to 1024M for tests

## Development Workflow

### Working with Packages
Each package follows Laravel conventions:
- Models in `src/Models/`
- Controllers in `src/Http/Controllers/`
- Routes in `src/Routes/`
- Views in `src/Resources/views/`
- Migrations in `src/Database/migrations/`
- Service providers in `src/Providers/`

### Adding New Features
1. Identify the appropriate package or create new one
2. Follow the existing package structure
3. Register routes, views, and services in the package's service provider
4. Run migrations and seeders as needed
5. Build frontend assets if modified (`npm run build` or `npm run dev`)
6. Run code quality checks with `./vendor/bin/pint`
7. Test changes with appropriate test suite

### Debugging
- Laravel Debugbar enabled in development
- Debug files stored in `storage/debugbar/`
- Use `php artisan tinker` for interactive debugging
- Log files in `storage/logs/`

## Important Notes

- This is a multi-tenant capable ecommerce platform
- Supports multiple languages and currencies (19 languages included)
- Uses Laravel Sail for Docker development
- Elasticsearch integration for advanced search
- Queue jobs for background processing
- Extensive use of Laravel events and listeners
- Repository pattern implementation
- Modular package-based architecture allows easy extension
- Custom Clean package extends Bagisto for specialized functionality
- TailwindCSS for styling with custom configuration

## Clean Package Specifics

### Custom Models
- `CleanBrand` - Product brand management
- `CleanCategory` - Product categorization
- `CleanIngredient` - Ingredient tracking and management
- `CleanProduct` - Product information with ingredient relationships
- `CleanSetting` - Application settings

### Database Structure
- Clean-specific migrations in `packages/Clean/Core/src/Database/Migrations/`
- Seeders for initial data setup
- Many-to-many relationship between products and ingredients

### Admin Interface
- Custom admin views for analytics, brands, categories, ingredients, products, and safety
- Located in `packages/Clean/Admin/src/Resources/views/`