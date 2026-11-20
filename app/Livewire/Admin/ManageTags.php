<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('layout.admin')]
#[Title('Manage Tags')]
class ManageTags extends Component
{
    public string $search = '';

    // Form fields
    public string $name = '';
    public string $slug = '';

    public ?int $editingId = null;
    public bool $showModal = false;
    public ?int $confirmingDelete = null;

    protected function rules(): array
    {
        $uniqueRule = $this->editingId
            ? "unique:tags,slug,{$this->editingId}"
            : 'unique:tags,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => "required|string|max:255|{$uniqueRule}",
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
        $tag = Tag::findOrFail($id);
        $this->editingId = $tag->id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        Tag::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
            ]
        );

        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', $this->editingId ? 'Tag updated.' : 'Tag created.');
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDelete = $id;
    }

    public function delete(int $id): void
    {
        Tag::findOrFail($id)->delete();
        $this->confirmingDelete = null;
        session()->flash('success', 'Tag deleted.');
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
        $this->resetValidation();
    }

    public function render(): View
    {
        $tags = Tag::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->withCount('lessons')
            ->latest()
            ->paginate(15);

        return view('livewire.admin.manage-tags', compact('tags'));
    }
}
