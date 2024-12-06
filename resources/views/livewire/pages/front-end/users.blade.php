<?php

use App\Models\User;
use App\Models\UserAward;
use App\Notifications\AccountActivation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert, WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

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
        $query = User::query()
            ->leftJoin('user_awards', 'users.id', '=', 'user_awards.user_id')
            ->select('users.*', 'user_awards.points')
            ->orderBy('user_awards.points', 'DESC');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('users.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%')
                    ->orWhere('users.phone_number', 'like', '%' . $this->search . '%');
            });
        }

        return $query
    }


    public function updatesUserStatus($user_id)
    {
        try {

            $user = User::find($user_id);
            $accountActivated = false;

            if ($user->is_active) {
                $user->update(['is_active' => false]);
                $message = 'User deactivated successfully';
            } else {
                $user->update(['is_active' => true]);
                $accountActivated = true;
                $message = 'User activated successfully';
            }

            if ($accountActivated) {
                $user->notify(new AccountActivation());
            }

            $this->getUsers();
            $this->alert('success', $message);

        } catch (Exception $exception) {

            $this->alert('error', 'There was an error while updating user');

        }

    }

    public function updatesUserAdminStatus($user_id)
    {
        try {

            $user = User::find($user_id);

            if ($user->is_admin) {
                $user->update(['is_admin' => false]);
                $message = 'User is unset as Admin successfully';
            } else {
                $user->update(['is_admin' => true]);
                $message = 'User is set to Admin successfully';
            }

            $this->getUsers();
            $this->alert('success', $message);

        } catch (Exception $exception) {

            $this->alert('error', 'There was an error while updating user');

        }

    }

    public function resetPoints($user_id)
    {
        try {
            // Attempt to delete the user's awards
            $deleted = UserAward::where('user_id', $user_id)->delete();

            // Check if any rows were affected
            if ($deleted) {
                $this->alert('success', 'User’s awarded points were reset successfully.');
            } else {
                $this->alert('warning', 'No awarded points were found for this user.');
            }
        } catch (\Exception $e) {
            // Log the error and show a friendly message
            \Log::error('Error resetting rewards: ' . $e->getMessage());
            $this->alert('error', 'An error occurred while resetting the user’s awarded points.');
        }
    }


} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">All Users</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row mb-4 g-8">
                    <div class="col-sm-12">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search users">
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
                        <td><strong>Status</strong></td>
                        <td><strong>Date</strong></td>
                        <td><strong>Action</strong></td>
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
                            <td>{{ $user->country->name }}</td>
                            <td>{{ $user->town }}</td>
                            <td>{{ $user->awards->first()->points ?? '0' }}</td>
                            <td>{{ !empty($user->awards->first()->points) ? ($user->awards->first()->points * 50) : '0' }}</td>
                            <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}</td>
                            <td>
                                @if($user->is_active)
                                    <button wire:click="updatesUserStatus({{$user->id}})"
                                            class="btn btn-sm btn-outline-warning">Deactivate
                                    </button>
                                @else
                                    <button wire:click="updatesUserStatus({{$user->id}})"
                                            class="btn btn-sm btn-outline-success">Activate
                                    </button>
                                @endif
                                @if($user->is_admin)
                                    <button wire:click="updatesUserAdminStatus({{$user->id}})"
                                            class="btn btn-sm btn-outline-danger">Remove Admin
                                    </button>
                                @else
                                    <button ire:click="updatesUserAdminStatus({{$user->id}})"
                                            class="btn btn-sm btn-outline-success">Set as Admin
                                    </button>
                                @endif
                                <button wire:click="resetPoints({{$user->id}})"
                                        wire:confirm="User Awards will be reset to 0 !"
                                        class="btn btn-sm btn-outline-info">Reset points
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No Users Were Found</td>
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

</div>
