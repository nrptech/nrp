<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::orderBy('id', 'ASC')->paginate(5);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->products()->detach();
        $coupon->users()->detach();
        $coupon->categories()->detach();
        $coupon->delete();

        return redirect()->back()->with('success', 'Cupón borrado satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'expiration' => 'required|date',
            'quantity' => 'required|integer',
            'discount' => 'required|numeric',
        ]);

        $input = $request->all();
        $input['active'] = $request->has('active');
        $coupon = Coupon::find($id);

        $coupon->update($input);

        return redirect()->back()
            ->with('success', 'Cupón actualizado correctamente');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'expiration' => 'required|date',
            'quantity' => 'required|integer',
            'discount' => 'required|numeric',
        ]);

        

        $input = $request->all();
        
        $input['active'] = $request->has('active');

        Coupon::create($input);

        return redirect()->back()->with('success', 'Cupón creado con éxito');
    }
}
