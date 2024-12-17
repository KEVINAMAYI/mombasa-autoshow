<?php

use App\Models\RewardSetting;
use App\Models\User;
use App\Models\UserAudit;
use App\Models\UserAward;
use App\Notifications\AccountActivation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert, WithPagination;

    public $search = '';
    public $prime_numbers = [];
    public $reward_multiplier;
    public $reward_divisor;

    protected $paginationTheme = 'bootstrap';


    protected $rules = [
        'prime_numbers.*' => 'integer|min:1', // Each prime number must be a positive integer
        'reward_multiplier' => 'required|integer|min:1',
        'reward_divisor' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->loadRewardSettings();
    }

    #[On('refresh-rewards-settings')]
    public function loadRewardSettings()
    {
        $rewardSetting = RewardSetting::first();

        if ($rewardSetting) {
            $this->prime_numbers = json_decode($rewardSetting->prime_numbers, true) ?? [];
            $this->reward_multiplier = $rewardSetting->reward_multiplier;
            $this->reward_divisor = $rewardSetting->reward_divisor;
        }
    }

    public function with()
    {
        return [
            'users' => $this->getUsers()->paginate(10)
        ];

    }


    public function updatedSearch()
    {
        return [
            'users' => $this->getUsers()->paginate(10)
        ];
    }

    public function getUsers()
    {
        $query = UserAudit::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('user_audits.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('user_audits.last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('user_audits.email', 'like', '%' . $this->search . '%')
                    ->orWhere('user_audits.phone_number', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }


    public function submit()
    {
        $this->validate();

        RewardSetting::updateOrCreate(
            ['id' => 1],
            [
                'prime_numbers' => json_encode($this->prime_numbers),
                'reward_multiplier' => $this->reward_multiplier,
                'reward_divisor' => $this->reward_divisor,
            ]
        );

        $this->loadRewardSettings();
        $this->alert('success', 'Rewards Variants saved successfully.');
    }


    public function addPrimeField()
    {
        $this->prime_numbers[] = '';
    }

    public function removePrimeField($index)
    {
        unset($this->prime_numbers[$index]);
        $this->prime_numbers = array_values($this->prime_numbers); // Re-index array
    }

} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Reward History</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row mb-4 g-8">
                    <div class="col-sm-9">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search users">
                    </div>
                    <div class="col-sm-3">
                        <button class="btn2 rewardSettingsBtn" style="margin-top:0;">Reward Settings</button>
                    </div>
                </div>
                <!-- =======end of Search====-->


                <table id="users_table"
                       class="table">
                    <tbody>
                    <tr>
                        <td><strong>User</strong></td>
                        <td><strong>Country</strong></td>
                        <td><strong>Town</strong></td>
                        <td><strong>Points</strong></td>
                        <td><strong>Points(Kshs)</strong></td>
                        <td><strong>Date</strong></td>
                    </tr>

                    @if($users->isNotEmpty()) <!-- Use isNotEmpty() for collection check -->
                    @foreach($users as $user)
                        <tr>
                            <td>

                                <div class="d-flex flex-column justify-content-center">
                                    <p style="font-weight: bold; font-size: 14px;">
                                        {{ $user->first_name.' '.$user->last_name }}
                                    </p>
                                    <p style="margin-top: -20px;" class="text-secondary mb-0">
                                        {{ $user->email }}
                                    </p>
                                    <p style="color:#007BFF; font-weight: bold;" class="text-secondary mb-0">
                                        {{ $user->phone_number }}
                                    </p>
                                </div>
                            </td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->town }}</td>
                            <td>{{ $user->points ?? '0' }}</td>
                            <td>{{ $user->points_in_ksh ?? '0' }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No Logs Were Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div>
                    {{ $users->links() }}
                </div>

            </div> <!--==end of <div id="page-contents">==-->

        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="wrapper-inner">==-->


    <div id="newsletter-wrap">
        <div id="container">
            <img src="front-end/images/news-line.jpg" class="news-line">
            <h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
            <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
            <form id="newsletter">
                <input type="email" id="newsInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </form>
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="newsletter-wrap">==-->

    <div class="modal fade" id="resetSettingsModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: rgb(128,51,165); font-weight: bold;" class="modal-title" id="shareModalLabel">
                        Rewards Variants</h5>
                </div>
                <div class="modal-body text-left" x-data="{ primeNumbers: @entangle('prime_numbers') }">
                    <form wire:submit.prevent="submit">
                        <div class="mb-4">
                            <label style="color: rgb(128,51,165);" for="prime_numbers" class="form-label">Prime
                                Numbers:</label>
                            <template x-for="(prime, index) in primeNumbers" :key="index">
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" x-model="primeNumbers[index]"
                                           placeholder="Enter a prime number" required>
                                    <button type="button" class="btn btn-outline-danger"
                                            @click="primeNumbers.splice(index, 1)">Remove
                                    </button>
                                </div>
                            </template>
                            <button type="button" class="btn btn-outline-primary" @click="primeNumbers.push('')">Add
                                More
                            </button>
                            @error('prime_numbers.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label style="color: rgb(128,51,165);" for="reward_multiplier" class="form-label">Reward
                                Multiplier:</label>
                            <input type="number" class="form-control" wire:model.debounce.500ms="reward_multiplier"
                                   placeholder="Enter reward multiplier" min="1" required>
                            @error('reward_multiplier') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label style="color: rgb(128,51,165);" for="reward_divisor" class="form-label">Reward
                                Divisor:</label>
                            <input type="number" class="form-control" wire:model.debounce.500ms="reward_divisor"
                                   placeholder="Enter reward divisor" min="1" required>
                            @error('reward_divisor') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeShareModalBtn" class="btn btn-secondary">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@push('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        $('.rewardSettingsBtn').on('click', function (e) {
            e.preventDefault();
            Livewire.dispatch('refresh-rewards-settings');
            $('#resetSettingsModal').modal('show');
        })

        $('#closeShareModalBtn').on('click', function (e) {
            $('#resetSettingsModal').modal('hide');
        })

    </script>
@endpush
