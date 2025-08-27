<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceStatusController extends Controller
{
    public function getStatus()
    {
        $devices = [ 
    ['name' => 'DISPLAY 100 & 101', 'ip' => '10.1.31.43'],
    ['name' => 'DISPLAY 105 & 106', 'ip' => '10.1.31.44'],
    ['name' => 'DISPLAY 107, 108 & 109', 'ip' => '10.1.31.47'],
    ['name' => 'DISPLAY 110 & 111', 'ip' => '10.1.31.48'],
    ['name' => 'DISPLAY 115 & 116', 'ip' => '10.1.31.45'],
    ['name' => 'DISPLAY 117 & 118', 'ip' => '10.1.31.49'],
    ['name' => 'DISPLAY 122 & 123', 'ip' => '10.1.31.46'],
    ['name' => 'DISPLAY 125', 'ip' => '10.1.31.22'],
    ['name' => 'DISPLAY 126', 'ip' => '10.1.31.30'],
    ['name' => 'DISPLAY 129 & 131', 'ip' => '10.1.31.32'],
    ['name' => 'DISPLAY 132', 'ip' => '10.1.31.34'],
    ['name' => 'DISPLAY 133', 'ip' => '10.1.31.26'],
    ['name' => 'DISPLAY 136, 135', 'ip' => '10.1.31.21'],
    ['name' => 'DISPLAY 137 & 138', 'ip' => '10.1.31.41'],
    ['name' => 'DISPLAY 150', 'ip' => '10.1.31.38'],
    ['name' => 'DISPLAY 151', 'ip' => '10.1.31.23'],
    ['name' => 'DISPLAY 152, 120, 119', 'ip' => '10.1.31.39'],
    ['name' => 'DISPLAY 153 (UMUM)', 'ip' => '10.1.31.42'],
    ['name' => 'DISPLAY 170', 'ip' => '10.1.31.38'],    
    ['name' => 'DISPLAY 601 & 602', 'ip' => '10.1.31.13'],
    ['name' => 'DISPLAY 603 & 605', 'ip' => '10.1.31.17'],   
    ['name' => 'DISPLAY 606 & 607', 'ip' => '10.1.31.16'],
    ['name' => 'DISPLAY 611 & 612', 'ip' => '10.1.31.14'],
    ['name' => 'DISPLAY 603 & 605', 'ip' => '10.1.31.17'],   
    ['name' => 'DISPLAY 616 & 617', 'ip' => '10.1.31.12'],
    ['name' => 'DISPLAY 618', 'ip' => '10.1.31.18'],
    ['name' => 'DISPLAY 620 & 619', 'ip' => '10.1.31.10'],  
    ['name' => 'DISPLAY 621 & 622', 'ip' => '10.1.31.9'],
    ['name' => 'DISPLAY 625 & 623', 'ip' => '10.1.31.4'],    
    ['name' => 'DISPLAY 626 & 627', 'ip' => '10.1.31.11'],
    ['name' => 'DISPLAY 629 & 628', 'ip' => '10.1.31.20'],
    ['name' => 'DISPLAY 632 & 630', 'ip' => '10.1.31.8'], 
    ['name' => 'DISPLAY KIDSFOOT', 'ip' => '10.1.31.27'],
    ['name' => 'DISPLAY FISIOTERAPI', 'ip' => '10.1.31.28'],
    ['name' => 'DISPLAY BEDAH', 'ip' => '10.1.31.24'],
    ['name' => 'DISPLAY AZALEA', 'ip' => '10.1.31.2'],
    ['name' => 'DISPLAY BOUGENVILE', 'ip' => '10.1.31.52'],
    ['name' => 'DISPLAY CTR LITTLE STAR', 'ip' => '10.1.31.19'],
    ['name' => 'DISPLAY CPS', 'ip' => '10.1.31.29'],
    ['name' => 'DISPLAY CRI', 'ip' => '10.1.31.51'],
    ['name' => 'DISPLAY FARMASI', 'ip' => '10.1.31.35'],
    ['name' => 'DISPLAY GARBERA', 'ip' => '10.1.31.36'],    
    ['name' => 'DISPLAY JHVC', 'ip' => '10.1.31.33'],
    ['name' => 'DISPLAY LAB CHECKIN', 'ip' => '10.1.31.53'],
    ['name' => 'KIOS LAB CHECKIN', 'ip' => '10.1.31.50'],
    ['name' => 'DISPLAY LOUNGE', 'ip' => '10.1.31.31'],    
    ['name' => 'DISPLAY RADIOLOGI', 'ip' => '10.1.31.40'],
    ['name' => 'DISPLAY NS DIGESTIVE', 'ip' => '10.1.31.6'],
    ['name' => 'DISPLAY NS LITTLE STAR', 'ip' => '10.1.31.5'], 
    ['name' => 'DISPLAY NS WOMEN', 'ip' => '10.1.31.7'],
    ['name' => 'DISPLAY COUNTER WOMEN', 'ip' => '10.1.31.3']
];

        $results = [];
        $totalUp = 0;
        $totalDown = 0;

        foreach ($devices as $device) {
            $status = $this->pingDevice($device['ip']) ? 'UP' : 'DOWN';

            if ($status === 'UP') $totalUp++;
            else $totalDown++;

            $results[] = [
                'name' => $device['name'],
                'ip' => $device['ip'],
                'status' => $status,
            ];
        }

        return response()->json([
            'devices' => $results,
            'totalUp' => $totalUp,
            'totalDown' => $totalDown,
        ]);
    }

    private function pingDevice($ip)
    {
        $os = strtoupper(substr(PHP_OS, 0, 3));
        $cmd = $os === 'WIN' ? "ping -n 1 -w 1000 $ip" : "ping -c 1 -W 1 $ip";
        exec($cmd, $output, $status);
        return $status === 0;
    }
}
