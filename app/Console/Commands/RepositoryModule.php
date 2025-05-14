<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RepositoryModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create controller, repository, interface, and service for API or Dashboard';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $type = $this->choice('Is this for API or Dashboard?', ['Api', 'Dashboard'], 0);

        $namespaceFolder = $type;
        $this->createController($name, $namespaceFolder);
        $this->createInterface($name, $namespaceFolder);
        $this->createRepository($name, $namespaceFolder);
        $this->createService($name, $namespaceFolder);
    }

    protected function createController(string $name, string $folder)
    {
        $dir = app_path("Http/Controllers/{$folder}");
        File::ensureDirectoryExists($dir);

        $path = "{$dir}/{$name}Controller.php";
        $namespace = "App\Http\Controllers\\{$folder}";
        $serviceNamespace = "App\\Services\\{$folder}\\{$name}Service";

        $content = <<<PHP
<?php

namespace {$namespace};

use App\Http\Controllers\Controller;
use {$serviceNamespace};

class {$name}Controller extends Controller
{
    protected \$service;

    public function __construct({$name}Service \$service)
    {
        \$this->service = \$service;
    }
}

PHP;

        $this->createFile($path, $content, 'Controller');
    }

    protected function createInterface(string $name, string $folder)
    {
        $dir = app_path("Repositories/{$folder}/Contracts");
        File::ensureDirectoryExists($dir);

        $path = "{$dir}/{$name}RepositoryInterface.php";
        $namespace = "App\Repositories\\{$folder}\Contracts";

        $content = <<<PHP
<?php

namespace {$namespace};

interface {$name}RepositoryInterface
{
    // define methods
}

PHP;

        $this->createFile($path, $content, 'Interface');
    }

    protected function createRepository(string $name, string $folder)
    {
        $dir = app_path("Repositories/{$folder}/Eloquent");
        File::ensureDirectoryExists($dir);

        $path = "{$dir}/{$name}Repository.php";
        $namespace = "App\Repositories\\{$folder}\Eloquent";
        $interfaceNamespace = "App\Repositories\\{$folder}\Contracts\\{$name}RepositoryInterface";

        $content = <<<PHP
<?php

namespace {$namespace};

use {$interfaceNamespace};

class {$name}Repository implements {$name}RepositoryInterface
{
    // implement methods
}

PHP;

        $this->createFile($path, $content, 'Repository');
    }

    protected function createService(string $name, string $folder)
    {
        $dir = app_path("Services/{$folder}");
        File::ensureDirectoryExists($dir);

        $path = "{$dir}/{$name}Service.php";
        $namespace = "App\Services\\{$folder}";
        $interfaceNamespace = "App\Repositories\\{$folder}\Contracts\\{$name}RepositoryInterface";

        $property = Str::camel($name) . 'Repository';

        $content = <<<PHP
<?php

namespace {$namespace};

use {$interfaceNamespace};

class {$name}Service
{
    protected \${$property};

    public function __construct({$name}RepositoryInterface \${$property})
    {
        \$this->{$property} = \${$property};
    }
}

PHP;

        $this->createFile($path, $content, 'Service');
    }

    protected function createFile(string $path, string $content, string $type)
    {
        if (!File::exists($path)) {
            File::put($path, $content);
            $this->info("✔️ {$type} created: {$path}");
        } else {
            $this->warn("⚠️ Skipped (already exists): {$path}");
        }
    }
}
