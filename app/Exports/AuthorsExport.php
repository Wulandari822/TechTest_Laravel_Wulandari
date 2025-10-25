<?php

namespace App\Exports;

use App\Models\Author;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuthorsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Author::select('author_id', 'nama')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
        ];
    }
}
