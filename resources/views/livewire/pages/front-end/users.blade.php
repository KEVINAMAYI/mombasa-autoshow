<?php

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $users;
    public $search = '';


    public function mount()
    {
        $this->getUsers();
    }


    public function updatedSearch()
    {
        $this->getUsers();
    }

    // Method to fetch users based on search input
    public function getUsers()
    {
        if ($this->search) {
            $this->users = User::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->users = User::all();
        }
    }

    public function updatesUserStatus($user_id)
    {
        try {

            $user = User::find($user_id);

            if ($user->is_active) {
                $user->update(['is_active' => false]);
                $message = 'User deactivated successfully';
            } else {
                $user->update(['is_active' => true]);
                $message = 'User activated successfully';
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
                        <td><strong>Names</strong></td>
                        <td><strong>Email</strong></td>
                        <td><strong>Phone</strong></td>
                        <td><strong>Country</strong></td>
                        <td><strong>Town</strong></td>
                        <td><strong>Status</strong></td>
                        <td><strong>Date</strong></td>
                        <td><strong>Action</strong></td>
                    </tr>

                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->country->name }}</td>
                            <td>{{ $user->town }}</td>
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
                                    <button wire:click="updatesUserAdminStatus({{$user->id}})"
                                            class="btn btn-sm btn-outline-success">Set as Admin
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Users Were Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


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
