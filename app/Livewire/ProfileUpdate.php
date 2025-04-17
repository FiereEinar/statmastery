<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileUpdate extends Component
{
    use WithFileUploads;
    
    public User $user;
    public $profile_picture;
    public $name;
    public $email;
    
    public function mount(User $user) {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updatedProfilePicture() {
        $this->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        if ($this->profile_picture) {
            // Delete old profile picture if it exists
            if ($this->user->profile_picture && Storage::disk('public')->exists($this->user->profile_picture)) {
                Storage::disk('public')->delete($this->user->profile_picture);
            }

            // Store new profile picture
            $path = $this->profile_picture->store('profile_pictures', 'public');

            // Update user
            $this->user->profile_picture = $path;
            $this->user->save();
        }
    }

    public function updateProfile() {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ]);

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();
    }
    
    public function render()
    {
        return view('livewire.profile-update');
    }
}