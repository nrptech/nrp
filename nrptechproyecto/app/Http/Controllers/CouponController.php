<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::orderBy('id', 'ASC')->paginate(5);
        $categories = Category::all();

        return view('admin.coupons.index', compact('coupons', 'categories'));
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

        $expiration = Carbon::parse($input['expiration'])->second(0);
        $input['expiration'] = $expiration;
        
        $coupon->update($input);
     

        foreach($coupon->products as $product){
            $product->update(['coupon_id' => null]); 
        }

        if ($request->has('products')) {
            foreach ($request->products as $product_id) {
                $product = Product::findOrFail($product_id);
                if($product_id>0){
                   $product->update(['coupon_id' => $id]); 
                }else{
                    $product->update(['coupon_id' => null]); 
                }
                
            }
        }

        $coupon->categories()->detach();
        $coupon->categories()->sync($request->input('categories', []));

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
    
        $expiration = Carbon::parse($input['expiration'])->second(0);
        $input['expiration'] = $expiration;

        $input['active'] = $request->has('active');
    
        Coupon::create($input);
    
        return redirect()->back()->with('success', 'Cupón creado con éxito');
    }
    


    public function assignToUsers()
    {
    }

    public function assignToProducts()
    {
    }
}
