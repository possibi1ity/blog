@extends('admin/layout.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">角色列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="/admin/users/{{$user->id}}/role" method="POST">
                            <!-- <input type="hidden" name="_token" value="RPPMc0lhvtynKELDZljXlz9UZI9uNc55ip1P8GCM"> -->
                            {{csrf_field()}}
                            <div class="form-group">
                            @foreach($roles as $role)
                                    <div class="checkbox">
                                        <label>
                                            <!-- contains动词 -->
                                            <!-- 判断是否包含，集合的方法有非常多 -->
                                            <input type="checkbox" name="roles[]" 
                                            
                                            @if($myroles->contains($role)) 

                                            checked 

                                            @endif
                                            value="{{$role->id}}">

                                            {{$role->name}}
                                        </label>
                                    </div>
                            @endforeach
                                   
                            </div>
                            @include('layout.message')
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                   

                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection