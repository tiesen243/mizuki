<?php

namespace Core\Kernel;

class Container
{
    protected array $bindings = [];

    public function bind(string $abstract, string $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make(string $class, array $parameters = [])
    {
        if (isset($this->bindings[$class])) {
            $class = $this->bindings[$class];
        }

        $reflector = new \ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class {$class} is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $params = $constructor->getParameters();
        $dependencies = $this->resolveParameters($params, $parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    public function call($instance, string $method)
    {
        $reflector = new \ReflectionMethod($instance, $method);
        $params = $reflector->getParameters();
        $dependencies = $this->resolveParameters($params);

        return $reflector->invokeArgs($instance, $dependencies);
    }

    protected function resolveParameters(array $params, array $manual = []): array
    {
        $resolved = [];

        foreach ($params as $param) {
            $type = $param->getType();
            $name = $param->getName();

            if ($type && !$type->isBuiltin()) {
                $resolved[] = $this->make($type->getName());
            } elseif (isset($manual[$name])) {
                $resolved[] = $manual[$name];
            } elseif ($param->isDefaultValueAvailable()) {
                $resolved[] = $param->getDefaultValue();
            } else {
                throw new \Exception("Cannot resolve parameter {$name}");
            }
        }

        return $resolved;
    }
}
