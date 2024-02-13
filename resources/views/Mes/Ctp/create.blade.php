@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="float-left"><b>LAPORAN PEMERIKSAAN KUALITI - CTP</b></h5>
                            <p class="float-right">TCBS-B61 (Rev.0)</p>
                        </div>
                    </div>
                    

                    <div class="card" style="background:#f1f0f0;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="">Tarikh</label>
                                        <input type="date" readonly name="" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">Masa</label>
                                    <input type="time" value="Admin" readonly name="" id="" class="form-control">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <div class="label">Disemak Oleh</div>
                                        <input type="text" value="Admin" readonly name="" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Sales Order No.</div>
                                        <select name="" id="" class="form-control">
                                            <option value="" >select sales Order no</option>
                                            <option value="">SO-001496</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Tajuk</div>
                                        <input type="text" readonly value="auto Display" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="label">Kod Buku</div>
                                        <input type="text" value="auto Display" readonly name="" id=""
                                            class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-5">
                                <div class="col-md-5">
                                    <h6><b>File Artwork</b></h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">kriteria</th>
                                                <th colspan="3">Tanda bagi Yang bekenaan</th>

                                            </tr>
                                            <tr>
                                                <th>OK</th>
                                                <th>NG</th>
                                                <th>NA</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>Format file</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Saiz Product</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Bleed</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Saiz Spine</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat pencetak</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah muka surat</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Turutan muka surat</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Kedudukan Artwork Cover (hardcover)</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>

                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-5">
                                    <h6><b>impositions</b></h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">kriteria</th>
                                                <th colspan="3">Tanda bagi Yang bekenaan</th>

                                            </tr>
                                            <tr>
                                                <th>OK</th>
                                                <th>NG</th>
                                                <th>NA</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>Front and Back imposition</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Kedudukan imposition</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Saiz spacing</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Printing method (Straight @ Perfecting)</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Up</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Dummy Lipat</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Penjilidan </td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kertas</td>
                                                <td><input type="checkbox" name="" id=""></td>
                                                <td><input type="checkbox" checked name="" id=""></td>
                                                <td><input type="checkbox" name="" id=""></td>

                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">
                                    <a href="" class="float-right" style="color:blue;"><b>RUJUKAN</b></a>
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
        </div>
        <a href="{{route('Ctp.index')}}">back to list</a>
    </div>
</div>
</div>
@endsection

