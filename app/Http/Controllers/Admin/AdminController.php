<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Model\CouponsCategory;
// use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mail;

/**
 * Все изменения в логике, настройка работы, простмотр статистики, отчетность - работа этого контроллера
 */
class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin');
    }
    /**
     * render main admin dashboard
     * @return [type] [description]
     */
    public function showDashboard()
    {

        return view('admin.dashboard', [
            'usersTotal'    => count(User::all()), //зарегестривроанно всего
            'usersToday'    => count(DB::table("users")->where("created_at", Carbon::today())->get()),

            //all coupons
            'couponsTotal'  => count(Coupon::all()),
            'couponsActive' => count(DB::table('coupons')->where('is_show', 1)->get()),

            // платежи
            // 'paymentsTotal' => /**count(Payment::all())*/ 3,
            // "payments"      => DB::table('payments')->orderBy('id', 'desc')->simplePaginate(10),

            // views
            // 'viewsTotal'    => DB::table('accounting_datas')->where('slug', "views")->get()[0]->value,
            // 'viewsToday'    => (count(DB::table('views')->where('day', Carbon::now()->toDateString())->get()) > 0) ? DB::table('views')->where('day', Carbon::now()->toDateString())->get()[0]->count : 0,

        ]);
    }

    /**
     * все купоны
     * @return [type] [description]
     */
    public function allCoupons()
    {
        return view("admin.coupons.index", [
            'coupons' => DB::table('coupons')->simplePaginate(30),
        ]);
    }

    /**
     * Публикуем купон(он будет выводиться в главной странице)
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function publishCoupon($id)
    {
        $coupon = DB::table('coupons')->where('id', $id);
        if ($coupon->get()[0]->is_new === 1) {
            $coupon->update(["is_new" => 0]);
        }

        $coupon->update(['is_show' => 1]);
        return redirect()->back();
    }
    public function hideCoupon($id)
    {
        DB::table('coupons')->where('id', $id)->update(['is_show' => 0]);
        return redirect()->back();
    }

    public function showunconfirmedCoupons()
    {
        return view("admin.coupons.index", [
            'coupons' => DB::table('coupons')->where("is_show", 0)->simplePaginate(30),
        ]);
    }

    public function showNewCoupons()
    {
        return view("admin.coupons.index", [
            "coupons" => DB::table("coupons")->where("is_new", 1)->simplePaginate(30),
        ]);
    }

    /**
     * show single coupon by id
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showSingleCoupon($id)
    {
        return view("admin.coupons.single", [
            'coupon' => Coupon::find($id),
        ]);
    }

    /**
     * set coupon price. Each company and each coupon has his own
     * @param int  $id      coupon id
     * @param Request $request
     */
    public function setCouponPrice($id, Request $request)
    {
        $price = $request["price"];
        $data  = array();

        $coupon = DB::table('coupons')->where('id', $id);

        if ($coupon->get()[0]->is_new === 1) {
            $coupon->update(["is_new" => 0]);
        }

        $coupon->update([
            "costs" => $price,
        ]);
        $user           = User::find(Company::find(Coupon::find($id)->company_id)->user_id);
        $data['name']   = $user->name;
        $data['email']  = $user->email;
        $data['price']  = $request['price'];
        $data["coupon"] = Coupon::find($id)->title;
        Mail::send('email.pricechangenotification', $data, function ($message) use ($data) {
            $message->from(env('SUPPORT_EMAIL'), env('SUPPORT_NAME'));
            $message->sender(env('SUPPORT_EMAIL'), env('SUPPORT_NAME'));

            $message->to($data['email']);

            $message->subject('Цена за размещение купона');

            $message->priority(3);
        });
        return redirect()->back();
    }

    /**
     * Посмотреть все компании
     * @return [type] [description]
     */
    public function allComapanies()
    {
        return view("admin.companies.index", [
            "companies" => Company::all(),
        ]);
    }
    public function showCompanieById($id)
    {
        return view("admin.companies.single", [
            'company' => Company::find($id),
        ]);
    }

    // -------------------------------------
    // REFERAL
    // -------------------------------------
    public function showReferalSettings()
    {
        return view("admin.referal.dashboard");
    }

    /**
     * [showReferalList description]
     * @return [type] [description]
     */
    public function showReferalList()
    {
        return view('admin.referal.list', [
            'refs' => DB::table('referals')->paginate(50), //all referals
        ]);
    }

    /**
     * [showUnconfirmedCompanies description]
     * @return [type] [description]
     */
    public function showUnconfirmedCompanies()
    {
        return view("admin.companies.unconfirmed", [
            "companies" => DB::table("companies")->where("confirmed", 0)->get(),
        ]);
    }

    /**
     * [toTheFamily description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function toTheFamily($id)
    {
        DB::table("companies")->where("id", $id)->update(["confirmed" => 1]);
        return redirect()->back();
    }

    /**
     * [showCategories description]
     * @return view
     */
    public function showCategories()
    {
        $categories = CouponsCategory::all();
        return view('admin.coupons.categories', [
            'cats' => $categories,
        ]);
    }

    /**
     * search in database like in goolge using keywords
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function searchInSystem(Request $request)
    {
        $query  = $request['query'];
        $result = [];

        $coupons = DB::table("coupons")->where("title", "like", "$query")->get();
    }
}
