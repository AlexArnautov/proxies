<?php

namespace App\Exports;

use App\Models\Proxy;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProxiesExport implements FromCollection, WithMapping, WithHeadings
{
    private array $neededColumns = [];

    public function __construct(
        private readonly Collection $proxies,
        private readonly string $format
    ) {
        $this->setNeededColumns();
    }

    public function collection(): Collection
    {
        return $this->proxies;
    }

    private function setNeededColumns(): void
    {
        $format = str_replace('@', ':', $this->format);
        $formatArray = explode(':', $format);
        $this->neededColumns = $formatArray;
    }

    public function map($row): array
    {
        $result = [];
        foreach ($this->neededColumns as $column) {
            /** @var Proxy $row */
            $getMethodName = 'get' . ucfirst($column);
            $result[] = $row->$getMethodName();
        }

        return $result;
    }

    public function headings(): array
    {
        return $this->neededColumns;
    }
}
