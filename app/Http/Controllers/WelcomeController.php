<?php

namespace App\Http\Controllers;

use App\City;
use App\Company as Seller;
use App\CompanyType as Type;
use App\Coupon as Product;
use App\FaqQuest as Quest;
use App\Model\CouponsCategory;
use App\Views;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    protected $coupon_categories;
    public function __construct()
    {
        $this->coupon_categories = CouponsCategory::all();

        // russisanify
        Carbon::setLocale("ru");
    }
    /**
     * Переход на главную страницу.
     *
     * Реферальная программа: пользователь, пришедший по реферальной ссылке переходит толькo на глвную.
     *
     * Если он не зарегистрирован, то сохраняется в сессию рефералка до его регистрации.
     *
     * Если зареган, то нет.
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        // if ($request['ref'] != null) {
        //     if (Auth::user() !== null) {
        //         Session::put('ref', $request['ref']);
        //         // dd(Session::get('ref'));
        //     }

        // }

        $products = DB::table('coupons')->where(
            [
                ["is_show", 1],
                ["available_until", '>=', Carbon::now()->timestamp],
            ]
        )->orderBy('views')->get();

        $alert     = $request->alert ? $request->alert : null;
        $alertType = $request->alertType ? $request->alertType : null;
        $alertText = $request->alertText ? $request->alertText : null;
        // $action_top = DB::table("top_actions")->get()[0];
        // $coupon_categories =

        //выборка популярных купонов
        $productsPopular = DB::table("coupons")->where("is_show", 1)->orderBy("views")->get();

        return view('welcome', [
            'products'          => $products,
            "productsPopular"   => $productsPopular,
            'alert'             => $alert,
            'alertType'         => $alertType,
            'alertText'         => $alertText,
            // "action_top"        => $action_top,
            "coupon_categories" => $this->coupon_categories,
        ]);
    }

    /**
     * Возвращает форму регистрации
     * @return view форма регистрации компании
     */
    public function showRegisterCompanyView()
    {
        if (Auth::user() === null) {
            redirect("/login");
        }

        if (count(DB::table('companies')->where('user_id', Auth::user()->id)->get())) {
            return redirect('/');
        }

        return view('company.new', [
            'auth'      => Auth::user(),
            "alert"     => true,
            "alertType" => 'info',
            "alertText" => 'Чтобы разместить купон, расскажите о своей компании',
            // company creation information
            'types'     => Type::all(),
            'cities'    => City::all(),

        ]);
    }

    /**
     * add new company
     * @param  Request $request HTTP request
     * @return redirect           redirect to add first company coupon
     */
    public function registerCompany(Request $request)
    {
        // if (!$request['type'] || !$request['address'] || !$request['phone'] || $request['city']) {
        //     return redirect()->back();
        // }
        // dd($request);
        $company               = new Seller();
        $company->user_id      = Auth::user()->id;
        $company->name         = $request['name'];
        $company->type         = $request['type'];
        $company->address      = $request['address'];
        $company->city         = $request['city'];
        $company->phone        = $request['phone'];
        $company->preview_name = Storage::putFile('company', new File($request->file('preview')));
        $company->save();

        return redirect("/");
    }

    /**
     * Просмотра купона
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showSingleCoupon($id)
    {
        //просмотры пользователями
        // if (Auth::user() === null || Auth::user()->id != Seller::find(Product::find($id)->company_id)->user_id) {
        //     if (count(DB::table('views')->where('day', Carbon::now()->toDateString())->get()) > 0) {
        //         DB::table('views')->where('day', Carbon::now()->toDateString())->update([
        //             "count" => DB::table('views')->where('day', Carbon::now()->toDateString())->get()[0]->count + 1,
        //         ]);
        //     } else {
        //         $view        = new Views();
        //         $view->day   = Carbon::now()->toDateString();
        //         $view->count = 1;
        //         $view->save();
        //     }
            DB::table('coupons')->where('id', $id)->update([
                "views" => DB::table('coupons')->where('id', $id)->get()[0]->views + 1,
            ]);
            // DB::table('accounting_datas')->where('slug', 'views')->update(
            //     ["value" => DB::table('accounting_datas')->where('slug', 'views')->get()[0]->value + 1]
            // );
        // }

        $thisCoupon    = Product::find($id);
        $couponCompany = Seller::find($thisCoupon->company_id);
        // $couponsToo    = DB::table("coupons")->where("company_id", $thisCoupon->company_id)->get();
        return view("coupon", [
            "product"    => $thisCoupon,
            "couponCompany" => $couponCompany,
            // "otherCoupons"  => $couponsToo,
        ]);
    }

    public function search(Request $request)
    {
        $query           = $request['search'];
        $coupons         = DB::table('coupons')->where('coupon', "LIKE", "%" . $query . "%")->get();
        $productsPopular = DB::table("coupons")->where("is_show", 1)->orderBy("views")->get();
        // dd($coupons);
        return view('welcome', [
            'products' => $coupons,
            "search"   => true,
        ]);
    }

    /**
     * show categorie by id
     * @param  int $cat category id
     * @return view      view with coupons this category
     */
    public function showCategorie($cat)
    {
        $coupons = DB::table("coupons")->where("category_id", $cat)->get();
        return view("coupon.categorie", [
            "products"          => $coupons,
            "category_name"     => CouponCategories::find($cat)->name,
            "search"            => true,
            "coupon_categories" => $this->coupon_categories,
        ]);
    }

    public function blog()
    {
        return view("blog");
    }

    public function faq()
    {
        $quests = Quest::all();
        return view("faq", [
            'quests' => $quests,
        ]);
    }

    public function sendAsk(Request $request)
    {
        $contact = "";
        $contact .= isset($request['name']) ? $request["name"] : " ";
        $contact .= isset($request["email"]) ? $request["email"] : " ";
        $contact .= isset($request["phone"]) ? $request["phone"] : " ";

        $quest = $request["quest"];

        $data = [];

        $data["contact"] = $contact;
        $data["quest"]   = $quest;

        Mail::send('emails.faqd', $data, function ($message) use ($data) {
            $message->from("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');
            $message->sender("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');

            $message->to("aigul@chiki-chiki.kz");

            $message->subject('Вопрос в службу поддержки');

            $message->priority(3);
        });
        return redirect()->back();
    }

    public function showNewsPaper()
    {
        return view("newspaper", [
            "news" => DB::table("news")->get(),
        ]);
    }

    public function thanks()
    {
        return view('thanks', [
            'title' => 'Спасибо',
            'message' => 'Спасибо'
        ]);
    }
}
