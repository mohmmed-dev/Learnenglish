<?php

namespace App\Livewire\Admin;

use App\Models\Playlist;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('layout.admin')]
#[Title('Manage Playlists')]
class ManagePlaylists extends Component
{
    public string $search = '';

    // Form fields
    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public ?int $category_id = null;

    public ?int $editingId = null;
    public bool $showModal = false;
    public ?int $confirmingDelete = null;

    protected function rules(): array
    {
        $uniqueRule = $this->editingId
            ? "unique:playlists,slug,{$this->editingId}"
            : 'unique:playlists,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|{$uniqueRule}",
            'description' => 'required|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function updatedName(): void
    {
        if (! $this->editingId) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $playlist = Playlist::findOrFail($id);
        $this->editingId = $playlist->id;
        $this->name = $playlist->name;
        $this->slug = $playlist->slug;
        $this->description = $playlist->description ?? '';
        $this->category_id = $playlist->category_id;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        Playlist::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'category_id' => $this->category_id,
            ]
        );

        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', $this->editingId ? 'Playlist updated.' : 'Playlist created.');
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDelete = $id;
    }

    public function delete(int $id): void
    {
        Playlist::findOrFail($id)->delete();
        $this->confirmingDelete = null;
        session()->flash('success', 'Playlist deleted.');
    }

    public function cancelDelete(): void
    {
        $this->confirmingDelete = null;
    }

    protected function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->category_id = null;
        $this->resetValidation();
    }

    public function render(): View
    {
        $playlists = Playlist::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->with('category')
            ->withCount('lessons')
            ->latest()
            ->paginate(15);

        $categories = Category::orderBy('name')->get();

        return view('livewire.admin.manage-playlists', compact('playlists', 'categories'));
    }
}
