@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                    <div class="d-flex justify-content-between">
                            <h4 class="card-title tx-20 mg-b-0 p-2">SENARAI SEMAK PENCETAKAN DIGITAL</h4>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                        <a href="{{route('SenariSemak.create')}}" class="btn btn-primary mb-2">Create</a>
                        </div>

                        <table class="table  mt-2" id="example1">
                            <thead>
                                <tr>
                                    <td>Sr.</td>
                                    <td>Sales Order No</td>
                                    <td>Tajuk</td>
                                    <td>kod Buku</td>
                                    <td>Date</td>
                                    <td>Checked By</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td>1</td>
                                    <td>SO-001496</td>
                                    <td>IQRO GENIUS - RUMI (NEW COVER)</td>
                                    <td>Stock</td>
                                    <td>30/5/2023</td>
                                    <td>Admin</td>
                                    <td><a class="badge badge-warning w-100 p-3" href="#">Checked</a</td>
                                    <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                        data-toggle="dropdown" id="dropdownMenuButton" type="button">Action<i class="fas fa-caret-down ml-1"></i></button>
                                        <div  class="dropdown-menu tx-13">
                                            <a class="dropdown-item" href="">View</a>
                                            <a class="dropdown-item" href="">Edit</a>
                                            <a class="dropdown-item" href="">Verify</a>
                                            <a class="dropdown-item" href="">Delete</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @endsection
