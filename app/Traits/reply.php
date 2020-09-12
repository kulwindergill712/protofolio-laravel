<?php
namespace App\Traits;

trait reply
{

    public function s($msg, $info)
    {
        $data['status_code'] = 1;
        $data['status_text'] = 'success';
        $data['message'] = $msg;
        if ($info != '') {
            $data['data'] = $info;
        }
        return $data;
    }

    public function f($msg)
    {
        $data['status_code'] = 0;
        $data['status_text'] = 'Failed';
        $data['message'] = $msg;
        return $data;
    }

}
