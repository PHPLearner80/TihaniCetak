@extends('layouts.app')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>LAPORAN PEMERIKSAAN KUALITI - PROSES PENJILIDAN PERFECT
                                        BIND</b></h5>
                            </div>
                        </div>
                        <div class="card" style="background:#f1f0f0;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="text"  name="date" value="{{ \Carbon\Carbon::parse($laporan_pemeriksaan_kualiti_penjilidan->date)->format('d-m-Y') }}" class="form-control" id="datepicker" disabled pattern="\d{2}-\d{2}-\d{4}" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="">Time</label>
                                        <input type="time" name="time"
                                            value="{{ $laporan_pemeriksaan_kualiti_penjilidan->time }}" id="Currenttime"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Checked By</div>
                                            <input type="text"
                                                value="{{ $laporan_pemeriksaan_kualiti_penjilidan->user->full_name }}"
                                                readonly name="" id="checked_by" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="label">Sales Order No.</div>
                                            <input type="text"
                                                value="{{ $laporan_pemeriksaan_kualiti_penjilidan->sale_order->order_no }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Tajuk</div>
                                            <input type="text"
                                                value="{{ $laporan_pemeriksaan_kualiti_penjilidan->sale_order->description }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Kod Buku</div>
                                            <input type="text"
                                                value="{{ $laporan_pemeriksaan_kualiti_penjilidan->sale_order->kod_buku }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="label">Mesin</div>
                                            <input type="text" class="form-control"
                                                value="{{ $laporan_pemeriksaan_kualiti_penjilidan->mesin }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="label">Jumleh Seksyen</div>
                                            <input type="text" readonly
                                                value="{{ $laporan_pemeriksaan_kualiti_penjilidan->senari_semak->item_cover_text ?? 0 }}"
                                                id="jumlah" name="seksyen_no" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">


                                    <div class="col-md-5 mt-3">
                                        <table class="table" border="1">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Kriteria</th>
                                                    <th colspan="2">Tanda bagi yang berkenaan</th>

                                                </tr>
                                                <tr>
                                                    <th>OK</th>
                                                    <th>NG</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>Koyakan fiber</td>
                                                    <td><input type="checkbox" class="Cover1"
                                                            onchange="handleCheckboxChange('Cover1',this)" name="b_1"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_1 == 'ok') id=""></td>
                                                    <td><input type="checkbox" class="Cover1"
                                                            onchange="handleCheckboxChange('Cover1',this)" name="b_1"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_1 == 'ng') id=""></td>
                                                </tr>
                                                <tr>
                                                    <td>Kedudukan Kulit buku dan teks</td>
                                                    <td><input type="checkbox" class="Text1"
                                                            onchange="handleCheckboxChange('Text1',this)" name="b_2"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_2 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Text1"
                                                            onchange="handleCheckboxChange('Text1',this)" name="b_2"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_2 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kulit buku yang betul</td>
                                                    <td><input type="checkbox" class="Cover2"
                                                            onchange="handleCheckboxChange('Cover2',this)" name="b_3"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_3 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Cover2"
                                                            onchange="handleCheckboxChange('Cover2',this)" name="b_3"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_3 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Teks yang betul</td>
                                                    <td><input type="checkbox" class="Text2"
                                                            onchange="handleCheckboxChange('Text2',this)" name="b_4"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_4 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Text2"
                                                            onchange="handleCheckboxChange('Text2',this)" name="b_4"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_4 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kedudukan gam</td>
                                                    <td><input type="checkbox" class="Cover3"
                                                            onchange="handleCheckboxChange('Cover3',this)" name="b_5"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_5 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Cover3"
                                                            onchange="handleCheckboxChange('Cover3',this)" name="b_5"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_5 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Turutan muka surat</td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_6"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_6 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_6"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_6 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Koyak</td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_7"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_7 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_7"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_7 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kotor</td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_8"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_8 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_8"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_8 == 'ng') id="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pematuhan SOP</td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_9"
                                                            value="ok" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_9 == 'ok') id="">
                                                    </td>
                                                    <td><input type="checkbox" class="Text3"
                                                            onchange="handleCheckboxChange('Text3',this)" name="b_9"
                                                            value="ng" @checked($laporan_pemeriksaan_kualiti_penjilidan->b_9 == 'ng') id="">
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h3><b>Verified By</b></h3>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Username</th>
                                                    <th>Desgination</th>
                                                    <th>Department</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $laporan_pemeriksaan_kualiti_penjilidan->verified_by_date }}</td>
                                                    <td>{{ $laporan_pemeriksaan_kualiti_penjilidan->verified_by_user }}</td>
                                                    <td>{{ $laporan_pemeriksaan_kualiti_penjilidan->verified_by_designation }}
                                                    </td>
                                                    <td>{{ $laporan_pemeriksaan_kualiti_penjilidan->verified_by_department }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <h4><b>Nota :</b></h4>
                                    <div class="row">
                                        <div class="col-md-1"><div style="background:wheat; width:50px; height:20px;"></div></div>
                                        <div class="col-md-11" style="margin-left:-20px;">
                                            <span>Pemeriksaan hanya dilakukan sekali semasa pengesahan 1st piece dan tidak perlu dilakukan semasa proses</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            <a href="{{ route('laporan_pemeriksaan_kualiti_penjilidan') }}">back to list</a>

            </div>
        </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('input').attr('disabled', 'disabled');
        });
    </script>
@endpush
