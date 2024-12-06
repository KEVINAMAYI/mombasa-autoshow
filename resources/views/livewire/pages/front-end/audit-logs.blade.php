<?php

use App\Models\User;
use App\Models\UserAudit;
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


} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Audit Logs</div>
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

</div>
