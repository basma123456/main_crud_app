<?php

namespace App\Http\Services\Admin;

use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class ModuleService
{
    /**
     * Get module by ID
     */
    public function findById(int $id): Module
    {
        return Module::findOrFail($id);
    }

    /**
     * Get module by title
     */
//    public function findByTitle(string $title): Module
//    {
//        return Module::where('title', $title)->firstOrFail();
//    }
    public function findByTitle(string $title)
    {
        $module = Module::where('title', $title)->firstOrFail();
        return $module;
    }


    /**
     * Get module with paginated posts
     */
    public function getModuleWithPosts(string $title, int $perPage = 10): array
    {
        $module = $this->findByTitle($title);

        $posts = $module->posts()
            ->orderBy('p_order', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return [
            'module' => $module,
            'posts' => $posts,
        ];
    }

    /**
     * Get all modules (with optional filters)
     */
    public function getAll(array $filters = [])
    {
        $query = Module::query();

        // Filter by title
        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        // Filter by status
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->get();
    }

    /**
     * Paginate modules
     */
    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = Module::query();

        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    /**
     * Create new module
     */
    public function create(array $data): Module
    {
        return DB::transaction(function () use ($data) {
            return Module::create($data);
        });
    }

    /**
     * Update module
     */
    public function update(int $id, array $data): Module
    {
        return DB::transaction(function () use ($id, $data) {
            $module = $this->findById($id);
            $module->update($data);

            return $module;
        });
    }

    /**
     * Delete module
     */
    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $module = $this->findById($id);
            return $module->delete();
        });
    }

    /**
     * Toggle module status (active/inactive)
     */
    public function toggleStatus(int $id): Module
    {
        $module = $this->findById($id);

        $module->status = !$module->status;
        $module->save();

        return $module;
    }

    /**
     * Get cached module with posts
     */
    public function getCachedModuleWithPosts(string $title, int $perPage = 10): array
    {
        return Cache::remember("module_{$title}_{$perPage}", 60, function () use ($title, $perPage) {
            return $this->getModuleWithPosts($title, $perPage);
        });
    }
}
