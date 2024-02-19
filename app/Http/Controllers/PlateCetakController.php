<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\PlateCetak;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlateCetakController extends Controller
{

    public function Data(Request $request)
    {
        if ($request->ajax() && $request->input('columnsData') != null) {
            $columnsData = $request->input('columnsData');
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $search = $request->input('search.value');
            $orderByColumnIndex = $request->input('order.0.column'); // Get the index of the column to sort by
            $orderByDirection = $request->input('order.0.dir'); // Get the sort direction ('asc' or 'desc')

            $query = PlateCetak::select('id', 'sale_order_id', 'status','time','machine','section','section_plate','warna_1','warna_2','warna_3','warna_4','warna_5','warna_6','warna_7','warna_8','warna_9','warna_10','warna_11','warna_12','created_by')->with('user','sale_order');

            // Apply search if a search term is provided
            if (!empty($search)) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q

                        ->where('time', 'like', '%' . $searchLower . '%')
                        ->orWhereHas('sale_order', function ($query) use ($searchLower) {
                            $query->where('order_no', 'like', '%' . $searchLower . '%');
                        })
                        ->orWhereHas('sale_order', function ($query) use ($searchLower) {
                            $query->where('kod_buku', 'like', '%' . $searchLower . '%');
                        })
                        ->orWhereHas('sale_order', function ($query) use ($searchLower) {
                            $query->where('description', 'like', '%' . $searchLower . '%');
                        })
                        ->where('warna_1', 'like', '%' . $searchLower . '%')
                        ->where('machine', 'like', '%' . $searchLower . '%')
                        ->where('section', 'like', '%' . $searchLower . '%')
                        ->where('section_plate', 'like', '%' . $searchLower . '%')
                        ->where('warna_2', 'like', '%' . $searchLower . '%')
                        ->where('warna_3', 'like', '%' . $searchLower . '%')
                        ->where('warna_4', 'like', '%' . $searchLower . '%')
                        ->where('warna_5', 'like', '%' . $searchLower . '%')
                        ->where('warna_6', 'like', '%' . $searchLower . '%')
                        ->where('warna_7', 'like', '%' . $searchLower . '%')
                        ->where('warna_8', 'like', '%' . $searchLower . '%')
                        ->where('warna_9', 'like', '%' . $searchLower . '%')
                        ->where('warna_10', 'like', '%' . $searchLower . '%')
                        ->where('warna_11', 'like', '%' . $searchLower . '%')
                        ->where('warna_12', 'like', '%' . $searchLower . '%')
                        ->orWhereHas('user', function ($query) use ($searchLower) {
                            $query->where('user_name', 'like', '%' . $searchLower . '%');
                        })
                        ->where('status', 'like', '%' . $searchLower . '%');
                    // Add more columns as needed
                });
            }
            $results = null;

            if (!empty($columnsData)) {

                $sortableColumns = [

                    1 => 'time',
                    2 => 'sale_order_id',
                    3 => 'sale_order_id',
                    4 => 'sale_order_id',
                    5 => 'machine',
                    6 => 'section',
                    7 => 'section_plate',
                    9 => 'warna_2',
                    10 => 'warna_3',
                    11 => 'warna_4',
                    12 => 'warna_5',
                    13 => 'warna_6',
                    14 => 'warna_7',
                    15 => 'warna_8',
                    16 => 'warna_9',
                    17 => 'warna_10',
                    18 => 'warna_11',
                    19 => 'warna_12',
                    20 => 'created_by',
                    21 => 'status',
                    // Add more columns as needed
                ];
                if($orderByColumnIndex != null){
                    if($orderByColumnIndex == "0"){
                        $orderByColumn = 'created_at';
                        $orderByDirection = 'ASC';
                    }else{
                        $orderByColumn = $sortableColumns[$orderByColumnIndex];
                    }
                }else{
                    $orderByColumn = 'created_at';
                }
                if($orderByDirection == null){
                    $orderByDirection = 'ASC';
                }
                $results = $query->where(function ($q) use ($columnsData) {
                    foreach ($columnsData as $column) {
                        $searchLower = strtolower($column['value']);

                        switch ($column['index']) {
                            case 1:
                                $q->where('time', 'like', '%' . $searchLower . '%');

                                break;
                            case 2:
                                $q->whereHas('sale_order', function ($query) use ($searchLower) {
                                    $query->where('order_no', 'like', '%' . $searchLower . '%');
                                });

                                break;
                            case 3:
                                $q->whereHas('sale_order', function ($query) use ($searchLower) {
                                    $query->where('description', 'like', '%' . $searchLower . '%');
                                });
                                break;
                            case 4:
                                $q->whereHas('sale_order', function ($query) use ($searchLower) {
                                    $query->where('kod_buku', 'like', '%' . $searchLower . '%');
                                });
                                break;
                            case 5:
                                $q->where('machine', 'like', '%' . $searchLower . '%');
                                break;
                            case 6:
                                $q->where('section', 'like', '%' . $searchLower . '%');
                                break;
                            case 7:
                                $q->where('section_plate', 'like', '%' . $searchLower . '%');
                                break;
                            case 8:
                                $q->where('warna_1', 'like', '%' . $searchLower . '%');
                                break;
                            case 9:
                                $q->where('warna_2', 'like', '%' . $searchLower . '%');
                                break;
                            case 10:
                                $q->where('warna_3', 'like', '%' . $searchLower . '%');
                                break;
                            case 11:
                                $q->where('warna_4', 'like', '%' . $searchLower . '%');
                                break;
                            case 12:
                                $q->where('warna_5', 'like', '%' . $searchLower . '%');
                                break;
                            case 13:
                                $q->where('warna_6', 'like', '%' . $searchLower . '%');
                                break;
                            case 14:
                                $q->where('warna_7', 'like', '%' . $searchLower . '%');
                                break;
                            case 15:
                                $q->where('warna_8', 'like', '%' . $searchLower . '%');
                                break;
                            case 16:
                                $q->where('warna_9', 'like', '%' . $searchLower . '%');
                                break;
                            case 17:
                                $q->where('warna_10', 'like', '%' . $searchLower . '%');
                                break;
                            case 18:
                                $q->where('warna_11', 'like', '%' . $searchLower . '%');
                                break;
                            case 19:
                                $q->where('warna_12', 'like', '%' . $searchLower . '%');
                                break;
                            case 20:
                                $q->where('created_by', 'like', '%' . $searchLower . '%');
                                break;
                            case 21:
                                $q->where('status', 'like', '%' . $searchLower . '%');
                                break;

                            default:
                                break;
                        }
                    }
                })->orderBy($orderByColumn, $orderByDirection)->get();
            }

            // Process and format the results for DataTables
            $recordsTotal = $results ? $results->count() : 0;

            // Check if there are results before applying skip and take
            if ($results->isNotEmpty()) {
                $uom = $results->skip($start)->take($length)->all();
            } else {
                $uom = [];
            }

            $index = 0;
            foreach ($uom as $row) {
                $row->sr_no = $start + $index + 1;
                if ($row->status == 'checked') {
                    $row->status = '<span class="badge badge-warning">Checked</span>';
                    $actions = '<a class="dropdown-item" href="' . route('plate_cetak.view', $row->id) . '">View</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.edit', $row->id) . '">Edit</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.verify', $row->id) . '">Verify</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.delete', $row->id) . '">Delete</a>';
                } else if ($row->status == 'verified') {
                    $row->status = '<span class="badge badge-success">Verified</span>';
                    $actions = '<a class="dropdown-item" href="' . route('plate_cetak.view', $row->id) . '">View</a>
                                <a class="dropdown-item" href="' . route('plate_cetak.delete', $row->id) . '">Delete</a>';
                } else if ($row->status == 'declined') {
                    $row->status = '<span class="badge badge-danger">Declined</span>';
                    $actions = '<a class="dropdown-item" href="' . route('plate_cetak.view', $row->id) . '">View</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.edit', $row->id) . '">Edit</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.verify', $row->id) . '">Verify</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.delete', $row->id) . '">Delete</a>';
                }

                $row->action = '<div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                data-toggle="dropdown" id="dropdownMenuButton" type="button">Action <i class="fas fa-caret-down ml-1"></i></button>
                                <div  class="dropdown-menu tx-13">
                                    ' . $actions . '
                                </div>
                            </div>';
                $index++;
            }

            // // Continue with your response
            $uomsWithoutAction = array_map(function ($row) {
                return $row;
            }, $uom);

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal, // Total records after filtering
                'data' => array_values($uomsWithoutAction),
            ]);
        } elseif ($request->ajax()) {

            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $search = $request->input('search.value');
            $orderByColumnIndex = $request->input('order.0.column'); // Get the index of the column to sort by
            $orderByDirection = $request->input('order.0.dir'); // Get the sort direction ('asc' or 'desc')

            $query = PlateCetak::select('id', 'sale_order_id', 'status','time','machine','section','section_plate','warna_1','warna_2','warna_3','warna_4','warna_5','warna_6','warna_7','warna_8','warna_9','warna_10','warna_11','warna_12','created_by')->with('user','sale_order');

            // Apply search if a search term is provided
            if (!empty($search)) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q
                        ->where('time', 'like', '%' . $searchLower . '%')
                        ->orWhereHas('sale_order', function ($query) use ($searchLower) {
                            $query->where('order_no', 'like', '%' . $searchLower . '%');
                        })
                        ->orWhereHas('sale_order', function ($query) use ($searchLower) {
                            $query->where('kod_buku', 'like', '%' . $searchLower . '%');
                        })
                        ->orWhereHas('sale_order', function ($query) use ($searchLower) {
                            $query->where('description', 'like', '%' . $searchLower . '%');
                        })
                        ->where('machine', 'like', '%' . $searchLower . '%')
                        ->where('section', 'like', '%' . $searchLower . '%')
                        ->where('section_plate', 'like', '%' . $searchLower . '%')
                        ->where('warna_1', 'like', '%' . $searchLower . '%')
                        ->where('warna_2', 'like', '%' . $searchLower . '%')
                        ->where('warna_3', 'like', '%' . $searchLower . '%')
                        ->where('warna_4', 'like', '%' . $searchLower . '%')
                        ->where('warna_5', 'like', '%' . $searchLower . '%')
                        ->where('warna_6', 'like', '%' . $searchLower . '%')
                        ->where('warna_7', 'like', '%' . $searchLower . '%')
                        ->where('warna_8', 'like', '%' . $searchLower . '%')
                        ->where('warna_9', 'like', '%' . $searchLower . '%')
                        ->where('warna_10', 'like', '%' . $searchLower . '%')
                        ->where('warna_11', 'like', '%' . $searchLower . '%')
                        ->where('warna_12', 'like', '%' . $searchLower . '%')
                        ->orWhereHas('user', function ($query) use ($searchLower) {
                            $query->where('user_name', 'like', '%' . $searchLower . '%');
                        })
                        ->where('status', 'like', '%' . $searchLower . '%');
                    // Add more columns as needed
                });
            }

            $sortableColumns = [

                1 => 'time',
                2 => 'sale_order_id',
                3 => 'sale_order_id',
                4 => 'sale_order_id',
                5 => 'machine',
                6 => 'section',
                7 => 'section_plate',
                9 => 'warna_2',
                10 => 'warna_3',
                11 => 'warna_4',
                12 => 'warna_5',
                13 => 'warna_6',
                14 => 'warna_7',
                15 => 'warna_8',
                16 => 'warna_9',
                17 => 'warna_10',
                18 => 'warna_11',
                19 => 'warna_12',
                20 => 'created_by',
                21 => 'status',
                // Add more columns as needed
            ];

            if($orderByColumnIndex != null){
                if($orderByColumnIndex != "0"){
                    $orderByColumn = $sortableColumns[$orderByColumnIndex];
                    $query->orderBy($orderByColumn, $orderByDirection);
                }else{
                    $query->latest('created_at');
                }
            }else{
                $query->latest('created_at');
            }
            $recordsTotal = $query->count();

            $uom = $query
                ->skip($start)
                ->take($length)
                ->get();

            $uom->each(function ($row, $index)  use (&$start) {
                $row->sr_no = $start + $index + 1;
                if ($row->status == 'checked') {
                    $row->status = '<span class="badge badge-warning">Checked</span>';
                    $actions = '<a class="dropdown-item" href="' . route('plate_cetak.view', $row->id) . '">View</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.edit', $row->id) . '">Edit</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.verify', $row->id) . '">Verify</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.delete', $row->id) . '">Delete</a>';
                } else if ($row->status == 'verified') {
                    $row->status = '<span class="badge badge-success">Verified</span>';
                    $actions = '<a class="dropdown-item" href="' . route('plate_cetak.view', $row->id) . '">View</a>
                                <a class="dropdown-item" href="' . route('plate_cetak.delete', $row->id) . '">Delete</a>';
                } else if ($row->status == 'declined') {
                    $row->status = '<span class="badge badge-danger">Declined</span>';
                    $actions = '<a class="dropdown-item" href="' . route('plate_cetak.view', $row->id) . '">View</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.edit', $row->id) . '">Edit</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.verify', $row->id) . '">Verify</a>
                    <a class="dropdown-item" href="' . route('plate_cetak.delete', $row->id) . '">Delete</a>';
                }

                $row->action = '<div class="dropdown">
                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                data-toggle="dropdown" id="dropdownMenuButton" type="button">Action <i class="fas fa-caret-down ml-1"></i></button>
                                <div  class="dropdown-menu tx-13">
                                    ' . $actions . '
                                </div>
                            </div>';
            });

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal, // Total records after filtering
                'data' => $uom,
            ]);
        }
    }

    public function index(){
        if (
            Auth::user()->hasPermissionTo('PLATE CETAK List') ||
            Auth::user()->hasPermissionTo('PLATE CETAK Create') ||
            Auth::user()->hasPermissionTo('PLATE CETAK Update') ||
            Auth::user()->hasPermissionTo('PLATE CETAK View') ||
            Auth::user()->hasPermissionTo('PLATE CETAK Delete') ||
            Auth::user()->hasPermissionTo('PLATE CETAK Verify')
        ) {
            Helper::logSystemActivity('PLATE CETAK List', 'PLATE CETAK List');
            return view('Mes.PlateCetak.index');
        }
        return back()->with('custom_errors', 'You don`t have Right Permission');
    }


    public function create(){
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Create')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Create');
        return view('Mes.PlateCetak.create');
    }

    public function sale_order(Request $request)
    {
        $perPage = 10;
        $page = $request->input('page', 1);
        $search = $request->input('q');

        $query = SaleOrder::select('id', 'order_no')->where('order_status', '=', 'published');
        if ($search) {
            $query->where('order_no', 'like', '%' . $search . '%');
        }
        $heads = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'results' => $heads->items(),
            'pagination' => [
                'more' => $heads->hasMorePages(),
            ],
        ]);
    }

    public function sale_order_detail(Request $request)
    {
        $sale_order = SaleOrder::select('id', 'order_no', 'description', 'kod_buku', 'status')->where('id', $request->id)->first();
        return response()->json($sale_order);
    }


    public function store(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Create')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }

        // dd($request);

        $validator = null;

        $validatedData = $request->validate([
            'sale_order' => 'required',
            'date' => 'required',
            'time' => 'required',
            'machine' => 'required',
            'section_plate' => 'required',
        ]);

        // If validations fail
        if (!$validatedData) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        $plate_cetak = new PlateCetak();
        $plate_cetak->sale_order_id = $request->sale_order;
        $plate_cetak->date = $request->date;
        $plate_cetak->time = $request->time;
        $plate_cetak->created_by = Auth::user()->id;
        $plate_cetak->machine = $request->machine;
        $plate_cetak->section = $request->section;
        $plate_cetak->section_plate = $request->section_plate;

        $plate_cetak->warna_1 = $request->warna_1;
        $plate_cetak->warna_2 = $request->warna_2;
        $plate_cetak->warna_3 = $request->warna_3;
        $plate_cetak->warna_4 = $request->warna_4;
        $plate_cetak->warna_5 = $request->warna_5;
        $plate_cetak->warna_6 = $request->warna_6;
        $plate_cetak->warna_7 = $request->warna_7;
        $plate_cetak->warna_8 = $request->warna_8;
        $plate_cetak->warna_9 = $request->warna_9;
        $plate_cetak->warna_10 = $request->warna_10;
        $plate_cetak->warna_11 = $request->warna_11;
        $plate_cetak->warna_12 = $request->warna_12;
        $plate_cetak->status = 'checked';
        $plate_cetak->save();
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Store');
        return redirect()->route('plate_cetak')->with('custom_success', 'PLATE CETAK has been Created Successfully !');
    }


    public function edit($id){
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Update')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $plate_cetak = PlateCetak::find($id);
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Update');
        return view('Mes.PlateCetak.edit', compact('plate_cetak'));
    }

    public function view($id){
        if (!Auth::user()->hasPermissionTo('PLATE CETAK View')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $plate_cetak = PlateCetak::find($id);
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK View');
        return view('Mes.PlateCetak.view', compact('plate_cetak'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Update')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }

        $validator = null;

        $validatedData = $request->validate([
            'sale_order' => 'required',
            'date' => 'required',
            'time' => 'required',
            'machine' => 'required',
            'section_plate' => 'required',
        ]);

        // If validations fail
        if (!$validatedData) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        $plate_cetak = PlateCetak::find($id);
        $plate_cetak->sale_order_id = $request->sale_order;
        $plate_cetak->date = $request->date;
        $plate_cetak->time = $request->time;
        $plate_cetak->created_by = Auth::user()->id;
        $plate_cetak->machine = $request->machine;
        $plate_cetak->section = $request->section;
        $plate_cetak->section_plate = $request->section_plate;

        $plate_cetak->warna_1 = $request->warna_1;
        $plate_cetak->warna_2 = $request->warna_2;
        $plate_cetak->warna_3 = $request->warna_3;
        $plate_cetak->warna_4 = $request->warna_4;
        $plate_cetak->warna_5 = $request->warna_5;
        $plate_cetak->warna_6 = $request->warna_6;
        $plate_cetak->warna_7 = $request->warna_7;
        $plate_cetak->warna_8 = $request->warna_8;
        $plate_cetak->warna_9 = $request->warna_9;
        $plate_cetak->warna_10 = $request->warna_10;
        $plate_cetak->warna_11 = $request->warna_11;
        $plate_cetak->warna_12 = $request->warna_12;

        $plate_cetak->status = 'checked';
        $plate_cetak->save();
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Update');
        return redirect()->route('plate_cetak')->with('custom_success', 'PLATE CETAK has been Updated Successfully !');
    }

    public function verify($id){
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Verify')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $plate_cetak = PlateCetak::find($id);
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Update');
        return view('Mes.PlateCetak.verify', compact('plate_cetak'));
    }

    public function approve_approve(Request $request, $id){
        if (!Auth::user()->hasPermissionTo('Senarai Semak Pencetakan Digital Verify')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }

        $plate_cetak = PlateCetak::find($id);
        $plate_cetak->status = 'verified';
        $plate_cetak->verified_by_date = Carbon::now()->format('Y-m-d H:i:s');
        $plate_cetak->verified_by_user = Auth::user()->user_name;
        $plate_cetak->verified_by_designation = (Auth::user()->designation != null) ? Auth::user()->designation->name : 'not assign';
        $plate_cetak->verified_by_department = (Auth::user()->department != null) ? Auth::user()->department->name : 'not assign';
        $plate_cetak->save();
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Verified');
        return redirect()->route('plate_cetak')->with('custom_success', 'PLATE CETAK has been Successfully Verified!');
    }

    public function approve_decline(Request $request, $id){
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Verify')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }

        $plate_cetak = PlateCetak::find($id);
        $plate_cetak->status = 'declined';
        $plate_cetak->save();
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Declined');
        return redirect()->route('plate_cetak')->with('custom_success', 'PLATE CETAK has been Successfully Declined!');
    }

    public function delete($id){
        if (!Auth::user()->hasPermissionTo('PLATE CETAK Delete')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $plate_cetak = PlateCetak::find($id);
        $plate_cetak->delete();
        Helper::logSystemActivity('PLATE CETAK', 'PLATE CETAK Delete');
        return redirect()->route('plate_cetak')->with('custom_success', 'PLATE CETAK has been Successfully Deleted!');
    }

}
