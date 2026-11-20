<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layout.admin')]
#[Title('Manage Users')]
class ManageUsers extends Component
{
    public string $search = '';
    public string $filterProvider = '';

    public function toggleAdmin(int $userId): void
    {
        $user = User::findOrFail($userId);

        // Don't allow removing own admin access
        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot remove your own admin access.');
            return;
        }

        $user->update(['is_adman' => ! $user->is_adman]);
        session()->flash('success', $user->is_adman ? "'{$user->name}' is now an admin." : "'{$user->name}' is no longer an admin.");
    }

    public function render(): View
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->when($this->filterProvider, fn ($q) => $q->where('provider', $this->filterProvider))
            ->latest()
            ->paginate(20);

        $providers = User::query()
            ->whereNotNull('provider')
            ->distinct()
            ->pluck('provider');

        return view('livewire.admin.manage-users', compact('users', 'providers'));
    }
}
