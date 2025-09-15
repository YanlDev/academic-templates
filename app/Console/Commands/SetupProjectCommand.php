<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup {--fresh : Run fresh migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the project with sample data';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Setting up Academic Templates project...');

        // Clear caches
        $this->info('📧 Clearing caches...');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        // Storage link
        if (!file_exists(public_path('storage'))) {
            $this->info('🔗 Creating storage link...');
            Artisan::call('storage:link');
        }

        // Migrations
        if ($this->option('fresh')) {
            $this->info('🗄️ Running fresh migrations...');
            Artisan::call('migrate:fresh');
        } else {
            $this->info('🗄️ Running migrations...');
            Artisan::call('migrate');
        }

        // Seeders
        $this->info('🌱 Running seeders...');
        Artisan::call('db:seed');

        $this->newLine();
        $this->info('✅ Project setup completed!');
        $this->newLine();

        $this->line('📊 <fg=green>Data created:</>');
        $this->line('  - 6 template categories');
        $this->line('  - 10+ templates with realistic data');
        $this->line('  - Fake images generated');
        $this->line('  - Admin user: admin@academic-templates.com');
        $this->line('  - Password: password');
        $this->line('  - 10 test users');

        $this->newLine();
        $this->line('🌐 <fg=cyan>Access points:</>');
        $this->line('  - Admin panel: ' . url('/admin'));
        $this->line('  - Public frontend: ' . url('/'));

        return Command::SUCCESS;
    }
}
