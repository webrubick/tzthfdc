<?php

defined('BASEPATH') OR exit('No direct script access allowed');


function to_where_by_raw_conditions($CI, $conditions) {
	$where = implode(' AND ', $conditions);
    if (empty($where)) {
    	return '1 = 1';
    }
    return $where;
}

function to_where_str($CI, $conditions='')
{
	$wherearr = array();
	
		if ($conditions) {
			if (!is_array($conditions)) {
				$conditions = array($conditions => NULL);
			}
			foreach ($conditions as $k => $v) {
				$where = '';
				if ($v !== NULL)
				{
					$where .= $k . ' = ' . $CI->db->escape($v);
				} else {
					$where .= $k . ' IS NULL';
				}
				$wherearr[] = $where;
			}
        }
        if (empty($wherearr)) {
        	return '1 = 1';
        }
    return implode(' AND ', $wherearr);
}

function to_select_str($CI, $cols='', $pre = '')
{
	if (empty($cols)) {
		return '';
	}
	$selectarr = array();
	if (!is_array($cols)) {
		$cols = array($cols);
	}
	foreach ($cols as $col) {
		$selectarr[] = $pre . $col;
	}
    return implode(', ', $selectarr);
}

?>