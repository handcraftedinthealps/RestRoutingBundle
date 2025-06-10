<?php

namespace HandcraftedInTheAlps\RestRoutingBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Yaml\Yaml;

class GenerateRoutes extends Command
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;

        parent::__construct('fos:rest:routing:dump-symfony-routes');
    }

    protected function configure(): void
    {
        $this->addOption(
            'name-prefix',
            null,
            InputOption::VALUE_REQUIRED,
            'Only show routes whose name is starting with this string',
        );
        $this->addOption(
            'controller-name',
            null,
            InputOption::VALUE_REQUIRED,
            'Name of the controller to dump',
        );
        $this->setDescription('This is a list of all routes in the project. Please copy and paste the relevant routes to your config.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $namePrefix = $input->getOption('name-prefix');
        $controllerName = $input->getOption('controller-name');

        $routes = [];
        foreach ($this->router->getRouteCollection() as $name => $route) {
            $routeData = $route->__serialize();
            // Unset things that are probably defaulted by Symfony
            unset($routeData['options']['compiler_class']);
            unset($routeData['options']['utf8']);
            if (\is_array($routeData['methods'] ?? null) && 1 === \count($routeData['methods'])) {
                $routeData['methods'] = $routeData['methods'][0];
            }
            $routeData['controller'] = $routeData['defaults']['_controller'] ?? '';
            unset($routeData['defaults']['_controller']);
            $routeData['format'] = $routeData['defaults']['_format'] ?? '';
            unset($routeData['defaults']['_controller']);
            $defaults = $routeData['defaults'] ?? [];
            $requirements = $routeData['requirements'] ?? [];
            unset($routeData['defaults']);
            unset($routeData['requirements']);
            if ([] !== $defaults) {
                $routeData['defaults'] = $defaults;
            }
            if ([] !== $requirements) {
                $routeData['requirements'] = $requirements;
            }

            foreach ($routeData as $key => $value) {
                if (!$value) {
                    unset($routeData[$key]);
                }
            }

            if ($this->filterMatches($name, $routeData, $namePrefix)) {
                $routes[$name] = $routeData;
            }
        }

        $output->writeln(Yaml::dump($routes));

        $io = new SymfonyStyle($input, $output);

        $io->info('If you do not like yaml. You can use the symplify/config-transformer package to change it into php.');

        return Command::SUCCESS;
    }

    private function filterMatches(string $name, array $data, ?string $namePrefix, ?string $controllerName): bool
    {
        if (null !== $namePrefix) {
            return str_starts_with($name, $namePrefix);
        }

        if (null !== $controllerName) {
            return str_starts_with($data['controller'], $controllerName);
        }

        return true;
    }
}
