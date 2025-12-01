# LiveWire 4 Features - Proof of Concept

A comprehensive demonstration of **LiveWire 4** features based on Caleb Porzio's keynote presentation. This project showcases the latest capabilities of LiveWire 4 (Beta) with interactive examples and real-world use cases.

![LiveWire 4](https://img.shields.io/badge/LiveWire-4.0%20Beta-FF2D20?style=for-the-badge&logo=livewire&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 🚀 Features Demonstrated

### Core LiveWire 4 Features

#### 1. **Request Interceptors** (`/interceptors`)
Intercept and customize LiveWire requests with powerful hooks:
- `onSend` - Modify requests before they're sent
- `onResponse` - Process responses before rendering
- `onRedirect` - Handle redirects programmatically
- `onError` - Custom error handling and recovery

#### 2. **Smart Loading Indicators** (`/loading`)
Automatic data-loading attributes with cross-component awareness:
- Automatic loading states
- Cross-component loading detection
- Customizable loading UI
- Seamless user experience

#### 3. **Blaze Engine** (`/blaze`)
Code folding and compile-time optimization:
- Blazing-fast Blade component rendering
- Compile-time optimizations
- Reduced runtime overhead
- Performance benchmarking examples

### Islands Architecture

#### 4. **Basic Islands** (`/islands`)
Isolate parts of your view with different rendering strategies:
- `lazy` - Load on demand
- `defer` - Defer until after page load
- `always` - Always update with parent

#### 5. **Advanced Islands** (`/islands/advanced`)
Advanced island features:
- Named islands for imperative control
- Streaming content
- Append/Prepend modes
- Manual island rendering

#### 6. **Nested Islands** (`/islands/nested`)
Multi-level island nesting:
- Independent updates per level
- Cascading rendering modes
- Complex component hierarchies

### Real-World Use Cases

#### 7. **Infinite Scroll** (`/islands/infinite-scroll`)
Lazy loading with viewport detection and append mode

#### 8. **Chat Interface** (`/islands/chat`)
Streaming messages with append mode and auto-scroll

#### 9. **Load More** (`/islands/load-more`)
Pagination with named islands and append mode

### Additional Features

#### 10. **Kanban Dashboard** (`/dashboard`)
Drag-and-drop Kanban board with:
- Sortable columns using Livewire 4's `wire:sort`
- Sortable cards within columns using `wire:sort:group`
- Persistent state management
- Real-time updates

## 🛠️ Tech Stack

- **Laravel** 12.x
- **LiveWire** 4.0 (Beta)
- **LiveWire Volt** 1.10 - Functional API for LiveWire
- **LiveWire Blaze** 0.1.0 - Performance optimization engine
- **Flux UI** 2.7 - Modern UI components
- **Tailwind CSS** 4.0 - Utility-first CSS framework
- **SQLite** - Database

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm
- SQLite extension enabled

## 🚀 Installation

### Quick Setup (Recommended)

```bash
# Clone the repository
git clone <repository-url>
cd livewire4PoC

# Run automated setup
composer setup
```

The `composer setup` command will:
1. Install PHP dependencies
2. Create `.env` file from `.env.example`
3. Generate application key
4. Run database migrations
5. Install npm dependencies
6. Build frontend assets

### Manual Setup

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Install npm dependencies
npm install

# Build assets
npm run build
```

## 🏃 Running the Application

### Development Mode (Recommended)

```bash
composer dev
```

This command runs concurrently:
- Laravel development server (`http://localhost:8000`)
- Queue worker
- Log viewer (Pail)
- Vite dev server (hot module replacement)

### Individual Services

```bash
# Laravel server only
php artisan serve

# Vite dev server only
npm run dev

# Queue worker
php artisan queue:listen

# Log viewer
php artisan pail
```

## 📁 Project Structure

```
livewire4PoC/
├── app/
│   └── Models/          # Eloquent models (Column, Card, Message)
├── database/
│   ├── migrations/      # Database migrations
│   └── seeders/         # Database seeders
├── resources/
│   ├── views/
│   │   ├── livewire/
│   │   │   ├── pages/   # Volt functional components
│   │   │   ├── kanban/  # Kanban components
│   │   │   └── components/
│   │   └── layouts/     # Layout files
│   └── css/             # Tailwind CSS
├── routes/
│   └── web.php          # Application routes
└── public/              # Public assets
```

## 🎯 Key Routes

| Route | Description |
|-------|-------------|
| `/` | Landing page with feature overview |
| `/interceptors` | Request Interceptors demo |
| `/loading` | Smart Loading Indicators demo |
| `/blaze` | Blaze Engine optimization demo |
| `/islands` | Basic Islands demo |
| `/islands/advanced` | Advanced Islands features |
| `/islands/nested` | Nested Islands demo |
| `/islands/infinite-scroll` | Infinite scroll use case |
| `/islands/chat` | Chat interface use case |
| `/islands/load-more` | Load more pagination use case |
| `/dashboard` | Kanban board dashboard |

## 🧪 Testing

```bash
# Run tests
composer test

# Or directly with PHPUnit
php artisan test
```

## 📚 Learning Resources

- [LiveWire 4 Documentation](https://livewire.laravel.com/docs)
- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Flux UI Components](https://fluxui.dev)

## 🎨 Features Highlights

### Modern UI/UX
- Dark mode support
- Smooth animations and transitions
- Responsive design
- Premium glassmorphism effects
- Interactive hover states

### Performance
- Optimized with Blaze engine
- Lazy loading strategies
- Efficient DOM updates
- Minimal JavaScript overhead

### Developer Experience
- Functional API with Volt
- Clean component architecture
- Type-safe interactions
- Hot module replacement

## 🤝 Contributing

This is a proof of concept project for learning and demonstration purposes. Feel free to:
- Report issues
- Suggest improvements
- Submit pull requests
- Use as a learning resource

## 📝 Notes

- This project uses **LiveWire 4 Beta** - not recommended for production yet
- The Kanban board uses Livewire 4's native `wire:sort` for drag-and-drop functionality
- All demos are interactive and include code examples
- Database uses SQLite for simplicity

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Credits

- Built based on [Caleb Porzio's LiveWire 4 Keynote](https://www.youtube.com/watch?v=your-video-id)
- Powered by [Laravel](https://laravel.com)
- UI components by [Flux](https://fluxui.dev)
- Styling by [Tailwind CSS](https://tailwindcss.com)

---

**Built with ❤️ using LiveWire 4**
