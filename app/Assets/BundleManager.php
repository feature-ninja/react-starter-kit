<?php

declare(strict_types=1);

namespace App\Assets;

use Illuminate\Foundation\Vite;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

final class BundleManager
{
    /**
     * @var Collection<string, RegisteredBundle>
     */
    private Collection $bundles;

    public function __construct()
    {
        $this->bundles = collect();
    }

    /**
     * @return Collection<string, RegisteredBundle>
     */
    public function all(): Collection
    {
        return $this->bundles->toBase();
    }

    public function register(string $name, string $path): void
    {
        $this->bundles->put($name, new RegisteredBundle(
            $name,
            realpath($path),
        ));
    }

    /**
     * @param  array<int, string>  $entryPoints
     */
    public function serve(string $name, array $entryPoints): HtmlString
    {
        $vite = (new Vite())
            ->useHotFile(storage_path("hot/$name"))
            ->useBuildDirectory("build/$name")
            ->withEntryPoints($entryPoints);

        return new HtmlString(
            implode("\n", array_filter([
                $vite->reactRefresh()?->toHtml(),
                $vite->toHtml(),
            ])),
        );
    }
}
