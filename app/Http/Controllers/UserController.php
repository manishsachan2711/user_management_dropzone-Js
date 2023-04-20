<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function index (Request $request) {
		if ($request->ajax()) {
			$users = User::query();

			return Datatables::of($users)

				// ->addColumn('action', function ($users) {
				// 	$btn = '<a href="/admin/user/edit/'.$users->id.'" class="" title="Edit"><i class="fa fa-edit"></i></a><a href="/admin.user.delete/'.$users->id.'" class="" title="Delete"><i class="fa fa-trash"></i></a>';
				// 	// dd($users->profile_photo);
                //     return $btn;

				// })
                ->addColumn('profile', function ($users) {
                    $url=url("uploads/images/".$users->profile_photo);
                    $img = '<img src='.$url.' width="40" class="img-rounded" align="center" />';
                    return $img;
             })
                ->editColumn('created_at', function ($users) {
					return [
						'display' => Carbon::parse($users->created_at)->format('d-m-Y h:i A'),
						'timestamp' => $users->created_at
					];
				})
                ->rawColumns(['profile',])
				->make(true);
		}
		return view('admin.user.list');
	}
}
