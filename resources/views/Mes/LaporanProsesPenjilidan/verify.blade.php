@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>LAPORAN PROSES PENJILIDAN (PERFECT BIND)</h5>

                        <div class="card" style="background:#f1f0f0;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><b>A) Informasi</b></h5>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="">Tarikh</label>
                                            <input type="text"  name="date" value="{{ \Carbon\Carbon::parse($laporan_proses_penjilidan->date)->format('d-m-Y') }}" class="form-control" disabled id="datepicker" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="">Time</label>
                                        <input type="time" name="time" value="{{ $laporan_proses_penjilidan->time }}"
                                            id="Currenttime" class="form-control">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Diperiksa oleh (Operator)</div>
                                            <input type="text" value="{{ Auth::user()->full_name }}" readonly
                                                name="" id="checked_by" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="label">Sales Order No.</div>
                                            <input type="text"
                                                value="{{ $laporan_proses_penjilidan->sale_order->order_no }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Tajuk</div>
                                            <input type="text"
                                                value="{{ $laporan_proses_penjilidan->sale_order->description }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Kod Buku</div>
                                            <input type="text"
                                                value="{{ $laporan_proses_penjilidan->sale_order->kod_buku }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Jumlah Seksyen</div>
                                            <input type="text" readonly
                                                value="{{ $laporan_proses_penjilidan->senari_semak->item_cover_text ?? 0 }}"
                                                id="jumlah" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <div class="label">Kuantiti SO</div>
                                            <input type="number"
                                                value="{{ $laporan_proses_penjilidan->sale_order->sale_order_qty }}"
                                                readonly id="sale_order_qty" class="form-control">
                                        </div>
                                    </div>
                                </div> -->


                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="">Jenis Penjilidan</label>
                                        <select readonly name="" id="" class="form-control">
                                            <option value="" disabled>select sales Order no</option>
                                            <option value="" selected>Perfect Bind</option>
                                            <option value="">Lock Bind</option>
                                            <option value="">Gather</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="">Operator</label>
                                        <select readonly name="" id="" class="form-control">
                                            <option value="" disabled>select sales Order no</option>
                                            <option value="" selected>User A</option>
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="">Pembantu</label>
                                            @php
                                                $item1 = json_decode($laporan_proses_penjilidan->pembantu);
                                            @endphp
                                            <select disabled name="pembantu[]" class="form-control form-select"
                                                id="" multiple>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($item1) {{ in_array($user->id, $item1) ? 'selected' : '' }} @endif>
                                                        {{ $user->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-5" style="background:#f1f0f0;">
                            <div class="col-md-12 mt-5">
                                <h5><b>B) Pemeriksaan dan Pengesahan 1st Piece</b> </h5>
                            </div>
                            <div class="col-md-8 mt-5">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Kriteria</th>
                                            <th colspan="4">Status</th>

                                        </tr>
                                        <tr>
                                            <th>OK</th>
                                            <th>NG</th>
                                            <th>NA</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>Koyakan fiber</td>
                                            <td><input type="checkbox" class="Cover1"
                                                    onchange="handleCheckboxChange('Cover',this)" name="b_1"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_1 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Cover1"
                                                    onchange="handleCheckboxChange('Cover1',this)" name="b_1"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_1 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Cover1"
                                                    onchange="handleCheckboxChange('Cover1',this)" name="b_1"
                                                    value="na" @checked($laporan_proses_penjilidan->b_1 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Kedudukan Kulit buku dan teks</td>
                                            <td><input type="checkbox" class="Text1"
                                                    onchange="handleCheckboxChange('Text1',this)" name="b_2"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_2 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Text1"
                                                    onchange="handleCheckboxChange('Text1',this)" name="b_2"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_2 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Text1"
                                                    onchange="handleCheckboxChange('Text1',this)" name="b_2"
                                                    value="na" @checked($laporan_proses_penjilidan->b_2 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Artwork Kulit buku dan Teks</td>
                                            <td><input type="checkbox" class="Cover2"
                                                    onchange="handleCheckboxChange('Cover2',this)" name="b_3"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_3 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Cover2"
                                                    onchange="handleCheckboxChange('Cover2',this)" name="b_3"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_3 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Cover2"
                                                    onchange="handleCheckboxChange('Cover2',this)" name="b_3"
                                                    value="na" @checked($laporan_proses_penjilidan->b_3 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Turutan Seksyen/muka surat</td>
                                            <td><input type="checkbox" class="Text2"
                                                    onchange="handleCheckboxChange('Text2',this)" name="b_4"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_4 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Text2"
                                                    onchange="handleCheckboxChange('Text2',this)" name="b_4"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_4 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Text2"
                                                    onchange="handleCheckboxChange('Text2',this)" name="b_4"
                                                    value="na" @checked($laporan_proses_penjilidan->b_4 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Kedudukan gam (side gam)</td>
                                            <td><input type="checkbox" class="Cover3"
                                                    onchange="handleCheckboxChange('Cover3',this)" name="b_5"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_5 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Cover3"
                                                    onchange="handleCheckboxChange('Cover3',this)" name="b_5"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_5 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Cover3"
                                                    onchange="handleCheckboxChange('Cover3',this)" name="b_5"
                                                    value="na" @checked($laporan_proses_penjilidan->b_5 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Rosak/koyak</td>
                                            <td><input type="checkbox" class="Text3"
                                                    onchange="handleCheckboxChange('Text3',this)" name="b_6"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_6 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Text3"
                                                    onchange="handleCheckboxChange('Text3',this)" name="b_6"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_6 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Text3"
                                                    onchange="handleCheckboxChange('Text3',this)" name="b_6"
                                                    value="na" @checked($laporan_proses_penjilidan->b_6 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Kotor</td>
                                            <td><input type="checkbox" class="Cover4"
                                                    onchange="handleCheckboxChange('Cover4',this)" name="b_7"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_7 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Cover4"
                                                    onchange="handleCheckboxChange('Cover4',this)" name="b_7"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_7 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Cover4"
                                                    onchange="handleCheckboxChange('Cover4',this)" name="b_7"
                                                    value="na" @checked($laporan_proses_penjilidan->b_7 == 'na') id=""></td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Lain-lain</td>
                                            <td><input type="checkbox" class="Text8"
                                                    onchange="handleCheckboxChange('Text8',this)" name="b_8"
                                                    value="ok" @checked($laporan_proses_penjilidan->b_8 == 'ok') id=""></td>
                                            <td><input type="checkbox" class="Text8"
                                                    onchange="handleCheckboxChange('Text8',this)" name="b_8"
                                                    value="ng" @checked($laporan_proses_penjilidan->b_8 == 'ng') id=""></td>
                                            <td><input type="checkbox" class="Text8"
                                                    onchange="handleCheckboxChange('Text8',this)" name="b_8"
                                                    value="na" @checked($laporan_proses_penjilidan->b_8 == 'na') id=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <div class="row mt-5" style="background:#f1f0f0;">
                        <div class="col-md-12 mt-5">
                            <h5><b>C) Pemeriksaan semasa proses penjilidan </b></h5>
                        </div>

                        <div class="col-md-12 ">
                            <button class="btn btn-primary float-right mb-5  mr-5">+ Add</button>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Jumlah </th>
                                        <th colspan="5s">Kriteria</th>
                                        <th rowspan="2">Check (Operator)</th>
                                        <th rowspan="2">Username / datetime</th>
                                        <th rowspan="2">Verify</th>
                                        <th rowspan="2">Username / datetime</th>
                                        <th rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                        <th>Kedudukan Kulit buku  dan teks</th>
                                        <th>Artwork Kulit buku  dan teks</th>
                                        <th>Turutan Seksyen/ muta surat</th>
                                        <th>Rosak/Koyak</th>
                                        <th>Kotor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>500</td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><button class="btn" style="border-radius:25px; background:#b7aeae; color:#fff;">check</button>
                                        </td>
                                        <td>A/12/12/2023 10:10Am</td>
                                        <td><button class="btn"
                                        style="border-radius:25px; background:#b7aeae; color:#fff;">Verify</button>
                                        </td>
                                        <td>A/12/12/2023 10:30Am</td>
                                        <td><button class="btn btn-danger" style="border-radius:5px; ">X</button></td>
                                    </tr>
                                    <tr>
                                        <td>1000</td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><button class="btn" style="border-radius:25px; background:#b7aeae; color:#fff;">check</button>
                                        </td>
                                        <td>A/12/12/2023 10:30Am</td>
                                        <td><button class="btn" style="border-radius:25px; background:#b7aeae; color:#fff;">Verify</button>
                                        </td>
                                        <td>A/12/12/2023 10:50Am</td>
                                        <td><button class="btn btn-danger" style="border-radius:5px; ">X</button></td>
                                    </tr>
                                    <tr>
                                        <td>1500</td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><input type="checkbox" checked name="" id=""></td>
                                        <td><button class="btn " style="border-radius:25px; background:#b7aeae; color:#fff;">check</button>
                                        </td>
                                        <td>A/12/12/2023 11:05Am</td>
                                        <td><button class="btn" style="border-radius:25px; background:#b7aeae; color:#fff;">Verify</button>
                                        </td>
                                        <td>A/12/12/2023 10:50Am</td>
                                        <td><button class="btn btn-danger" style="border-radius:5px; ">X</button></td>
                                    </tr>
                                </tbody>
                            </table>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"> Verify</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <form
                                    action="{{ route('laporan_proses_penjilidan.approve.decline', $laporan_proses_penjilidan->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <button class="btn btn-danger mx-2" type="submit">Decline</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('laporan_proses_penjilidan') }}">back to list</a>
        </div>
    </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('input').attr('disabled', 'disabled');
            $('.verify_operator').removeAttr('disabled');
            $('input[type="hidden"]').removeAttr('disabled');
        });

        function formatDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');

            return `${day}-${month}-${year} ${hours}:${minutes}`;
        }

        $(document).on('click', '.verify_btn', function() {
            $(this).attr('disabled', 'disabled');
            const currentDate = new Date();
            const formattedDate = formatDate(currentDate);
            let checked_by = $('#checked_by').val();
            $(this).closest('tr').find('.verify_operator').val(checked_by + '/' + formattedDate);
        });
    </script>
@endpush
