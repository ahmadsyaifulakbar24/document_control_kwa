<?php

namespace Database\Seeders;

use App\Models\Param;
use Illuminate\Database\Seeder;

class ParamsTableSeeder extends Seeder
{
    public function run()
    {
        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'MOM',
            'order' => 1,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'Surat Penunjukan',
            'order' => 2,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'BAK',
            'order' => 3,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'Surat + Desain',
            'order' => 4,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'RAB',
            'order' => 5,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'DRM',
            'order' => 6,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'Material Request',
            'order' => 7,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'Material Onsite',
            'order' => 8,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'Instalasi',
            'order' => 9,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'BA UT',
            'order' => 10,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'BAST/BASO',
            'order' => 11,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param' => 'PKS',
            'order' => 12,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param_id' => 9,
            'param' => 'Evidence',
            'order' => 1,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param_id' => 9,
            'param' => 'Progres',
            'order' => 2,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param_id' => 10,
            'param' => 'Valid 4',
            'order' => 1,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param_id' => 10,
            'param' => 'TESTCOM',
            'order' => 1,
            'active' => true
        ]);

        Param::create([
            'category_param' => 'group_document_ppjab',
            'param_id' => 10,
            'param' => 'BA REKON',
            'order' => 1,
            'active' => true
        ]);
    }
}
