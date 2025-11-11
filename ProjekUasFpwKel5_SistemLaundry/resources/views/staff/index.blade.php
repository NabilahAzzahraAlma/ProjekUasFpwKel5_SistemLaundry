public function index()
{
    $orders = Order::all();
    return view('staff.status', compact('orders'));
}
