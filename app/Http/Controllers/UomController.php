<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\CustomParameter;
use App\Models\Parameter;
use App\Models\Uom;
use App\Models\Uom_conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UomController extends Controller
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

            $query = Uom::select('id', 'name')->where('created_by', '=', Auth::user()->id);

            // Apply search if a search term is provided
            if (!empty($search)) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q
                        ->where('name', 'like', '%' . $searchLower . '%');
                    // Add more columns as needed
                });
            }
            // Determine the column to sort by
            $results = null;

            if (!empty($columnsData)) {
                $sortableColumns = [
                    1 => 'name',
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
                                $q->where('name', 'like', '%' . $searchLower . '%');
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
                $row->action = '<div class="dropdown">
                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                    data-toggle="dropdown" id="dropdownMenuButton" type="button">Action <i class="fas fa-caret-down ml-1"></i></button>
                    <div  class="dropdown-menu tx-13">
                    <a class="dropdown-item" href="' . route('uom.edit', $row->id) . '">Edit</a>
                    <a class="dropdown-item" href="' . route('uom.view', $row->id) . '">View</a>
                    <a class="dropdown-item" href="' . route('uom.delete', $row->id) . '">Delete</a>
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

            $query = Uom::select('id', 'name')->where('created_by', '=', Auth::user()->id);

            // Apply search if a search term is provided
            if (!empty($search)) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q
                        ->where('name', 'like', '%' . $searchLower . '%');

                    // Add more columns as needed
                });
            }

            $sortableColumns = [
                1 => 'name',

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
                $row->action = '<div class="dropdown">
                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                    data-toggle="dropdown" id="dropdownMenuButton" type="button">Action <i class="fas fa-caret-down ml-1"></i></button>
                    <div  class="dropdown-menu tx-13">
                        <a class="dropdown-item" href="' . route('uom.edit', $row->id) . '">Edit</a>
                        <a class="dropdown-item" href="' . route('uom.view', $row->id) . '">View</a>
                        <a class="dropdown-item" href="' . route('uom.delete', $row->id) . '">Delete</a>
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

    public function index()
    {
        if (
            Auth::user()->hasPermissionTo('UOM List') ||
            Auth::user()->hasPermissionTo('UOM Create') ||
            Auth::user()->hasPermissionTo('UOM Update') ||
            Auth::user()->hasPermissionTo('UOM Delete')
        ) {
            Helper::logSystemActivity('UOM', 'UOM List');
            return view('Setting.Uom.Index');
        }
        return back()->with('custom_errors', 'You don`t have Right Permission');
    }
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('UOM Create')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        Helper::logSystemActivity('UOM', 'UOM Create');
        return view('Setting.Uom.Create');
    }
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('UOM Create')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $validator = null;

        $validatedData = $request->validate([
            'name' => [
                'required',
                Rule::unique('uoms', 'name')->whereNull('deleted_at'),
            ]
        ]);

        // If validations fail
        if (!$validatedData) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        $Uom = new Uom();
        $Uom->name = $request->name;
        $Uom->created_by = Auth::user()->id;
        $Uom->save();
        Helper::logSystemActivity('UOM', 'UOM Store');
        return redirect()->route('uom')->with('custom_success', 'UOM has been Created Successfully !');
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('UOM Update')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $uom = Uom::find($id);
        Helper::logSystemActivity('UOM', 'UOM Edit');
        return view('Setting.Uom.Edit', compact('uom'));
    }

    public function view($id)
    {
        if (!Auth::user()->hasPermissionTo('UOM View')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $uom = Uom::find($id);
        Helper::logSystemActivity('UOM', 'UOM Edit');
        return view('Setting.Uom.View', compact('uom'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('UOM Update')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $validator = null;

        $validatedData = $request->validate([
            'name' => [
                'required',
                Rule::unique('uoms', 'name')->whereNull('deleted_at')->ignore($id),
            ]
        ]);

        // If validations fail
        if (!$validatedData) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        $Uom =  Uom::find($id);
        $Uom->name = $request->name;
        $Uom->save();
        Helper::logSystemActivity('UOM', 'UOM Update');
        return redirect()->route('uom')->with('custom_success', 'UOM has been Updated Successfully !');
    }


    public function delete($id)
    {
        if (!Auth::user()->hasPermissionTo('UOM Delete')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $uom = Uom::find($id);
        $uom->delete();
        Helper::logSystemActivity('UOM', 'UOM Delete');
        return redirect()->route('uom')->with('custom_success', 'UOM has been Deleted Successfully !');
    }

    public function Data_Conversion(Request $request)
    {
        if ($request->ajax() && $request->input('columnsData') != null) {
            $columnsData = $request->input('columnsData');
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $search = $request->input('search.value');

            $query = Uom_conversion::select('id', 'from_unit_id', 'to_unit_id', 'from_value', 'to_value', 'isReverse')->with(['fromUnit', 'toUnit']);

            // Apply search if a search term is provided
            if (!empty($search)) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q
                        ->where('from_value', 'like', '%' . $searchLower . '%')
                        ->orWhere('to_value', 'like', '%' . $searchLower . '%')
                        ->orWhereHas('fromUnit', function ($query) use ($searchLower) {
                            $query->where('name', 'like', '%' . $searchLower . '%');
                        })
                        ->orWhereHas('toUnit', function ($query) use ($searchLower) {
                            $query->where('name', 'like', '%' . $searchLower . '%');
                        });
                    // Add more columns as needed
                });
            }
            // Determine the column to sort by
            $results = null;

            if (!empty($columnsData)) {
                $results = $query->where(function ($q) use ($columnsData) {
                    foreach ($columnsData as $column) {
                        $searchLower = strtolower($column['value']);

                        switch ($column['index']) {
                            case 1:
                                $q->whereHas('fromUnit', function ($query) use ($searchLower) {
                                    $query->where('name', 'like', '%' . $searchLower . '%');
                                });
                                break;
                            case 2:
                                $q->whereHas('toUnit', function ($query) use ($searchLower) {
                                    $query->where('name', 'like', '%' . $searchLower . '%');
                                });
                                break;
                            case 3:
                                $q->where('from_value', 'like', '%' . $searchLower . '%');
                                break;
                            case 4:
                                $q->where('to_value', 'like', '%' . $searchLower . '%');
                                break;
                            default:
                                break;
                        }
                    }
                })->get();
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
                $row->from =  $row->fromUnit->name;
                $row->to =  $row->toUnit->name;
                $row->sr_no = $start + $index + 1;
                if ($row->isReverse == 0) {
                    $row->action = '<div class="dropdown">
                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                    </a>

                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="' . route('uom_conversion.edit', $row->id) . '">Edit</a></li>
                    <li><a class="dropdown-item" data-delete="' . route('uom_conversion.destroy', $row->id) . '" data-kt-ecommerce-category-filter="delete_row" href="' . route('uom_conversion.destroy', $row->id) . '">Delete</a></li>';
                    $row->action .= '</ul></div>';
                } else {
                    $row->action = '';
                }
            $index++;
            }

            // Continue with your response
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

            $query = Uom_conversion::select('id', 'from_unit_id', 'to_unit_id', 'from_value', 'to_value', 'isReverse')->with(['fromUnit', 'toUnit']);

            // Apply search if a search term is provided
            if (!empty($search)) {
                $searchLower = strtolower($search);
                $query->where(function ($q) use ($searchLower) {
                    $q
                        ->where('from_value', 'like', '%' . $searchLower . '%')
                        ->orWhere('to_value', 'like', '%' . $searchLower . '%')
                        ->orWhereHas('fromUnit', function ($query) use ($searchLower) {
                            $query->where('name', 'like', '%' . $searchLower . '%');
                        })
                        ->orWhereHas('toUnit', function ($query) use ($searchLower) {
                            $query->where('name', 'like', '%' . $searchLower . '%');
                        });

                    // Add more columns as needed
                });
            }

            $recordsTotal = $query->count();

            $uom = $query
                ->skip($start)
                ->take($length)
                ->get();

            $uom->each(function ($row, $index) use(&$start) {
                $row->from =  $row->fromUnit->name;
                $row->to =  $row->toUnit->name;
                $row->sr_no = $start + $index + 1;
                if ($row->isReverse == 0) {
                    $row->action = '<div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                        </a>

                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="' . route('uom_conversion.edit', $row->id) . '">Edit</a></li>
                        <li><a class="dropdown-item" data-delete="' . route('uom_conversion.destroy', $row->id) . '" data-kt-ecommerce-category-filter="delete_row" href="' . route('uom_conversion.destroy', $row->id) . '">Delete</a></li>';
                    $row->action .= '</ul></div>';
                } else {
                    $row->action = '';
                }
            });

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal, // Total records after filtering
                'data' => $uom,
            ]);
        }
    }

    public function index_conversion()
    {
        if (
            Auth::user()->hasPermissionTo('UOM Conversion List') ||
            Auth::user()->hasPermissionTo('UOM Conversion Create') ||
            Auth::user()->hasPermissionTo('UOM Conversion Update') ||
            Auth::user()->hasPermissionTo('UOM Conversion Delete')
        ) {
            Helper::logSystemActivity('UOM Conversion', 'UOM Conversion List');
            return view('Setting.Uom_conversion.index');
        }
        return back()->with('custom_errors', 'You don`t have Right Permission');
    }
    public function create_conversion()
    {
        if (!Auth::user()->hasPermissionTo('UOM Conversion Create')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $uoms = Uom::select('id', 'name')->get();
        Helper::logSystemActivity('UOM Conversion', 'UOM Conversion Create');
        return view('Setting.Uom_conversion.create', compact('uoms'));
    }
    public function store_conversion(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('UOM Conversion Create')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $validator = null;

        $validatedData = $request->validate([
            'from_unit_id' => 'required',
            'to_unit_id' => 'required',
            'from_value' => 'required',
            'to_value' => 'required',

        ]);

        // If validations fail
        if (!$validatedData) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        $Uom = new Uom_conversion();
        $Uom->from_unit_id = $request->from_unit_id;
        $Uom->to_unit_id = $request->to_unit_id;
        $Uom->to_value = $request->to_value;
        $Uom->from_value = $request->from_value;
        $Uom->isReverse = 0;
        $Uom->created_by = Auth::user()->id;
        $Uom->save();

        $UomRev = new Uom_conversion();
        $UomRev->from_unit_id = $request->to_unit_id;
        $UomRev->to_unit_id = $request->from_unit_id;
        $UomRev->to_value = $request->from_value;
        $UomRev->from_value = $request->to_value;
        $UomRev->isReverse = $Uom->id;
        $UomRev->created_by = Auth::user()->id;
        $UomRev->save();
        Helper::logSystemActivity('UOM Conversion', 'UOM Conversion Store');
        return redirect()->route('uom_conversion.index')->with('custom_success', 'UOM Conversions has been Create Successfully !');
    }

    public function edit_conversion($id)
    {
        if (!Auth::user()->hasPermissionTo('UOM Conversion Update')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $uom_conversion = Uom_conversion::find($id);
        $uoms = Uom::select('id', 'name')->get();
        Helper::logSystemActivity('UOM Conversion', 'UOM Conversion Edit');
        return view('Setting.Uom_conversion.edit', compact('uom_conversion', 'uoms'));
    }

    public function update_conversion(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('UOM Conversion Update')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $validator = null;

        $validatedData = $request->validate([
            'from_unit_id' => 'required',
            'to_unit_id' => 'required',
            'from_value' => 'required',
            'to_value' => 'required',

        ]);

        // If validations fail
        if (!$validatedData) {
            return redirect()->back()
                ->withErrors($validator)->withInput();
        }

        $Uom =  Uom_conversion::find($id);
        $Uom->from_unit_id = $request->from_unit_id;
        $Uom->to_unit_id = $request->to_unit_id;
        $Uom->to_value = $request->to_value;
        $Uom->from_value = $request->from_value;
        $Uom->isReverse = 0;
        $Uom->save();

        $UomRev = Uom_conversion::where('isReverse', '=', $id)->first();
        $UomRev->from_unit_id = $request->to_unit_id;
        $UomRev->to_unit_id = $request->from_unit_id;
        $UomRev->to_value = $request->from_value;
        $UomRev->from_value = $request->to_value;
        $UomRev->save();
        Helper::logSystemActivity('UOM Conversion', 'UOM Conversion Update');
        return redirect()->route('uom_conversion.index')->with('custom_success', 'UOM Conversions has been Updated Successfully !');
    }

    //
    public function destroy_conversion($id)
    {
        if (!Auth::user()->hasPermissionTo('UOM Conversion Delete')) {
            return back()->with('custom_errors', 'You don`t have Right Permission');
        }
        $uom_conversion = Uom_conversion::find($id);
        $uom_conversion->delete();
        $uomRev = Uom_conversion::where('isReverse', '=', $id)->first();
        $uomRev->delete();
        Helper::logSystemActivity('UOM Conversion', 'UOM Conversion Delete');
        return redirect()->route('uom_conversion.index')->with('custom_success', 'UOM Conversions has been Deleted Successfully !');
    }
}
