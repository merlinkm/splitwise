@extends('layout.app')

@section('content')
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Expenses</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('group.index') }}">group List </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Expenses of {{ $expense->description }}</h5>
                                    @foreach ($expense->groups as $item)
                                        <?php $group_id = $item->id; ?>
                                    @endforeach
                                    <a href="/view-expenses/{{ $group_id }}"><button class="btn btn-primary">View All
                                            Expenses</button></a>
                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title">Total Paid ${{ $expense->amount }}</h4>
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <p class="f-18">You Paid :
                                        ${{ $expense->user->id == env('SESSION_ID') ? $expense->amount : 0 }}
                                    </p>
                                    <p class="f-14"><strong>Crated By :</strong> {{ $expense->created_at }}</p>
                                    <p class="f-14"><strong>Updated By :</strong> {{ $expense->updated_at }}</p>
                                    <br>
                                    @foreach ($expense->groups as $item)
                                        @foreach ($item->user as $user)
                                            @if ($user->id == env('SESSION_ID') && $expense->user->id != env('SESSION_ID'))
                                                <p class="f-16">You owe ${{ $expense->per_person }}</p>
                                            @elseif($user->id == $expense->user->id)
                                                <p class="f-16"><b class="text-info">{{ $user->name }}
                                                        {{ $user->id == env('SESSION_ID') ? '(You)' : '' }}</b> get back
                                                    ${{ round($expense->amount - $expense->per_person, 2) }}</p>
                                            @else
                                                <p class="f-16">{{ $user->name }} owe ${{ $expense->per_person }}</p>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
