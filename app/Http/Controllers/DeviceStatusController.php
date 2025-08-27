<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceStatusController extends Controller
{
    public function getStatus()
    {
        $devices = [ 
    ['name' => 'DISPLAY 100 & 101', 'ip' => 'YOUR_IP_ADDRESS'],
    ['name' => 'DISPLAY 105 & 106', 'ip' => 'YOUR_IP_ADDRESS'],
    ['name' => 'DISPLAY 107, 108 & 109', 'ip' => 'YOUR_IP_ADDRESS'],
    ['name' => 'DISPLAY 110 & 111', 'ip' => 'YOUR_IP_ADDRESS'],
    ['name' => 'DISPLAY 115 & 116', 'ip' => 'YOUR_IP_ADDRESS'],
    ['name' => 'DISPLAY 117 & 118', 'ip' => 'YOUR_IP_ADDRESS']
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
