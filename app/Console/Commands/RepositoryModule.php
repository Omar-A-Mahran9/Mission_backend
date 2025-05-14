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

        $type = $this->choice(
            'Is this for API or Dashboard?',
            ['Api', 'Dashboard'],
            0
        );

        $controllerPath = $type === 'Api'
            ? "App\\Http\\Controllers\\Api\\{$name}Controller"
            : "App\\Http\\Controllers\\Dashboard\\{$name}Controller";

        $controllerDir = app_path("Http/Controllers/" . ($type === 'Api' ? 'Api' : 'Dashboard'));
        File::ensureDirectoryExists($controllerDir);

        $controllerContent = "<?php

namespace App\Http\Controllers\\" . ($type === 'Api' ? "Api" : "Dashboard") . ";

use App\Http\Controllers\Controller;

class {$name}Controller extends Controller
{
    //
}
";
        File::put($controllerDir . "/{$name}Controller.php", $controllerContent);
        $this->info("✔️ Controller created: {$controllerPath}");
        $namespaceFolder = $type === 'Api' ? 'Api' : 'Dashboard';

        // Interface
        $contractDir = app_path("Repositories/{$namespaceFolder}/Contracts");
        File::ensureDirectoryExists($contractDir);
        $interfacePath = "{$contractDir}/{$name}RepositoryInterface.php";

        File::put($interfacePath, "<?php

            namespace App\Repositories\\{$namespaceFolder}\Contracts;

            interface {$name}RepositoryInterface
            {
                // define methods
            }
            ");
        $this->info("✔️ Interface created: {$interfacePath}");

        // Eloquent Repository
        $repoDir = app_path("Repositories/{$namespaceFolder}/Eloquent");
        File::ensureDirectoryExists($repoDir);
        $repoPath = "{$repoDir}/{$name}Repository.php";

        File::put($repoPath, "<?php

namespace App\Repositories\\{$namespaceFolder}\Eloquent;
use App\Repositories\\{$namespaceFolder}\Contracts\\{$name}RepositoryInterface;

class {$name}Repository implements {$name}RepositoryInterface
{
    // implement methods
}
");
        $this->info("✔️ Repository created: {$repoPath}");

        // Service
        $serviceDir = app_path("Services/{$namespaceFolder}");
        File::ensureDirectoryExists($serviceDir);
        $servicePath = "{$serviceDir}/{$name}Service.php";

        File::put($servicePath, "<?php

namespace App\Services;

use App\Repositories\\{$namespaceFolder}\Eloquent\\{$name}Repository;

class {$name}Service
{
    protected \${$name}Repository;

    public function __construct({$name}Repository \${$name}Repository)
    {
        \$this->{$name}Repository = \${$name}Repository;
    }
}
");
        $this->info("✔️ Service created: {$servicePath}");
    }
}
