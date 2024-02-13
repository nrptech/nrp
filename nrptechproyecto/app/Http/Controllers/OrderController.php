<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Invoice;
use App\Models\PayMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function showInvoice()
    // {
    //     $user = Auth::user();
    //     $invoice = $user->invoices()->latest()->first(); // Obtener la última factura del usuario

    //     if (!$invoice) {
    //         return redirect()->route('cart.show')->with('error', 'No hay factura disponible');
    //     }

    //     return view('invoice.show', ['invoice' => $invoice]);
    // }

    public function showPayMethods()
    {
        $user = User::find(auth()->id());
        $paymentMethods = $user->paymentMethods;

        return view('order.show', compact('paymentMethods'));
    }

    public function savePayMethod(Request $request){

        $request->validate([
            'card_holder' => 'required|string',
            'card_number' => 'required|regex:/^\d{16}$/',
            'cvv' => 'required|digits:3',
        ]);

        $payMethodData = [
            'user_id' => auth()->id(),
            'card_holder' => $request->input('card_holder'),
            'card_number' => $request->input('card_number'),
            'cvv' => $request->input('cvv'),
        ];
    
        PayMethod::create($payMethodData);

        return redirect()->back()->with('success', 'Método de pago guardado exitosamente.');
    }
}