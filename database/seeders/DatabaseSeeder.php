<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Bin;
use App\Models\Lot;
use App\Models\Part;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Division;
use App\Models\Principal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $waktu = Carbon::now();
        // User::factory(10)->create();
        // DB::table('users')->insert([
        //     [
        //         'username' => 'okkadpl',
        //         'email' => 'okka.d@medev.com',
        //         'password' => Hash::make('123456'),
        //         'departement' => 'IT',
        //         'created_at' => $waktu,
        //         'updated_at' => $waktu,
        //     ]
        // ]);
        DB::table('users')->insert([
            [
                'username' => 'okkadpl',
                'email' => 'okka.d@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'IT',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'tanmeliawati',
                'email' => 't.meliawati@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'Management',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'tonny.s',
                'email' => 'tonny.s@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'Finance and Accounting',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'Budi Santoso',
                'email' => 'budi.s@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'Sales',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'Dwi Saputra',
                'email' => 'dwi.s@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'Warehouse',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'Aryanto Nugroho',
                'email' => 'aryanto.n@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'Product',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'Richardo',
                'email' => 'richardo@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'Billing',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'username' => 'Melissa Octaviani',
                'email' => 'melissa.o@medev.com',
                'password' => Hash::make('123456'),
                'departement' => 'HRD',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);
        DB::table('employees')->insert([
            [
                'nip' => '0001',
                'nama' => 'Okka Dharma',
                'bod' => '2000-05-01',
                'tlp' => '081213026398',
                'user_id' => 1,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0002',
                'nama' => 'Tan Meliawati',
                'bod' => '1979-05-12',
                'tlp' => '0812345678912',
                'user_id' => 2,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0003',
                'nama' => 'Tonny Suryanto',
                'bod' => '1999-01-01',
                'tlp' => '0812345648212',
                'user_id' => 2,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0004',
                'nama' => 'Budi Santoso',
                'bod' => '1999-01-01',
                'tlp' => '0812345678912',
                'user_id' => 4,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0005',
                'nama' => 'Dwi Saputra',
                'bod' => '1999-01-01',
                'tlp' => '0812345678912',
                'user_id' => 5,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0006',
                'nama' => 'Aryanto Nugroho',
                'bod' => '1999-01-01',
                'tlp' => '0812345678912',
                'user_id' => 6,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0007',
                'nama' => 'Richardo',
                'bod' => '1999-01-01',
                'tlp' => '0812345678912',
                'user_id' => 7,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nip' => '0008',
                'nama' => 'Melissa Octaviani',
                'bod' => '1999-01-01',
                'tlp' => '0812345678912',
                'user_id' => 8,
                'tgl_msk' => '2023-06-27',
                'status' => 'Aktif',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
        ]);
        DB::table('divisions')->insert([
            [
                'nama' => 'Cardiovascular',
                'nick' => 'CV',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nama' => 'Orthopaedic',
                'nick' => 'OT',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);

        DB::table('categories')->insert([
            [
                'nama' => 'Pencil',
                'division_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nama' => 'Endo',
                'division_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);

        DB::table('customers')->insert([
            [
                'id_customers' => 'Internal001',
                'nama' => 'Medev Indo Makmur',
                'tlp' => '081386159510',
                'email' => 'internal@intr.com',
                'alamat' => 'Komplek Perkantoran Duta Merlin Blok B 46-47, Jl. Gajah Mada B 46-47, Jakarta Pusat',
                'snpwp' => 'Tidak',
                'nonpwp' => '',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'id_customers' => 'CUST001',
                'nama' => 'RS. Pelni',
                'tlp' => '081386159510',
                'email' => 'pelni@rspelni.com',
                'alamat' => 'Jl. K.S. Tubun No.92 - 94, RW.1, Slipi, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11410',
                'snpwp' => 'Ya',
                'nonpwp' => '53.162.223.6-000.000',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'id_customers' => 'CUST002',
                'nama' => 'RSU. Hermina Tangerang',
                'tlp' => '55772525',
                'email' => 'hermina@rshermina.com',
                'alamat' => 'Jl. Ks. Tubun No.10, Ps. Baru, Kec. Karawaci, Kota Tangerang, Banten 15112',
                'snpwp' => 'Ya',
                'nonpwp' => '53.162.223.6-001.001',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);

        DB::table('principals')->insert([
            [
                'id_principals' => 'P0001',
                'nama' => 'Abbott Indonesia',
                'tlp' => '5571245',
                'email' => 'abbott@abbottindo.com',
                'alamat' => 'Wisma Pondok Indah 2, Kav V-TA, Jl. Arteri Pd. Indah, RT.4/RW.3, Pd. Pinang, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12310',
                'drek' => 'BCA',
                'norek' => '7120012315',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'id_principals' => 'P0002',
                'nama' => 'Medtronic Indonesia',
                'tlp' => '557245',
                'email' => 'medtronic@medtronicindo.com',
                'alamat' => 'Prima Center 1 Blok E-15, Kedaung Kali Angke, Cengkareng RT.11, RT.9/RW.12, Kedaung Kali Angke, Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11710, Daerah Khusus Ibukota Jakarta 12310',
                'drek' => 'BCA',
                'norek' => '7120022315',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'id_principals' => 'P0003',
                'nama' => 'Tawada Healthcare',
                'tlp' => '557225',
                'email' => 'cstawada@tawadahealthcare.com',
                'alamat' => 'Infinity Building, Jl. Raya Kebayoran Lama No.338, RT.12/RW.9, Sukabumi Utara, Kec. Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11540',
                'drek' => 'BCA',
                'norek' => '7120033315',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);

        DB::table('uoms')->insert([
            [
                'nama' => 'Pcs',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nama' => 'Box',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'nama' => 'Unit',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);
        DB::table('lots')->insert([
            [
                'kd_lots' => '2051272',
                'exp' => '2024-04-30',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_lots' => '2060471',
                'exp' => '2024-05-31',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_lots' => '1914000269',
                'exp' => '2024-05-01',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);
        DB::table('warehouses')->insert([
            [
                'id_warehouses' => 'WH0001',
                'nama' => 'Warehouse Head',
                'namaPt' => 'Medev Indo Makmur',
                'alamat' => 'Komplek Perkantoran Duta Merlin Blok B 46-47, Jl. Gajah Mada B 46-47, Jakarta Pusat',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);
        DB::table('bins')->insert([
            [
                'id_bins' => 'B0001',
                'customer_id' => 1,
                'alamat' => 'Komplek Perkantoran Duta Merlin Blok B 46-47, Jl. Gajah Mada B 46-47, Jakarta Pusat',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'id_bins' => 'B0002',
                'customer_id' => 2,
                'alamat' => 'Jl. K.S. Tubun No.92 - 94, RW.1, Slipi, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11410',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'id_bins' => 'B0003',
                'customer_id' => 3,
                'alamat' => 'Jl. Ks. Tubun No.10, Ps. Baru, Kec. Karawaci, Kota Tangerang, Banten 15112',
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]
        ]);
        DB::table('parts')->insert([
            [
                'kd_parts' => '8888145014',
                'nama' => '19/36CMPALINDROME KIT WSLOT',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '8888145015',
                'nama' => '23/40CM PALINDROME KIT WSLOT',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '8888145015P',
                'nama' => '23/40 PALINDROME P KIT',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '8888145016',
                'nama' => '28/45CM PALINDROME KIT WSLOT',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '1500275-15',
                'nama' => 'XIENCE SIERRA DES 2.75 X 15 RX CE',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '7210976',
                'nama' => 'INCISOR PLUS ELITE 4.5MM',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '1009664',
                'nama' => 'HI-TORQUE BALANCE MIDDLEWEIGHT UNIVERSAL II GUIDE WIRE STRAIGHT TIP PAK  190 CM',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '1013807',
                'nama' => 'HT COMMAND 18 LT 300CM',
                'uom_id' => 1,
                'category_id' => 1,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '30405150',
                'nama' => 'CANCELLOUS SCREWS FULLY THREADED 6.5X50MM SCREW',
                'uom_id' => 1,
                'category_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '31452034',
                'nama' => 'LOCKING HEAD SCREWS, SELF-TAPPING 5.0X34MM',
                'uom_id' => 1,
                'category_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '22531209',
                'nama' => 'PROXIMAL LATERAL FEMORAL LOCKING COMPRESSION PLATES 4.5/5.0. LEFT 5+9H',
                'uom_id' => 1,
                'category_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '30308130',
                'nama' => 'CORTEX SCREWS, FULLY THREADED 4.5X30MM',
                'uom_id' => 1,
                'category_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '30308138',
                'nama' => 'CORTEX SCREWS, FULLY THREADED 4.5X44MM',
                'uom_id' => 1,
                'category_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
            [
                'kd_parts' => '31452032',
                'nama' => 'LOCKING HEAD SCREWS, SELF-TAPPING 5.0X32MM',
                'uom_id' => 1,
                'category_id' => 2,
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ],
        ]);
    }
}
