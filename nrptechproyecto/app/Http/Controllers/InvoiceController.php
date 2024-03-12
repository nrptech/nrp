<?php

// app/Http/Controllers/InvoiceController.php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
Use PDF;

class InvoiceController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'El carrito está vacío');
        }

        // Lógica para crear un nuevo invoice asociado directamente al usuario
        $invoice = new Invoice([
            'total' => $cart->products->sum(function ($product) {
                return $product->pivot->amount * $product->price;
            }),
            'date' => now(),
        ]);

        $user->invoices()->save($invoice);

        // Eliminar el carrito y desvincular todos los productos
        $cart->products()->detach();
        $cart->delete();

        return view('invoice.show', ['invoice' => $invoice]);
    }

    public function show()
{
    $user = Auth::user();
    $invoice = $user->invoices()->latest()->first();

    if (!$invoice) {
        return redirect()->route('cart.show')->with('error', 'No hay factura disponible');
    }

    $orderData = [
        'order_id' => $invoice->order->id,
        'total' => $invoice->total,
        'order' => $invoice->order,
        'invoice' => $invoice,
    ];

    $pdf = PDF::loadView('invoice.show', compact('orderData'));

    return $pdf->stream('factura.pdf');
}
}
