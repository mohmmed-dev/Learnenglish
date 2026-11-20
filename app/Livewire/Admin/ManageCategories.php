<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('layout.admin')]
#[Title('Manage Categories')]
class ManageCategories extends Component
{
    public string $search = '';

    // Form fields
    public string $name = '';
    public string $slug = '';
    public string $description = '';

    public ?int $editingId = null;
    public bool $showModal = false;
    public ?int $confirmingDelete = null;

    protected function rules(): array
    {
        $uniqueRule = $this->editingId
            ? "unique:categories,slug,{$this->editingId}"
            : 'unique:categories,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|{$uniqueRule}",
            'description' => 'required|string|max:1000',
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
        $category = Category::findOrFail($id);
        $this->editingId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description ?? '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        Category::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
            ]
        );

        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', $this->editingId ? 'Category updated.' : 'Category created.');
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDelete = $id;
    }

    public function delete(int $id): void
    {
        Category::findOrFail($id)->delete();
        $this->confirmingDelete = null;
        session()->flash('success', 'Category deleted.');
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
        $this->resetValidation();
    }

    public function render(): View
    {
        $categories = Category::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->withCount(['lessons', 'playlists'])
            ->latest()
            ->paginate(15);

        return view('livewire.admin.manage-categories', compact('categories'));
    }
}
