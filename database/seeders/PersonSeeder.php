<?php

namespace Database\Seeders;

use App\Helpers\DataImporter;
use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path('/seeders/test-data.csv');
        $records = DataImporter::importCSV($file);

        foreach ($records as $key => $record) {
            Person::create([
                'email'     => $record['Email Address'],
                'name'      => $record['Name'],
                'dob'       => $record['Birthday'],
                'phone'     => $record['Phone'],
                'ip'        => $record['IP'],
                'country'   => $record['Country'],
            ]);
        }
    }
}
