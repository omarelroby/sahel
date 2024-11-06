<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Mpdf\Mpdf;

class InvoicesController extends Controller
{

    public function index()
    {
        $data['data']=Invoice::all();
        return view('invoice.index',$data);
    }

    public function create()
    {
         $data['customers']=Customer::all();
         $data['invoice_number']=str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
         $check = true;
         while ($check) {
            $check = Invoice::checkNumber($data['invoice_number']); // Call checkNumber each time
            if ($check) {
                $data['invoice_number']=str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            } else {

                break;
            }
         }
         return view('invoice.create',$data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'client_id' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'total_amount' => 'required',
        ], [
            'invoice_number.required' => 'The invoice number field is required .',
            'client_id.required' => 'The client name field is required .',
            'invoice_date.required' => 'The invoice date required.',
            'total_amount.required' => 'The total amount required.',
        ]);

        $client=Customer::getSingle($request->input('client_id'));
        $invoice=new Invoice();
        $invoice->invoice_number=$request->input('invoice_number');
        $invoice->client_id=$client->id;
        $invoice->invoice_date=$request->input('invoice_date');
        $invoice->due_date=$request->input('due_date');
        $invoice->total_amount=$request->input('total_amount');
        $invoice->save();

        if($request->has('items'))
        {
            foreach ($request->items as $key=>$item)
            {
                $item['invoice_id']=$invoice->id;
                $item['total']=$item['quantity']*$item['price_unit'];
                Item::create($item);
            }
        }
        session()->flash('success', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('invoice.index');
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.show', compact('invoice'));
     }
    public function download_invoice($id)
    {

        $invoice = Invoice::findOrFail($id);
        $html = view('invoice.pdf', compact('invoice'))->render();
        try {
            // Initialize mPDF with Arabic support settings
            $mpdf = new Mpdf([
                'default_font' => 'Amiri', // Use a font that supports Arabic
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
            ]);
            $mpdf->WriteHTML($html);
            $mpdf->Output('invoice.pdf', 'D');
        } catch (\Mpdf\MpdfException $e) {
            echo $e->getMessage();
        }
    }

    public function destroy(Request $request,Invoice $invoice)
    {

        $invoice->delete();
        session()->flash('success','Deleted Successfully');
        return back();

    }



}
