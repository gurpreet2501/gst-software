<?php 

function get_tile_name($id){
    
 $tile = Models\SmsTiles::select('name')->where('id', $id)->first();

 return $tile->name;
 
}


function getBillTotal($data, $tax_rates, $extra_charges){
	
	$total = 0;
	
	foreach ($data as $key => $val) 
		$total = $total + $val['stock'] * $val['price'];
 
    $rate_total = 0;

	foreach ($tax_rates as $key => $tax_id) {
		$rate_record = Models\Gst::where('id', $tax_id)->where('is_fright_gst',0)->first();	
        if(!$rate_record)
            continue;

		$rate = ($rate_record->rate_percent * $total)/100.0;
		
		$rate_total = $rate_total + $rate;		
	}

    $frieght_gst = 0;
    $fright_tax = Models\Gst::where('id', $tax_id)->where('is_fright_gst',1)->first(); 
    if(!empty($fright_tax))
    {
        $frieght_gst = ($extra_charges * $fright_tax->rate_percent)/100.00;
    }

	return ($total + $rate_total + $extra_charges + $frieght_gst);
}

function reduce_tile_stock($tile){
	$record = Models\SmsTiles::where('id', $tile['tile_id'])->first();
	$stock = 	$record->stock - $tile['stock'];
	$record->stock = $stock;
	$record->save();
}

function is_booking($id){
	$record = Models\SmsBill::select('is_booking')->where('id',$id)->first();
	return $record->is_booking;
}

function check_if_stock_available($tile){
	$record = Models\SmsTiles::where('id', $tile['tile_id'])->first();
	
	if($record->stock < $tile['stock'])
	{
		failure('Sufficient Stock not available for tile '.$record->name.'. Available stock is:'.$record->stock);
		redirect('billing/create');
	}	


}


function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

