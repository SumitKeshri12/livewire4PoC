<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KanbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $columns = [
            ['name' => 'Backlog', 'position' => 0],
            ['name' => 'To Do', 'position' => 1],
            ['name' => 'In Progress', 'position' => 2],
            ['name' => 'Done', 'position' => 3],
        ];
        
        foreach ($columns as $columnData) {
            $column = \App\Models\Column::create($columnData);
            
            // Add cards to each column
            $cardCounts = ['Backlog' => 10, 'To Do' => 8, 'In Progress' => 6, 'Done' => 6];
            $count = $cardCounts[$column->name];
            
            for ($i = 0; $i < $count; $i++) {
                \App\Models\Card::create([
                    'column_id' => $column->id,
                    'title' => $this->getCardTitle($column->name, $i),
                    'description' => $this->getCardDescription($column->name, $i),
                    'position' => $i,
                ]);
            }
        }
    }
    
    private function getCardTitle($columnName, $index)
    {
        $titles = [
            'Backlog' => [
                'Implement user authentication',
                'Design dashboard mockups',
                'Set up CI/CD pipeline',
                'Add email notifications',
                'Create API documentation',
                'Implement dark mode',
                'Add export to PDF feature',
                'Set up monitoring',
                'Optimize database queries',
                'Add multi-language support',
            ],
            'To Do' => [
                'Fix login bug',
                'Update dependencies',
                'Write unit tests',
                'Refactor payment module',
                'Add loading states',
                'Implement search functionality',
                'Create user onboarding',
                'Add analytics tracking',
            ],
            'In Progress' => [
                'Build Kanban board',
                'Implement drag and drop',
                'Add modal editing',
                'Create toast notifications',
                'Optimize performance',
                'Add lazy loading',
            ],
            'Done' => [
                'Set up Laravel project',
                'Install Livewire',
                'Configure database',
                'Create models',
                'Run migrations',
                'Add sample data',
            ],
        ];
        
        return $titles[$columnName][$index] ?? "Task " . ($index + 1);
    }
    
    private function getCardDescription($columnName, $index)
    {
        $descriptions = [
            'Backlog' => [
                'Implement secure authentication system with email verification and password reset functionality.',
                'Create modern, responsive dashboard designs using Figma with dark mode support.',
                'Configure GitHub Actions for automated testing and deployment to staging/production.',
                'Add email notifications for important events using Laravel queues.',
                'Generate comprehensive API documentation using OpenAPI/Swagger specification.',
                'Implement theme switcher with dark mode using CSS variables and local storage.',
                'Add functionality to export reports and data to PDF format.',
                'Set up application monitoring with error tracking and performance metrics.',
                'Analyze and optimize slow database queries using indexes and eager loading.',
                'Add internationalization support for multiple languages using Laravel localization.',
            ],
            'To Do' => [
                'Users are unable to login after password reset. Investigate and fix the issue.',
                'Update all npm and composer dependencies to latest stable versions.',
                'Write comprehensive unit and feature tests to improve code coverage.',
                'Refactor payment processing module to support multiple payment gateways.',
                'Add loading indicators and skeleton screens for better UX.',
                'Implement full-text search across multiple models with filters.',
                'Create interactive onboarding flow for new users with tooltips.',
                'Integrate Google Analytics and track key user interactions.',
            ],
            'In Progress' => [
                'Building a fully functional Kanban board with Livewire 4 and Flux components.',
                'Implementing wire:sort for drag-and-drop functionality between columns.',
                'Adding Flux modals for editing cards with WYSIWYG editor.',
                'Implementing toast notifications using Flux toast component.',
                'Optimizing page load performance with Blaze and lazy loading.',
                'Adding islands and lazy loading for better performance with many cards.',
            ],
            'Done' => [
                'Successfully set up fresh Laravel 12 installation with all dependencies.',
                'Installed and configured Livewire 3.7 for reactive components.',
                'Configured MySQL database connection and created database.',
                'Created Column and Card models with relationships and sorting logic.',
                'Ran migrations successfully to create columns and cards tables.',
                'Created and ran seeder to populate database with sample Kanban data.',
            ],
        ];
        
        return $descriptions[$columnName][$index] ?? "Description for task " . ($index + 1);
    }
}
