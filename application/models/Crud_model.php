<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function GetData($table,$field='',$condition='',$group='',$order='',$limit='',$result='', $castImages = "") {
        
        if($field != '') {
            $this->db->select($field);
        }

        if($condition != '') {
            $this->db->where($condition);
        }

        if($order != '') {
            $this->db->order_by($order);
        }

        if($limit != '') {
            $this->db->limit($limit);
        }

        if($group != '') {
            $this->db->group_by($group);
        }

        if($result != '') {
            $return =  $this->db->get($table)->row();
        } else {
            $return =  $this->db->get($table)->result();
        }

        if($castImages != "") {
            foreach($castImages as $castImage) {
                foreach($return as $key => $arr) {
                    $arr->{$castImage['key']} = $castImage['base'] . $arr->{$castImage['key']};
                    $return[$key] = $arr;
                }
            }
        }
        return $return;
    }

    public function SaveData($table,$data,$condition='') {
        $DataArray = array();
        if(!empty($condition)) {
            $data['modified']=date("Y-m-d H:i:s");
        } else if(empty($condition)) {
            $data['created']=date("Y-m-d H:i:s");
            $data['modified']=date("Y-m-d H:i:s");
        }
        $table_fields = $this->db->list_fields($table);
        foreach($data as $field=>$value) {
            if(in_array($field,$table_fields)) {
                $DataArray[$field]= $value;
            }
        }
        if($condition != '') {
            $this->db->where($condition);
            $this->db->update($table, $DataArray);
        } else {
            $this->db->insert($table, $DataArray);
        }
    }

    public function DeleteData($table,$condition='',$limit='') {
        if($condition != '') {
           $this->db->where($condition);
        }

        if($limit != '') {
            $this->db->limit($limit);
        }

        $this->db->delete($table);
    }

    //get single data
    function get_single($table, $cond='') {
        if($cond != '') {
            $this->db->where($cond);
        }
        return $this->db->get($table)->row();
    }

    function getUseridByMobile($table,$condmobile) {
        if(!empty($condmobile)) {
            $this->db->where($condmobile);
        }
        return $this->db->get($table)->row();
    }

    function getUseridByEmail($table,$condemail) {
        if(!empty($condemail)) {
            $this->db->where($condemail);
        }
        return $this->db->get($table)->row();
    }

    function get_single_record($tablename,$condition) {
        $this->db->where($condition);
        return $this->db->get($tablename)->row();
    }

    public function Convert($number='0') {
        error_reporting(0);
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str[] = null;
            }

        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ? "." . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
        // echo $result . "Rupees  " . $points . " Paise";
        return ucwords($result) . "Rupees  Only";
    }
}
?>
