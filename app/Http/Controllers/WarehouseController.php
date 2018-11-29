<?php

namespace App\Http\Controllers;
use App\Helpers\LoginChecker;
use App\Helpers\ValidateAccess;
use Illuminate\Routing\Redirector;

class WarehouseController extends Controller
{
    public function __construct(Redirector $redirect){
        if(LoginChecker::check() !== true){                        
           $redirect->to('login')->send();                     
        }
    }
    
	public function index()
    {
        if(ValidateAccess::checkAccess(env('MODULE_WAREHOUSE', NULL), env('PERMISSION_READ', NULL)))
            return view('warehouse.index');
        else
            return redirect('error');
    }

    public function create()
    {
        if(ValidateAccess::checkAccess(env('MODULE_WAREHOUSE', NULL), env('PERMISSION_CREATE', NULL)))
    	   return view('warehouse.create');
        else
            return redirect('error');
    }
    
    public function edit($id)
    {
        if(ValidateAccess::checkAccess(env('MODULE_WAREHOUSE', NULL), env('PERMISSION_UPDATE', NULL)))
    	   return view('warehouse.edit', ['id'=>$id]);
        else
            return redirect('error');
    }

    public function product_entry()
    {
        return view('warehouse.product_entry');
    }

    public function movements()
    {
        return view('warehouse.list_movements'); 
    }

    public function createTransfer()
    {
        // if(ValidateAccess::checkAccess(env('MODULE_WAREHOUSE', NULL), env('PERMISSION_TRANSFER', NULL)))
        //    return view('warehouse.transfer', ['id'=>$id]);
        // else
        //     return redirect('error');
        return view('warehouse.createTransfer');
    }

    public function createOutput()
    {
        // if(ValidateAccess::checkAccess(env('MODULE_WAREHOUSE', NULL), env('PERMISSION_TRANSFER', NULL)))
        //    return view('warehouse.transfer', ['id'=>$id]);
        // else
        //     return redirect('error');
        return view('warehouse.createOutput');
    }

    public function getTransfer()
    {
        // if(ValidateAccess::checkAccess(env('MODULE_WAREHOUSE', NULL), env('PERMISSION_TRANSFER', NULL)))
        //    return view('warehouse.transfer', ['id'=>$id]);
        // else
        //     return redirect('error');
        return view('warehouse.search_transfer');
    }
}