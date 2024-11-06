<?php

namespace App\Http\Controllers;
use App\invoices;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        return view('customers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('customers.add_customer');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers,phone',
            'identity' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'The name field is required .',
            'phone.required' => 'The phone field is required .',
            'identity.required' => 'The identity field does not match.',
        ]);
        Customer::create($request->all());
        session()->flash('success', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('customers.index');
    }


    public function show($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }


    public function edit(Request $request, Customer $customer)
    {

        return view('customers.edit', compact('customer'));
    }


    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers,phone',
            'identity' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'The name field is required .',
            'phone.required' => 'The phone field is required .',
            'identity.required' => 'The identity field does not match.',
        ]);
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'identity' => $request->identity,

        ]);

        session()->flash('success', 'تم تعديل بيانات العميل بنجاح بنجاح');
        return redirect()->route('customers.index');
    }

    public function destroy(Request $request,Customer $customer)
    {

        $customer->delete();
        session()->flash('success','Deleted Successfully');
        return back();

    }



}
