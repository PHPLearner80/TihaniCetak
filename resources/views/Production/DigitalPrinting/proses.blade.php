@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="float-left"><b>PRODUCTION JOBSHEET LIST- DIGITAL PRINTING</b></h5>
                            <p class="float-right">TCBS-B66 (Rev.1)</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center" style="font-size:80px; color:red; dispaly:inline-block;">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1">
                                        <i class="fe fe-alert-triangle"></i>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 style="font-size:35px;">AMARAN : <br>
                                            <span style="color:black;">
                                                TIADA SAMPLE JANGAN CETAK <br>
                                                FIRST PIECE JANGAN LUPA
                                            </span>
                                        </h5>
                                    </div>

                                    <div class="col-md-1">
                                        <i class="fe fe-alert-triangle"></i>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card" style="background:#f1f0f0;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Production Button</b></h5>
                                </div>
                                <div class="col-md-4 ">
                                    <button id="play" onclick="machineStarter(1, {{ $digital_printing->id }})"
                                        type="button" class="btn btn-light w-100" style="border:1px solid black;"><i
                                            class="la la-play" style="font-size:20px;"></i>Start</button>
                                </div>
                                <div class="col-md-4">
                                    <button id="pause" onclick="machineStarter(2, {{ $digital_printing->id }})"
                                        type="button" class="btn btn-light w-100" style="border:1px solid black;"><i
                                            class="la la-pause" style="font-size:20px;"></i>Pause</button>
                                </div>
                                <div class="col-md-4  ">
                                    <div class="box">
                                        <button id="stop" onclick="machineStarter(3, {{ $digital_printing->id }})"
                                            type="button" class="btn btn-light w-100" style="border:1px solid black;"><i
                                                class="la la-stop-circle" style="font-size:20px;"></i>Stop</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div id="msg" class="col-12 text-center"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background:#f1f0f0;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="text" name="date" value="{{ $digital_printing->date }}"
                                            class="form-control" id="datepicker" pattern="\d{2}-\d{2}-\d{4}"
                                            placeholder="dd-mm-yyyy">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">By</label>
                                    <input type="text" readonly name=""
                                        value="{{ $digital_printing->user->full_name }}" id=""
                                        class="form-control">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="">Operator</label>
                                        <select name="user[]" class="form-control form-select" id="operator" multiple>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if (old('user')) {{ in_array($user->id, old('user')) ? 'selected' : '' }} @endif>
                                                    {{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <div class="label">Sales Order No.</div>
                                        <input type="text" readonly name=""
                                            value="{{ $digital_printing->sale_order->order_no }}" id=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <div class="label">Tajuk</div>
                                        <input type="text" readonly name="" id="tajuk" class="form-control"
                                            value="{{ $digital_printing->sale_order->description }}">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <div class="label">Kod Buku</div>
                                        <input type="text" readonly id="kod_buku" class="form-control"
                                            value="{{ $digital_printing->sale_order->kod_buku }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Pelanggan</div>
                                        <input type="text" readonly name="" id="customer"
                                            class="form-control" value="{{ $digital_printing->sale_order->customer }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Saiz Produk </div>
                                        <input type="text" readonly name="" id="size"
                                            class="form-control" value="{{ $digital_printing->sale_order->size }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Kuantiti SO</div>
                                        <input type="text" readonly name="" id="sale_order_qty"
                                            class="form-control"
                                            value="{{ $digital_printing->sale_order->sale_order_qty }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Jumlah mukasurat</div>
                                        <input type="text" value="{{ $digital_printing->jumlah_mukasurat }}"
                                            name="jumlah_mukasurat" id="jumlah" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Kuantiti Waste</div>
                                        <input type="number" value="{{ $digital_printing->kuantiti_waste }}"
                                            name="kuantiti_waste" id="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Remark</div>
                                        <textarea disabled name="remarks" id="" cols="30" rows="1" class="form-control">{{ $digital_printing->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Mesin</label>
                                        <input type="text" class="form-control"
                                            value="{{ $digital_printing->mesin }}">
                                    </div>
                                </div>
                                @if ($digital_printing->mesin == 'OTHERS')
                                    <input type="hidden" id="machine" value="{{ $digital_printing->mesin_others }}">
                                @else
                                    <input type="hidden" id="machine" value="{{ $digital_printing->mesin }}">
                                @endif
                                <div class="col-md-4">
                                    <div id="box1">
                                        @if ($digital_printing->mesin == 'OTHERS')
                                            <div id="box1"><label for="newInput">Lain-lain mesin (Sila
                                                    nyatakan)</label><input type="text" name="mesin_others"
                                                    class="form-control" id="newInput"
                                                    value="{{ $digital_printing->mesin_others }}"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <div class="label">Kategori job</div>
                                        <input type="text" class="form-control"
                                            value="{{ $digital_printing->kategori_job }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Jenis produk</label>
                                        <input type="text" class="form-control"
                                            value="{{ $digital_printing->jenis_produk }}">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <!-- <label for="">Other (Please state)</label> -->
                                    <div id="box2">
                                        @if ($digital_printing->jenis_produk == 'OTHERS')
                                            <label for="newInput">Other (please state)</label><input type="text"
                                                name="jenis_produk_others" class="form-control" id="newInput"
                                                value="{{ $digital_printing->jenis_produk_others }}">
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Kertas: teks</div>
                                        <input type="text" name="kertas_teks" id="" class="form-control"
                                            value="{{ $digital_printing->kertas_teks }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Kertas: Cover</div>
                                        <input type="text" name="kertas_cover" id="" class="form-control"
                                            value="{{ $digital_printing->kertas_cover }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card" style="background:#f1f0f0; border-radius:5px;">
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5><b>Text</b></h5>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1"><input type="checkbox" name="text_front"
                                                    id="" @checked($digital_printing->text_front != null)></div>
                                            <div class="col-md-2">Front</div>
                                            <div class="col-md-1"><input type="checkbox" name="text_back" id=""
                                                    @checked($digital_printing->text_back != null)></div>
                                            <div class="col-md-2">back</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Print</label>
                                    <select name="text_print" id="print0" placeholder="Pilih print"
                                        class="form-control form-select">
                                        <option value="1C" @selected($digital_printing->text_print == '1C')>1C</option>
                                        <option value="4C" @selected($digital_printing->text_print == '4C')>4C</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Jumlah Up</label>
                                        <input type="text" name="text_jumlah_up" id="" class="form-control"
                                            value="{{ $digital_printing->text_jumlah_up }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="">Print Cut</label>
                                    <select name="text_print_cut" id="printSelect" class="form-control form-select">
                                        <option value="1" @selected($digital_printing->text_print_cut == '1')>1</option>
                                        <option value="2" @selected($digital_printing->text_print_cut == '2')>2</option>
                                        <option value="3" @selected($digital_printing->text_print_cut == '3')>3</option>
                                        <option value="4" @selected($digital_printing->text_print_cut == '4')>4</option>
                                        <option value="6" @selected($digital_printing->text_print_cut == '6')>6</option>
                                        <option value="8" @selected($digital_printing->text_print_cut == '8')>8</option>
                                        <option value="10" @selected($digital_printing->text_print_cut == '10')>10</option>
                                        <option value="12" @selected($digital_printing->text_print_cut == '12')>12</option>
                                        <option value="14" @selected($digital_printing->text_print_cut == '14')>14</option>
                                        <option value="16" @selected($digital_printing->text_print_cut == '16')>16</option>
                                        <option value="OTHERS" id="newInputOption" @selected($digital_printing->text_print_cut == 'OTHERS')>Other
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for=""></label>
                                    <div id="box">
                                        @if ($digital_printing->text_print_cut == 'OTHERS')
                                            <input type="text" name="text_print_cut_others" class="form-control"
                                                id="newInput" value="{{ $digital_printing->text_print_cut_others }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background:#f1f0f0; border-radius:5px;">
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5><b>Cover</b></h5>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1"><input type="checkbox" name="cover_front"
                                                    id="" @checked($digital_printing->cover_front != null)></div>
                                            <div class="col-md-2">Front</div>
                                            <div class="col-md-1"><input type="checkbox" name="cover_back"
                                                    id="" @checked($digital_printing->cover_back != null)></div>
                                            <div class="col-md-2">back</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Print</label>
                                    <select name="cover_print" id="print1" placeholder="Pilih print"
                                        class="form-control form-select">
                                        <option value="1C" @selected($digital_printing->cover_print == '1C')>1C</option>
                                        <option value="4C" @selected($digital_printing->cover_print == '$C')>4C</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <label for="">Print Cut</label>
                                    <select name="cover_print_cut" id="printSelect1" class="form-control form-select">
                                        <option value="1" @selected($digital_printing->cover_print_cut == '1')>1</option>
                                        <option value="2" @selected($digital_printing->cover_print_cut == '2')>2</option>
                                        <option value="3" @selected($digital_printing->cover_print_cut == '3')>3</option>
                                        <option value="4" @selected($digital_printing->cover_print_cut == '4')>4</option>
                                        <option value="6" @selected($digital_printing->cover_print_cut == '6')>6</option>
                                        <option value="8" @selected($digital_printing->cover_print_cut == '8')>8</option>
                                        <option value="10" @selected($digital_printing->cover_print_cut == '10')>10</option>
                                        <option value="12" @selected($digital_printing->cover_print_cut == '12')>12</option>
                                        <option value="14" @selected($digital_printing->cover_print_cut == '14')>14</option>
                                        <option value="16" @selected($digital_printing->cover_print_cut == '16')>16</option>
                                        <option value="OTHERS" id="newInputOption1" @selected($digital_printing->cover_print_cut == 'OTHERS')>
                                            Other</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for=""></label>
                                    <div id="box4">
                                        @if ($digital_printing->cover_print_cut == 'OTHERS')
                                            <input type="text" name="cover_print_cut_others" class="form-control"
                                                id="newInput" value="{{ $digital_printing->cover_print_cut_others }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background:#f1f0f0; border-radius:5px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Finishing</b></h5>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Finishing</th>
                                                <th>Partner</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_1 != null)
                                                        name="finishing_1" id="Form20" class=" mr-5">Gloss
                                                    Lamination</td>
                                                <td>
                                                    <select name="finishing_1_val" @disabled($digital_printing->finishing_1 == null)
                                                        placeholder="select Supplier" id="form20"
                                                        class="form-control form-select " style="width:250px;">
                                                        <option value="In-house" @selected($digital_printing->finishing_1 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_1 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_2 != null)
                                                        name="finishing_2" id="Form1" class=" mr-5">Matt
                                                    Lamination</td>
                                                <td><select name="finishing_2_val" @disabled($digital_printing->finishing_2 == null)
                                                        placeholder="select Supplier" id="form1"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_2 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_2 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>

                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_3 != null)
                                                        name="finishing_3" id="Form2" class=" mr-5">SPOT UV</td>
                                                <td><select name="finishing_3_val" @disabled($digital_printing->finishing_3 == null)
                                                        placeholder="select Supplier" id="form2"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_3 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_3 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>

                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_4 != null)
                                                        name="finishing_4" id="Form3" class=" mr-5">Hot Stamping
                                                </td>
                                                <td><select name="finishing_4_val" @disabled($digital_printing->finishing_4 == null)
                                                        placeholder="select Supplier" id="form3"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_4 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_4 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_5 != null)
                                                        name="finishing_5" id="Form4" class=" mr-5">Emboss</td>
                                                <td><select name="finishing_5_val" @disabled($digital_printing->finishing_5 == null)
                                                        placeholder="select Supplier" id="form4"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_5 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_5 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_6 != null)
                                                        name="finishing_6" id="Form5" class=" mr-5">Diecut</td>
                                                <td><select name="finishing_6_val" @disabled($digital_printing->finishing_6 == null)
                                                        placeholder="select Supplier" id="form5"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_6 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_6 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_7 != null)
                                                        name="finishing_7" id="Form6" class=" mr-5">Round corner
                                                </td>
                                                <td><select name="finishing_7_val" @disabled($digital_printing->finishing_7 == null)
                                                        placeholder="select Supplier" id="form6"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_7 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_7 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_8 != null)
                                                        name="finishing_8" id="Form7" class=" mr-5">Round back
                                                </td>
                                                <td><select name="finishing_8_val" @disabled($digital_printing->finishing_8 == null)
                                                        placeholder="select Supplier" id="form7"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_8 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_8 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_9 != null)
                                                        name="finishing_9" id="Form8" class=" mr-5">Square Back
                                                </td>
                                                <td><select name="finishing_9_val" @disabled($digital_printing->finishing_9 == null)
                                                        placeholder="select Supplier" id="form8"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_9 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_9 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->finishing_10 != null)
                                                        name="finishing_10" id="Form9" class=" mr-5"> Others:
                                                    <input type="text" @disabled($digital_printing->finishing_10 == null)
                                                        placeholder="User Input" name="finishing_10_val" id="input1"
                                                        class="form-control w-50 float-right"
                                                        value="{{ $digital_printing->finishing_10 }}">
                                                </td>
                                                <td><select name="finishing_11_val" @disabled($digital_printing->finishing_11 == null)
                                                        placeholder="select Supplier" id="form9"
                                                        class="form-control form-select w-100">
                                                        <option value="In-house" @selected($digital_printing->finishing_11 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->finishing_11 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background:#f1f0f0; border-radius:5px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Binding</b></h5>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Binding</th>
                                                <th>Partner</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_1 != null) name="binding_1"
                                                        id="Form10" class=" mr-5">Perfect
                                                    Bind
                                                </td>
                                                <td><select @disabled($digital_printing->binding_1 == null) name="binding_1_val"
                                                        placeholder="select Supplier" id="form10"
                                                        class="form-control form-select" style="width:250px;">
                                                        <option value="In-house" @selected($digital_printing->binding_1 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_1 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>

                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_2 != null) name="binding_2"
                                                        id="Form11" class=" mr-5">Staple Bind
                                                </td>
                                                <td><select name="binding_2_val" @disabled($digital_printing->binding_2 == null)
                                                        placeholder="select Supplier" id="form11"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_2 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_2 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_3 != null) name="binding_3"
                                                        id="Form12" class=" mr-5">Wire 0</td>
                                                <td><select name="binding_3_val" @disabled($digital_printing->binding_3 == null)
                                                        placeholder="select Supplier" id="form12"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_3 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_3 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_4 != null) name="binding_4"
                                                        id="Form13" class=" mr-5">Hard Cover
                                                </td>
                                                <td><select name="binding_4_val" @disabled($digital_printing->binding_4 == null)
                                                        placeholder="select Supplier" id="form13"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_4 == 'In-house')>In-house
                                                        </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_4 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_5 != null) name="binding_5"
                                                        id="Form14" class=" mr-5">Creasing
                                                    Line
                                                </td>
                                                <td><select name="binding_5_val" @disabled($digital_printing->binding_5 == null)
                                                        placeholder="select Supplier" id="form14"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_5 == 'In-house')>
                                                            In-house</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_5 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_6 != null) name="binding_6"
                                                        id="Form15" class=" mr-5">Cut to Size
                                                </td>
                                                <td><select name="binding_6_val" @disabled($digital_printing->binding_6 == null)
                                                        placeholder="select Supplier" id="form15"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_6 == 'In-house')>
                                                            In-house</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_6 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_7 != null) name="binding_7"
                                                        id="Form16" class=" mr-5">Folding
                                                </td>
                                                <td><select name="binding_7_val" @disabled($digital_printing->binding_7 == null)
                                                        placeholder="select Supplier" id="form16"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_7 == 'In-house')>
                                                            In-house</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_7 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" @checked($digital_printing->binding_8 != null) name="binding_8"
                                                        id="Form17" class=" mr-5"> Others:
                                                    <input type="text" @disabled($digital_printing->binding_8 == null)
                                                        placeholder="User Input" name="binding_8_val" id="input"
                                                        class="form-control w-50 float-right"
                                                        value="{{ $digital_printing->binding_9 }}">
                                                </td>
                                                <td><select name="binding_9_val" @disabled($digital_printing->binding_9 == null)
                                                        placeholder="select Supplier" id="form17"
                                                        class="form-control form-select">
                                                        <option value="In-house" @selected($digital_printing->binding_9 == 'In-house')>
                                                            In-house</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"
                                                                @selected($digital_printing->binding_9 == $supplier->id)>{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center" style="font-size:80px; color:red; dispaly:inline-block;">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1">
                                        <i class="fe fe-alert-triangle"></i>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 style="font-size:35px;">AMARAN : <br>
                                            <span style="color:black;">
                                                TIADA SAMPLE JANGAN CETAK <br>
                                                FIRST PIECE JANGAN LUPA
                                            </span>
                                        </h5>
                                    </div>

                                    <div class="col-md-1">
                                        <i class="fe fe-alert-triangle"></i>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary float-right">Save</button>
                        </div>
                    </div>
                </div>


            </div>
            <a href="{{ route('digital_printing') }}">back to list</a>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('input,select').attr('disabled', 'disabled');
            $('#operator').removeAttr('disabled');
            check_machines(@json($check_machines));
        });

        function check_machines(check_machines) {
            if (check_machines != null) {
                if (check_machines.status == 1) {
                    $('#play').attr('disabled', 'disabled');
                    $('#pause').removeAttr('disabled');
                    $('#stop').removeAttr('disabled');
                    $('#play').addClass('btn-success');
                    $('#play').removeClass('btn-light');
                    $('#pause').addClass('btn-light');
                    $('#stop').addClass('btn-light');
                    $('#pause').removeClass('btn-warning');
                    $('#stop').removeClass('btn-danger');
                } else if (check_machines.status == 2) {
                    $('#pause').attr('disabled', 'disabled');
                    $('#play').removeAttr('disabled');
                    $('#stop').attr('disabled', 'disabled');
                    $('#pause').addClass('btn-warning');
                    $('#pause').removeClass('btn-light');
                    $('#play').addClass('btn-light');
                    $('#stop').addClass('btn-light');
                    $('#play').removeClass('btn-success');
                    $('#stop').removeClass('btn-danger');
                } else if (check_machines.status == 3) {
                    $('#stop').attr('disabled', 'disabled');
                    $('#pause').attr('disabled', 'disabled');
                    $('#play').attr('disabled', 'disabled');
                    $('#stop').addClass('btn-danger');
                    $('#stop').removeClass('btn-light');
                    $('#play').addClass('btn-light');
                    $('#pause').addClass('btn-light');
                    $('#play').removeClass('btn-success');
                    $('#pause').removeClass('btn-warning');
                }
            } else {
                $('#play').removeAttr('disabled');
                $('#pause').attr('disabled', 'disabled');
                $('#stop').attr('disabled', 'disabled');
            }
        }

        function machineStarter(status, digital_id) {
            var machine = $("#machine").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('machine.starter') }}',
                data: {
                    "digital_id": digital_id,
                    "machine": machine,
                    "status": status,
                },
                success: function(data) {
                    $("#msg").html(data.message);
                    check_machines(data.check_machine);
                }
            });
        }
    </script>
@endpush
