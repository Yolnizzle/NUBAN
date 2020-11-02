<?php
function ValidateNuban($bankCode, $accountNumber){
		if (strlen($bankCode) == 3 && strlen($accountNumber) == 10) {
			$nubanAccSerialNum = substr($accountNumber, 0, -1);
			$checkDigit = substr($accountNumber, -1);
			$nubanFormat = $bankCode . $nubanAccSerialNum;
			$nubanArray = str_split($nubanFormat);
			$algoDictionary = [3, 7, 3, 3, 7, 3, 3, 7, 3, 3, 7, 3];
			$checkSum = 0;
			foreach ($nubanArray as $key => $value) {
				$checkSum += ($value * $algoDictionary[$key]);
			}
			$validatedCheckDigit = 10 - ($checkSum % 10);
			$validatedCheckDigit = $validatedCheckDigit == 10 ? 0 : $validatedCheckDigit;
			return $checkDigit == $validatedCheckDigit ? 'Valid' : 'Invalid';	
		}else{
			throw new Exception("Invalid Bank Code or Account Number Length");			
		}	
;}