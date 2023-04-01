<?php

namespace App\Http\Repository;

use App\Models\Transaction;

class TransactionRepository
{
    // Add your custom code here

    public function find(int $id): ?Transaction
    {
        return Transaction::find($id);
    }

    public function create(array $data): Transaction
    {
        return Transaction::create([$data]);
    }

    public function update(int $id, array $data): Transaction
    {
        $item = Transaction::find($id);
        $item->update([$data]);
        return $item;
    }

    public function delete(int $id): bool
    {
        return Transaction::destroy($id) > 0;
    }
}
