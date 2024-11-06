<div style="width: 100%; margin: 0 auto; font-family: 'Amiri', sans-serif;">
    <div style="text-align: center;">
        <h2>Invoice Details</h2>
    </div>
    <table style="width: 100%; border-collapse: collapse; text-align: center; margin-top: 20px;">
        <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 8px;">اسم العميل</th>
            <th style="border: 1px solid #000; padding: 8px;">العنوان</th>
            <th style="border: 1px solid #000; padding: 8px;">رقم الفاتورة</th>
            <th style="border: 1px solid #000; padding: 8px;">تاريخ الفاتورة</th>
            <th style="border: 1px solid #000; padding: 8px;">تاريخ الاستحقاق</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid #000; padding: 8px;">{{ $invoice->client->name }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $invoice->client->address }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $invoice->invoice_number }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $invoice->invoice_date->format('Y-m-d') }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $invoice->due_date->format('Y-m-d') }}</td>
        </tr>
        </tbody>
    </table>
    @foreach($invoice->items as $key=>$item)
    <div style="text-align: center;">
        <h2>Item {{++$key}}</h2>
    </div>
    <table style="width: 100%; border-collapse: collapse; text-align: center; margin-top: 20px;">
        <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 8px;">الوصف</th>
            <th style="border: 1px solid #000; padding: 8px;">العدد</th>
            <th style="border: 1px solid #000; padding: 8px;">رقم الفاتورة</th>
            <th style="border: 1px solid #000; padding: 8px;">سعر الوحدة</th>
            <th style="border: 1px solid #000; padding: 8px;">الإجمالي</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid #000; padding: 8px;">{{ $item->description  }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $item->quantity  }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $item->invoice->invoice_number  }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $item->price_unit  }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $item->total  }}</td>
        </tr>
        </tbody>
    </table>
    @endforeach
</div>
