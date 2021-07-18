<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Mail\AlfatwahAlHanafia;
use App\Answer;
use Illuminate\Support\Facades\Storage;
use App\Article;
use App\Book;
use App\Category;
use App\EmailList;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $data = [
            'total_answered' => Answer::where('status', 'active')->count(),
            'total_question' => Question::where('status', 'active')->count(),
            'total_category' => Category::count(),
            'total_user' => User::where('status', 'active')->count(),
            'publish_article' => Article::where('status', 'active')->count(),
            'total_book' => Book::count()
        ];
        return view('backend.home')->with('data', $data);
    }

    public function root()
    {
        $adminRole = DB::table('roles')->where('name', 'admin')->first();
        $admins = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->where('model_has_roles.role_id', $adminRole->id)
        ->get();

        $subRole = DB::table('roles')->where('name', 'sub_admin')->first();
        $subAdmins = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->where('model_has_roles.role_id', $subRole->id)
        ->get();
        return view('backend.root')->with('admins', $admins)->with('subAdmins', $subAdmins);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }

    public function save(Request $request)
    {
        $request->validate([
            'password' => 'required:min:6',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->back();
    }

    public function edit(Request $request)
    {   
        $request->validate([
            'admin_id' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user = User::findOrFail($request->admin_id);
        $user->name = $request->name;
        $user->email_permission = $request->email_permission?? 0;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->save();
        return redirect()->back();

    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'recipent' => 'required'
        ]);
        if(auth()->user()->email_permission == 1){
            $file = "";
            if(isset($request->file)){
                $path = $request->file('file')->store('public');
                $file = Storage::url($path);
            }
            Mail::to($request->recipent)->send(new AlfatwahAlHanafia($request->subject, $request->body, $file));
            $email = new EmailList();
            $email->sender_id = auth()->id();
            $email->receiver_email = $request->recipent;
            $email->body = $request->body;
            $email->subject = $request->subject;
            $email->save();
            return redirect()->back();
        }
    }

    public function getEmailList()
    {
        $emails = EmailList::orderBy('created_at', 'DESC')->paginate(20);
        return view('backend.emailList')->with('emails', $emails);
    }
    public function email()
    {
        if(auth()->user()->email_permission == 1){
            return view('backend.email');
        }else{
            return redirect()->back();
        }
    }
}
