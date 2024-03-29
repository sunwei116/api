<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/static/jquery.js"></script>
    <title>列表</title>
</head>
<body>
<input type="text" name="name" id="ss"><input type="button" value="搜索" class="search">
<table border="`">
    <tr>
        <th>姓名</th>
        <th>年龄</th>
        <th>操作</th>
    </tr>
    <tbody id="lists">

    </tbody>
</table>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = "http://w3.wei678.top/api/member";
    $.ajax({
        url:url,
        dataType:'json',
        method:'GET',
        success:function (res){
            // console.log(res);
            $.each(res,function (i,v) {
                var tr = $("<tr></tr>");
                tr.append("<td>"+v.name+"</td>");
                tr.append("<td>"+v.age+"</td>");
                tr.append("<td><a href='javascript:;' class='del' mid='"+v.id+"'>删除</a>|<a href='javascript:;' class='edit' mid='"+v.id+"'>修改</a></td>");
                $('#lists').append(tr);
            });
        },
    });
    //删除
    $(document).on('click','.del',function () {
        var id = $(this).attr('mid');
        var url = "http://w3.wei678.top/api/member";
        $.ajax({
            url:url+'/'+id,
            data:{_method:'DELETE'},
            dataType:'json',
            method:'POST',
            success:function (res) {
                if(res.code == 200){
                    alert(res.msg);
                    location.reload();
                }else{
                    alert(res.msg);
                }
            }
        });
    });
    //修改
    $(document).on('click','.edit',function () {
        var id =$(this).attr('mid');
        window.location.href="http://w3.wei678.top/member/edit?id="+id;
    });
    //搜索
    $('.search').on('click',function () {
        var name = $('#ss').val();
       var url = "http://w3.wei678.top/api/member";
       $.ajax({
           url:url,
           data:{name:name},
           dataType:'json',
           type:'GET',
           success:function (res) {
               $('#lists').empty();
                $.each(res,function(i,v){
                    var tr = $("<tr></tr>");
                    tr.append("<td>"+v.name+"</td>");
                    tr.append("<td>"+v.age+"</td>");
                    $('#lists').append(tr);
                })
           },
       });
    });
</script>
</html>