<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 制定允许其他域名访问
        header("Access-Control-Allow-Origin:*");
        // 响应类型
        header('Access-Control-Allow-Methods:POST');
        // 响应头设置
        header('Access-Control-Allow-Headers:x-requested-with, content-type');
        // 要求传递的 name hobby以及 model
        $name = request()->input('name');
        $where = [];
        if (!empty($name)){
            $where[] = ['name'=>$name];
        }
        $data = Member::where($where)->get();
        return json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $name = request()->post('name');
        $age = request()->post('age');

        if (empty($age) || empty($name)){
            return json_encode(['code'=>201,'msg'=>'参数不能为空']);
        }
        $res = Member::insert([
            'name' => $name,
            'age' => $age
        ]);
        if ($res) {
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'添加失败']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (empty($id)){
            return json_encode(['code'=>201,'msg'=>'id不能为空']);
        }
        $res = Member::where('id',$id)->first();
        return json_encode($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $name = request()->input('name');
        $age = request()->input('age');
        $member = Member::find($id);
        $member->name = $name;
        $member->age = $age;
        $res = $member->save();
        if ($res) {
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'修改失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($id)){
            return json_encode(['code'=>201,'msg'=>'id不能为空']);
        }
        $res = Member::where('id',$id)->delete();
        if ($res){
            return json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'删除失败']);
        }
    }

}
