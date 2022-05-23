<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MOdels\Crud;
use Session;

class CrudController extends Controller
{
    
    public function ShowData(){
        $ShowAllData = Crud::paginate(5);
        return view('show-data', compact('ShowAllData'));
    }

    public function AddData(){
        return view('add-data');
    }

    public function StoreData(Request $request){
        $request->all();
        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|email',
        ];
        $this->validate($request, $rules);
        $addData = New Crud();
        $addData->name = $request->name;
        $addData->email = $request->email;
        $addData->save();
        $request->session()->flash('msg', 'Added Success');
        return redirect('/');
    }
    
    public function EditData($id){
        $editData = Crud::find($id);
        return view('edit-data', compact('editData'));
    }

    public function UpdateData(Request $request, $id){
        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|email',
        ];
        $this->validate($request, $rules);
        $updateData = Crud::find($id);
        $updateData->name = $request->name;
        $updateData->email = $request->email;
        $updateData->save();
        $request->session()->flash('msg', 'Update Success');
        return redirect('/');
    }

    public function DeleteData($id){
        $deleteData = Crud::find($id);
        $deleteData->delete();
        return redirect('/');
    }
 
}
