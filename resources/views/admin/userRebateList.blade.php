@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="padding-top:0;">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold uppercase"> 返利流水记录 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="username" value="{{Request::get('username')}}" id="username" placeholder="消费者" onkeydown="if(event.keyCode==13){do_search();}">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <input type="text" class="col-md-4 form-control input-sm" name="ref_username" value="{{Request::get('ref_username')}}" id="ref_username" placeholder="邀请人" onkeydown="if(event.keyCode==13){do_search();}">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <button type="button" class="btn btn-sm blue" onclick="do_search();">查询</button>
                                <button type="button" class="btn btn-sm grey" onclick="do_reset();">重置</button>
                            </div>
                        </div>
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th> #</th>
                                    <th> 消费者</th>
                                    <th> 邀请者</th>
                                    <th> 订单号</th>
                                    <th> 消费金额</th>
                                    <th> 返利金额</th>
                                    <th> 生成时间</th>
                                    <th> 处理时间</th>
                                    <th> 状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($list->isEmpty())
                                    <tr>
                                        <td colspan="9" style="text-align: center;">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($list as $vo)
                                        <tr class="odd gradeX">
                                            <td> {{$vo->id}} </td>
                                            <td> {!! empty($vo->user) ? '【账号已删除】' : '<a href="/admin/userRebateList?username=' . $vo->user->username . '">' . $vo->user->username . '</a>' !!} </td>
                                            <td> {!! empty($vo->ref_user) ? '【账号已删除】' : '<a href="/admin/userRebateList?ref_username=' . $vo->ref_user->username . '">' . $vo->ref_user->username . '</a>' !!} </td>
                                            <td> {{$vo->order_id}} </td>
                                            <td> {{$vo->amount}} </td>
                                            <td> {{$vo->ref_amount}} </td>
                                            <td> {{$vo->created_at}} </td>
                                            <td> {{$vo->updated_at}} </td>
                                            <td> {{$vo->status}} </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$list->total()}} 条记录</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $list->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        // 搜索
        function do_search() {
            var username = $("#username").val();
            var ref_username = $("#ref_username").val();

            window.location.href = '{{url('admin/userRebateList')}}' + '?username=' + username + '&ref_username=' + ref_username;
        }

        // 重置
        function do_reset() {
            window.location.href = '{{url('admin/userRebateList')}}';
        }
    </script>
@endsection