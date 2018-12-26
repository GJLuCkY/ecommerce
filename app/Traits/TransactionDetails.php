<?php

namespace App\Traits;

class TransactionDetails {
  public $billingAddress; // Address
  public $currencyCode; // int
  public $customerReference; // string
  public $description; // string
  public $goodsList; // GoodsItem
  public $languageCode; // string
  public $merchantAdditionalInformationList; // AdditionalInformation
  public $merchantId; // string
  public $returnURL; // string
  public $terminalId; // string
  public $totalAmount; // string
  public $merchantLocalDateTime;//string
  public $purchaserName;//string
  public $purchaserPhone;//string
  public $purchaserEmail;//string
  public $orderId;//string
}