<?php

declare(strict_types=1);

namespace HandcraftedInTheAlps\RestRoutingBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Yaml\Yaml;

class GenerateRoutes extends Command
{
    private string $projectDirectory;
    private RouterInterface $router;

    public function __construct(string $projectDirectory, RouterInterface $router)
    {
        $this->projectDirectory = $projectDirectory;
        $this->router = $router;

        parent::__construct('fos-routing:generate-symfony');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $routes = [];
        foreach ($this->router->getRouteCollection() as $name => $route) {
            $routeData = $route->__serialize();
            // Unset things that are probably defaulted by Symfony
            unset($routeData['options']['compiler_class']);
            unset($routeData['options']['utf8']);
            $routeData['controller'] = $routeData['defaults']['_controller'] ?? '';
            unset($routeData['defaults']['_controller']);
            $routeData['format'] = $routeData['defaults']['_format'] ?? '';
            unset($routeData['defaults']['_controller']);
            $defaults= $routeData['defaults'] ?? [];
            $requirements= $routeData['requirements'] ?? [];
            unset($routeData['defaults']);
            unset($routeData['requirements']);
            if ($defaults !== []) {
                 $routeData['defaults'] = $defaults;
            }
            if ($requirements !== []) {
                 $routeData['requirements'] = $requirements;
            }

            foreach ($routeData as $key => $value) {
                if (!$value) {
                    unset($routeData[$key]);
                }
            }
            $routes[$name] = $routeData;
        }

        ksort($routes);

        $targetPath = $this->projectDirectory . '/fos-routing.yaml';
        file_put_contents($targetPath, Yaml::dump($routes));

        $io = new SymfonyStyle($input, $output);
        $io->note('Generated routes to: ' . $targetPath);
        $io->comment('This is a list of all routes in the project. Please copy and paste the relevant routes to your config.');

        $io->info('If you do not like yaml. You can use the symplify/config-transformer package to change it into php.');

        return Command::SUCCESS;
    }
}
