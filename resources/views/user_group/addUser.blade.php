@extends('layout.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" href="../files/bower_components/select2/css/select2.min.css" />

    <link rel="stylesheet" type="text/css"
        href="../files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="../files/bower_components/multiselect/css/multi-select.css" />

    <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css">
@endsection

@section('content')
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>User Groups</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('group.index') }}">Group List </a> </li>
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
                                    <h5>Add User in Group
                                    </h5>
                                </div>
                                <div class="card-block">
                                    <form method="post" action="/add-user/{{ $group['id'] }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Group Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly
                                                    value="{{ $group['name'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Add Users</label>
                                            <div class="col-sm-10">
                                                <select class="js-example-basic-multiple form-control" multiple="multiple"
                                                    name="user[]">
                                                    @if (count($users) > 0)
                                                        <?php $member = []; ?>
                                                        @foreach ($group->user as $me)
                                                            <?php $member[] = $me->id; ?>
                                                        @endforeach
                                                        @foreach ($users as $row)
                                                            <option value="{{ $row->id }}"
                                                                <?= in_array($row->id, $member) ? 'selected' : '' ?>>
                                                                {{ $row->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('user')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary ml-3">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="../files/bower_components/select2/js/select2.full.min.js"></script>

    <script type="text/javascript" src="../files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
    </script>
    <script type="text/javascript" src="../files/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="../files/assets/js/jquery.quicksearch.js"></script>

    <script type="text/javascript" src="../files/assets/pages/advance-elements/select2-custom.js"></script>
@endsection
