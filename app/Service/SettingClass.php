<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace App\Service;

use App\Repositories\SettingRepository;
use App\Models\Setting;

class SettingClass implements SettingRepository
{
    // details
    public function details()
    {
        return Setting::findOrFail(1);
    }
}
