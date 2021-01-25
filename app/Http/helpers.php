<?php
use Illuminate\Support\Facades\DB;

function generateBillNo($month)
{
    //   bill format will be year-month-bill_no as like 2020-06-11
    //   getting last bill by this month
    $last_bill = DB::table('project_claim')
        ->where('month', $month)
        ->orderBy('id', 'desc')
        ->first();
    //  default bill number will be first bill of this month
    $bill_no = $month . '-' . '01';
    // if there is bill in this month we will add 1 with that number
    if ($last_bill) {
         $explode = explode('-', $last_bill->bill_no);

        // if last bill is 2 now will be plus one 2+1 = 3
         $plus_one = $explode[2] + 1;
         // if($plus_one < 10)
         // {
         //   $plus_one = '0'.$plus_one;
         // }
         $bill_no  = $month . '-' . $plus_one;
    }

    //  :) finally returning the bill number
    return $bill_no;

}

function sideMenu($role_id)
{
    $parent = DB::table('menus')
        ->select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.icon'))
        ->join('permissions', 'permissions.menu_id', '=', 'menus.id')
        ->where('permissions.role_id', $role_id)
        ->orderBy('menus.president', 'ASC')
        ->where('menus.parent_id', 0)
        ->get();

    $sidmenu = [];
    foreach ($parent as $value) {
        $menus              = [];
        $menus['id']        = $value->id;
        $menus['name']      = $value->name;
        $menus['url']       = $value->menu_url;
        $menus['icon']      = $value->icon;
        $menus['parent_id'] = $value->parent_id;

        if ($value->menu_url != null) {

            $menus['sub_menu'] = [];
        } else {

            $menus['sub_menu'] = subMenu($role_id, $value->id);

        }

        array_push($sidmenu, $menus);

    }

    return $sidmenu;

}

function subMenu($role_id, $id)
{

    return DB::table('menus')
        ->select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.icon'))
        ->join('permissions', 'permissions.menu_id', '=', 'menus.id')
        ->where('permissions.role_id', $role_id)
        ->where('menus.parent_id', '=', $id)
        ->orderBy('president', 'ASC')
        ->get()->toArray();
}

function makeNested($source)
{
    $menu = array();

    $sub_menu = array();

    $new_menu = [];

    foreach ($source as &$s) {
        if ($s['parent_id'] == 0) {
            // no parent_id so we put it in the root of the array
            $menu[] = &$s;
        }
        if ($s['parent_id'] != 0) {
            // it have  parent id so making child id
            $sub_menu[] = &$s;
        }
    }

    // in this loop we are puting child into there parent
    foreach ($menu as $key => $value) {
        $value['sub_menu'] = [];
        foreach ($sub_menu as $sk => $sub) {

            if ($value['id'] == $sub['parent_id']) {

                array_push($value['sub_menu'], $sub);

            }
        }

        array_push($new_menu, $value);
    }

    return $new_menu;
}

function generateMonthBetween($month_from, $month_to)
{
    $output = [];
    $time   = strtotime($month_from);
    $last   = date('Y-m', strtotime($month_to));

    do {
        $month = date('Y-m', $time);
        array_push($output, $month);

        $time = strtotime('+1 month', $time);
    } while ($month != $month_to);

    return $output;
}
