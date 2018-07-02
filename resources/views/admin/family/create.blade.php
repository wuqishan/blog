@extends('admin.common.base')

@section('content')

    @include('admin.common.header')
    @include('admin.common.nav')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Form Components</h1>
                <p>Bootstrap default form components</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item"><a href="#">Form Components</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" type="email" placeholder="Enter email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputPassword1">Password</label>
                                <input class="form-control" type="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1">Example select</label>
                                <select class="form-control" id="exampleSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" type="email" placeholder="Enter email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputPassword1">Password</label>
                                <input class="form-control" type="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1">Example select</label>
                                <select class="form-control" id="exampleSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('otherStaticSecond')
    <!-- Data table plugin-->
    <script type="text/javascript">
    </script>
@endsection