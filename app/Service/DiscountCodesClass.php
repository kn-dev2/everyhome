<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\DiscountCodesRepository;
use App\Models\DiscountCode;

class DiscountCodesClass implements DiscountCodesRepository
{
    // list of all data
    public function listAll()
    {
        return DiscountCode::paginate(10);
    }

    // details
    public function Details($id)
    {
        return DiscountCode::findOrFail($id);
    }
}
