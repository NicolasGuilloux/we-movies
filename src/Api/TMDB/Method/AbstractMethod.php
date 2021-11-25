<?php declare(strict_types=1);

namespace App\Api\TMDB\Method;

abstract class AbstractMethod
{
    /** @var array<string, mixed> */
    private array $cache = [];

    protected function hasCache(...$args): bool
    {
        $hash = md5(serialize($args));

        return array_key_exists($hash, $this->cache);
    }

    protected function getCache(...$args): mixed
    {
        $hash = md5(serialize($args));

        return $this->cache[$hash] ?? null;
    }

    protected function setCache(mixed $value, ...$args): void
    {
        $hash = md5(serialize($args));
        $this->cache[$hash] = $value;
    }
}
