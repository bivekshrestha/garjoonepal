<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Attribute\Entities\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->truncate();

        $attributes = [
            [
                'name' => 'Job Type',
                'type' => 'select',
                'category' => 'jobs',
                'options' => [
                    'Full Time',
                    'Part Time',
                    'Contract'
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Job Experience',
                'type' => 'select',
                'category' => 'jobs',
                'options' => [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5 and above',
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Qualification',
                'type' => 'select',
                'category' => 'jobs',
                'options' => [
                    'Bachelor Degree',
                    'Master Degree',
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Company',
                'type' => 'text',
                'category' => 'jobs',
                'options' => null,
                'is_filterable' => true,
            ],
            [
                'name' => 'Type',
                'type' => 'select',
                'category' => 'real-estate',
                'options' => [
                    'For Sale',
                    'For Rent',
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Parking',
                'type' => 'select',
                'category' => 'accommodation',
                'options' => [
                    'Available',
                    'Not Available',
                    'Reserved',
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Water',
                'type' => 'select',
                'category' => 'accommodation',
                'options' => [
                    'Conditional',
                    '24 hrs'
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Storey',
                'type' => 'select',
                'category' => 'accommodation',
                'options' => [
                    'Ground Floor',
                    '1st Floor',
                    '2nd Floor',
                    '3rd Floor',
                    '4th Floor',
                    '5th Floor',
                    '6th Floor',
                    '7th Floor',
                    '9th Floor',
                    '10th and above',
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Brand',
                'type' => 'select',
                'category' => 'motor-vehicles',
                'options' => [
                    'Audi',
                    'Hyundai',
                    'Honda',
                    'Toyota',
                    'Suzuki',
                    'Mercedes'
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Capacity',
                'type' => 'select',
                'category' => 'motor-vehicles',
                'options' => [
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8 and above',
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Type',
                'type' => 'select',
                'category' => 'motor-vehicles',
                'options' => [
                    'For Sale',
                    'For Rent'
                ],
                'is_filterable' => true,
            ],
            [
                'name' => 'Condition',
                'type' => 'select',
                'category' => 'motor-vehicles',
                'options' => [
                    'New',
                    'Used',
                    'Refurbished',
                    'Damaged',
                    'Salvage'
                ],
                'is_filterable' => true,
            ],
        ];

        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }
    }
}
