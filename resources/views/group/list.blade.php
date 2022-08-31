@extends('layout.app')
@section('style')
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css"
        href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min.css"> -->
    <link rel="stylesheet" type="text/css"
        href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css">
@endsection
@section('content')
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-user bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Groups</h5>
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
                                    <h5>Group List</h5>
                                    <a href="{{route('group.create')}}"><button class="btn btn-primary">Create Group</button></a>
                                </div>
                                <div class="card-block">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Name</th>
                                                    <th>Total Spending</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($groups) > 0)
                                                    <?php $i = 1; ?>
                                                    @foreach ($groups as $row)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $row->name }}</td>
                                                            <td>
                                                                <?php $total = 0; ?>
                                                                @foreach ($row->expenses as $item)
                                                                    <?php $total += $item->amount; ?>
                                                                @endforeach
                                                                ${{$total}}
                                                            </td>
                                                            <td>
                                                                <a href="/add-user/{{$row->id}}">
                                                                    <button class="btn btn-success">Add User</button>
                                                                </a> | 
                                                                <a href="/add-expenses/{{$row->id}}">
                                                                    <button class="btn btn-primary">Add Expenses</button>
                                                                </a> |
                                                                <a href="/view-expenses/{{$row->id}}">
                                                                    <button class="btn btn-info">View Expenses</button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif

                                                </tfoot>
                                        </table>
                                    </div>
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
    <script src="../files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="../files/assets/pages/data-table/js/data-table-custom.js"></script>
@endsection
