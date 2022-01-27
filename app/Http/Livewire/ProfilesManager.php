<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyNewlyAddedProfile;
use App\Models\Language;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class ProfilesManager extends Component
{
    use WithPagination;

    public $search;
    public $load = false;
    public $mode = 'create';
    public $showForm = false;
    public $showConfirmDeleteForm = false;
    public $profile = null;
    public $languages = [];
    public $state = [
        'name' => null,
        'surname' => null,
        'south_african_id_number' => null,
        'mobile' => null,
        'email' => null,
        'language_id' => null,
    ];
    public $birthdate = null;
    public $interests = [];

    protected $queryString = ['search'];

    protected $rules = [
        'state.name' => 'required',
        'state.surname' => 'required',
        'state.south_african_id_number' => 'required',
        'state.mobile' => 'required',
        'state.email' => 'required|email',
        'birthdate' => 'required',
        'state.language_id' => 'nullable',
    ];

    protected $validationAttributes = [
        'state.name' => 'name',
        'state.surname' => 'surname',
        'state.south_african_id_number' => 'south african id number',
        'state.mobile' => 'mobile',
        'state.email' => 'email',
        'birthdate' => 'birth date',
        'state.language_id' => 'language',
    ];

    public function mount()
    {
        $this->languages = Language::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset('state', 'birthdate', 'interests');
        $this->mode = 'create';

        $this->showForm = true;
    }

    public function edit(Profile $profile)
    {
        $this->reset('state', 'birthdate', 'interests');
        $this->mode = 'edit';
        $this->profile = $profile;

        $this->state = [
            'name' => $profile->name,
            'surname' => $profile->surname,
            'south_african_id_number' => $profile->south_african_id_number,
            'mobile' => $profile->mobile,
            'email' => $profile->email,
            'language_id' => $profile->language_id,
        ];
        $this->birthdate = optional($profile->birth_date)->toDateString();
        $this->interests = $profile->interests;

        $this->showForm = true;
    }

    public function submit()
    {
        $this->validate();

        if ($this->mode === 'create') {
            $profile = Profile::create([
                'name' => $this->state['name'],
                'surname' => $this->state['surname'],
                'south_african_id_number' => $this->state['south_african_id_number'],
                'mobile' => $this->state['mobile'],
                'email' => $this->state['email'],
                'birth_date' => $this->birthdate,
                'language_id' => $this->state['language_id'],
                'interests' => $this->interests,
            ]);

            NotifyNewlyAddedProfile::dispatch($profile);

            $this->emit('created');
        } else {
            $this->profile->update([
                'name' => $this->state['name'],
                'surname' => $this->state['surname'],
                'south_african_id_number' => $this->state['south_african_id_number'],
                'mobile' => $this->state['mobile'],
                'email' => $this->state['email'],
                'birth_date' => $this->birthdate,
                'language_id' => $this->state['language_id'],
                'interests' => $this->interests,
            ]);

            $this->emit('updated');
        }

        $this->reset('state', 'showForm');
    }

    public function delete(Profile $profile)
    {
        $this->profile = $profile;
        $this->mode = 'delete';

        $this->showConfirmDeleteForm = true;
    }

    public function destroy()
    {
        $this->profile->delete();

        $this->emit('deleted');

        $this->reset('showConfirmDeleteForm', 'profile');
    }

    public function render()
    {
        $profiles = [];

        if ($this->load) {
            $profiles = Profile::when($this->search, function ($query) {
                    $query->where(function ($query) {
                        $query->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('surname', 'like', '%'.$this->search.'%')
                            ->orWhere('south_african_id_number', 'like', '%'.$this->search.'%')
                            ->orWhere('mobile', 'like', '%'.$this->search.'%')
                            ->orWhere('email', 'like', '%'.$this->search.'%');
                    });
                })->paginate();
        }

        return view('livewire.profiles-manager', compact('profiles'));
    }
}
