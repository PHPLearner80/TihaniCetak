<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Dashboard',
            'Role List',
            'Role Create',
            'Role Update',
            'Role View',
            'Role Delete',
            'User List',
            'User Create',
            'User Update',
            'User View',
            'User Delete',
            'UOM List',
            'UOM Create',
            'UOM Update',
            'UOM View',
            'UOM Delete',
            'UOM Conversion List',
            'UOM Conversion Create',
            'UOM Conversion Update',
            'UOM Conversion View',
            'UOM Conversion Delete',
            'Department List',
            'Department Create',
            'Department Update',
            'Department View',
            'Department Delete',
            'Designation List',
            'Designation Create',
            'Designation Update',
            'Designation View',
            'Designation Delete',
            'Machine List',
            'Machine Create',
            'Machine Update',
            'Machine View',
            'Machine Delete',
            'Area Level List',
            'Area Level Create',
            'Area Level Update',
            'Area Level View',
            'Area Level Delete',
            'Area Shelf List',
            'Area Shelf Create',
            'Area Shelf Update',
            'Area Shelf View',
            'Area Shelf Delete',
            'Area List',
            'Area Create',
            'Area Update',
            'Area View',
            'Area Delete',
            'Product List',
            'Product Create',
            'Product Update',
            'Product View',
            'Product Delete',
            'SaleOrder List',
            'SaleOrder View',
            'SaleOrder Upload',
            'SaleOrder Approve',
            'SaleOrder Publish',
            'Senarai Semak Pencetakan Digital List',
            'Senarai Semak Pencetakan Digital Create',
            'Senarai Semak Pencetakan Digital Update',
            'Senarai Semak Pencetakan Digital View',
            'Senarai Semak Pencetakan Digital Delete',
            'Senarai Semak Pencetakan Digital Verify',
            'Senarai Semak Pra Cetak List',
            'Senarai Semak Pra Cetak Create',
            'Senarai Semak Pra Cetak Update',
            'Senarai Semak Pra Cetak View',
            'Senarai Semak Pra Cetak Delete',
            'Senarai Semak Pra Cetak Verify',
            'REKOD SERAHAN PLATE CETAX DAN SAMPLE List',
            'REKOD SERAHAN PLATE CETAX DAN SAMPLE Create',
            'REKOD SERAHAN PLATE CETAX DAN SAMPLE Update',
            'REKOD SERAHAN PLATE CETAX DAN SAMPLE View',
            'REKOD SERAHAN PLATE CETAX DAN SAMPLE Delete',
            'LAPORAN PROSES PENCETAKANI List',
            'LAPORAN PROSES PENCETAKANI Create',
            'LAPORAN PROSES PENCETAKANI Update',
            'LAPORAN PROSES PENCETAKANI Verify',
            'LAPORAN PROSES PENCETAKANI View',
            'LAPORAN PROSES PENCETAKANI Delete',
            'LAPORAN PROSES LIPAT List',
            'LAPORAN PROSES LIPAT Create',
            'LAPORAN PROSES LIPAT Update',
            'LAPORAN PROSES LIPAT Verify',
            'LAPORAN PROSES LIPAT View',
            'LAPORAN PROSES LIPAT Delete',
            'LAPORAN PROSES PENJILIDAN List',
            'LAPORAN PROSES PENJILIDAN Create',
            'LAPORAN PROSES PENJILIDAN Update',
            'LAPORAN PROSES PENJILIDAN Verify',
            'LAPORAN PROSES PENJILIDAN View',
            'LAPORAN PROSES PENJILIDAN Delete',
            'LAPORAN PROSES PENJILIDAN SADDLE List',
            'LAPORAN PROSES PENJILIDAN SADDLE Create',
            'LAPORAN PROSES PENJILIDAN SADDLE Update',
            'LAPORAN PROSES PENJILIDAN SADDLE Verify',
            'LAPORAN PROSES PENJILIDAN SADDLE View',
            'LAPORAN PROSES PENJILIDAN SADDLE Delete',
            'LAPORAN PROSES THREE KNIFE List',
            'LAPORAN PROSES THREE KNIFE Create',
            'LAPORAN PROSES THREE KNIFE Update',
            'LAPORAN PROSES THREE KNIFE Verify',
            'LAPORAN PROSES THREE KNIFE View',
            'LAPORAN PROSES THREE KNIFE Delete',
            'PROSES PENCETAKAN List',
            'PROSES PENCETAKAN Create',
            'PROSES PENCETAKAN Update',
            'PROSES PENCETAKAN Verify',
            'PROSES PENCETAKAN View',
            'PROSES PENCETAKAN Delete',
            'CTP List',
            'CTP Create',
            'CTP Update',
            'CTP Verify',
            'CTP View',
            'CTP Delete',
            'POD List',
            'POD Create',
            'POD Update',
            'POD Verify',
            'POD View',
            'POD Delete',
            'LAPORAN PEMERIKSAAN KUALITI List',
            'LAPORAN PEMERIKSAAN KUALITI Create',
            'LAPORAN PEMERIKSAAN KUALITI Update',
            'LAPORAN PEMERIKSAAN KUALITI Verify',
            'LAPORAN PEMERIKSAAN KUALITI View',
            'LAPORAN PEMERIKSAAN KUALITI Delete',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN List',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN Create',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN Update',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN Verify',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN View',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN Delete',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN SADDLE List',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN SADDLE Create',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN SADDLE Update',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN SADDLE Verify',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN SADDLE View',
            'LAPORAN PEMERIKSAAN KUALITI PENJILIDAN SADDLE Delete',
            'PLATE CETAK List',
            'PLATE CETAK Create',
            'PLATE CETAK Update',
            'PLATE CETAK Verify',
            'PLATE CETAK View',
            'PLATE CETAK Delete',
         ];

         $permissionss = [
            'PROSES THREE KNIFE List',
            'PROSES THREE KNIFE Create',
            'PROSES THREE KNIFE Update',
            'PROSES THREE KNIFE Verify',
            'PROSES THREE KNIFE View',
            'PROSES THREE KNIFE Delete',
            'PROSES PEMBUNGKUSAN List',
            'PROSES PEMBUNGKUSAN Create',
            'PROSES PEMBUNGKUSAN Update',
            'PROSES PEMBUNGKUSAN Verify',
            'PROSES PEMBUNGKUSAN View',
            'PROSES PEMBUNGKUSAN Delete',
            'PENGUMPULAN GATHERING List',
            'PENGUMPULAN GATHERING Create',
            'PENGUMPULAN GATHERING Update',
            'PENGUMPULAN GATHERING Verify',
            'PENGUMPULAN GATHERING View',
            'PENGUMPULAN GATHERING Delete',
            'KULIT BUKU List',
            'KULIT BUKU Create',
            'KULIT BUKU Update',
            'KULIT BUKU Verify',
            'KULIT BUKU View',
            'KULIT BUKU Delete',
            'DIGITAL PRINTING List',
            'DIGITAL PRINTING Create',
            'DIGITAL PRINTING Update',
            'DIGITAL PRINTING Proses',
            'DIGITAL PRINTING Verify',
            'DIGITAL PRINTING View',
            'DIGITAL PRINTING Delete',
         ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        foreach ($permissionss as $perm) {
            if (!Permission::where('name', $perm)->exists()) {
                Permission::create(['name' => $perm]);
            }
        }
    }
}
