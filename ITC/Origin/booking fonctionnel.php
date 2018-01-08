<?php namespace ITC\Models;
use ITC\Core\Admin;
class Booking {
  static public $DATE_FORMAT = 'd/m/Y';
  static public $TIME_FORMAT = 'H:i';

  static protected $_MONEY_FORMAT = '%n €';

  public $cardCryptogram;
  public $cardExpiration;
  public $cardMode = 0;
  public $cardNumber;
  public $cardOwner;
  public $cardType = 0;

  public $code;
  public $creationDate;

  public $flightCompany;
  public $flightTime;
  public $flightNumber;

  public $id;

  public $insCancel = false;
  public $insExcess = 0;
  public $insGt = false;
  public $insPai = false;
  public $insYoung = false;

  public $mainConditions = false;
  public $mainFromAgency;
  public $mainToAgency;

  public $number;

  public $optBabySeat = 0;
  public $optBoosterSeat = 0;
  public $optDriver = 0;
  public $optGps = false;
  public $optLate = false;

  public $result;
  public $search;

  public $userAddress;
  public $userAddressRest;
  public $userBirthday;
  public $userBirthPlace;
  public $userCity;
  public $userEmail;
  public $userLicenceDate;
  public $userLicenceId;
  public $userLicenceOk = false;
  public $userLicencePlace;
  public $userName;
  public $userPhone;
  public $userSurname;
  public $userZipcode;

  public $codePromo; //Samuel Etheve - 03/10/2017
  public $justMonth;
  public $justYear;
  public $monthOrYear;
  public $dataDate;

  public $dataSPPLUS; //ethsam 05-01-2018 data obj pour function
  public $cbNumberF;

  protected $_DATETIME_FORMAT;
  protected $_OPT;
  protected $_TIME_ZONE;

  public function __construct( $id, $search, $result ) {
    $this->_DATETIME_FORMAT = static::$DATE_FORMAT . '-' . static::$TIME_FORMAT;
    $this->_OPT = get_option( Admin::$OPTIONS_GROUP );
    $this->_TIME_ZONE = new \DateTimeZone( 'Indian/Reunion' );
    $this->search = $search;
    $this->result = $result;

    if ( empty( $id ) ) return;
    $pod = pods( 'itc_estimate', $id );
    if ( $pod->exists() ) $this->fetch( $pod, $id );
  }

  public function fetch( $pod, $id ) {
    $this->id = $id;
    $this->flightCompany = $pod->field( 'flightcompany' );
    $this->flightNumber = $pod->field( 'flightnumber' );
    $this->flightTime = \DateTime::createFromFormat( static::$TIME_FORMAT, $pod->field( 'flighttime' ), $this->_TIME_ZONE );
    $this->insCancel = $pod->field( 'cancel' ) === '1';
    $this->insExcess = ( int ) $pod->field( 'excess' );
    $this->insGt = $pod->field( 'gt' ) === '1';
    $this->insPai = $pod->field( 'pai' ) === '1';
    $this->insYoung = $pod->field( 'young' ) === '1';
    $this->mainFromAgency = Agency::getBySlug( $pod->field( 'fromagency' ) );
    $this->mainToAgency = Agency::getBySlug( $pod->field( 'toagency' ) );
    $this->optBabySeat = ( int ) $pod->field( 'babyseat' );
    $this->optBoosterSeat = ( int ) $pod->field( 'boosterseat' );
    $this->optDriver = ( int ) $pod->field( 'driver' );
    $this->optGps = $pod->field( 'gps' ) === '1';
    $this->optLate = $pod->field( 'late' ) === '1';
    $this->userAddress = $pod->field( 'address' );
    $this->userAddressRest = $pod->field( 'addressrest' );
    $this->userBirthday = \DateTime::createFromFormat( static::$DATE_FORMAT, $pod->field( 'birthday' ), $this->_TIME_ZONE );
    $this->userBirthPlace = $pod->field( 'birthplace' );
    $this->userCity = $pod->field( 'city' );
    $this->userEmail = $pod->field( 'email' );
    $this->userName = $pod->field( 'firstname' );
    $this->userLicenceDate = \DateTime::createFromFormat( static::$DATE_FORMAT, $pod->field( 'licencedate' ), $this->_TIME_ZONE );
    $this->userLicenceId = $pod->field( 'licenceid' );
    $this->userLicencePlace = $pod->field( 'licenceplace' );
    $this->userPhone = $pod->field( 'phone' );
    $this->userSurname = $pod->field( 'surname' );
    $this->userZipcode = $pod->field( 'zipcode' );
    $this->codePromo = $this->search->getCodePromo(); //Samuel Etheve - 06/10/2017
  }

  public function getCardType() {
    return $this->cardType === 0 ? 'Visa' : ( $this->cardType === 1 ? 'Mastercard' : 'Carte bleue' );
  }

  public function getMainFrom() {
    return $this->mainFromAgency->name . ' - ' . $this->search->from->format( 'd/m/Y H:i' );
  }

  public function getMainPeriod() {
    return $this->result->period . ' ' . __( 'jour(s)', 'itc' );
  }

  public function getMainTo() {
    return $this->mainToAgency->name . ' - ' . $this->search->to->format( 'd/m/Y H:i' );
  }

  public function getNote() {
    $result = 'Prix public : ' . $this->priceResultPublicPrice() . PHP_EOL;
    $result .= 'Montant de base : ' . $this->priceResultPrice() . PHP_EOL;
    if ( $this->optGps ) $result .= 'GPS : ' . $this->priceOptGps() . PHP_EOL;
    if ( $this->optBoosterSeat > 0 ) $result .= $this->optBoosterSeat . ' Réhausseur(s) : ' . $this->priceOptBoosterSeat() . PHP_EOL;
    if ( $this->optBabySeat > 0 ) $result .= $this->optBabySeat . ' Siège(s) bébé : ' . $this->priceOptBabySeat() . PHP_EOL;
    if ( $this->optLate ) $result .= 'Arrivée tardive (au delà de 20h30) : ' . $this->priceOptLate() . PHP_EOL;
    if ( $this->optDriver > 0 ) $result .= $this->optDriver . ' Conducteur(s) supplémentaire(s) : ' . $this->priceOptDriver() . PHP_EOL;
    if ( $this->insGt ) $result .= 'Assurance bris de glace et crevaison (GT) : ' . $this->priceInsGt() . PHP_EOL;
    if ( $this->insPai ) $result .= 'Assurance personne transportée (PAI) : ' . $this->priceInsPai() . PHP_EOL;
    if ( $this->insYoung ) $result .= 'Assurance jeune conducteur 21 à 23 ans : ' . $this->priceInsYoung() . PHP_EOL;
    if ( $this->insCancel ) $result .= 'Assurance annulation (J-24h) : ' . $this->priceInsCancel() . PHP_EOL;
    if ( $this->insExcess > 0 ) $result .= 'Rachat de franchise : ' . $this->priceInsExcess() . PHP_EOL;
    if ( $this->isFromAirport() ) $result .= 'Surcharge aéroport : ' . $this->priceAirport() . PHP_EOL;
    if ( $this->hasDifferentAgencies() ) $result .= 'Changement de parc : ' . $this->priceParking() . PHP_EOL;
    $result .= 'Montant total (T.T.C.) : ' . $this->priceTotal() . PHP_EOL . PHP_EOL;
    $result .= 'Montant à débiter : ' . $this->priceCardMode() . PHP_EOL;
    $result .= 'Type de carte : ' . $this->getCardType() . PHP_EOL;
    $result .= 'Numéro de carte : ' . $this->cardNumber . PHP_EOL;
    $result .= 'Nom du porteur : ' . $this->cardOwner . PHP_EOL;
    $result .= 'Date d\'expiration : ' . $this->cardExpiration->format( 'm/Y' ) . PHP_EOL;
    $result .= 'Cryptogramme : ' . $this->cardCryptogram . PHP_EOL;
    return $result;
  }

  public function getPriceAirport() {
    return $this->isFromAirport() ? ( float ) $this->_OPT[ 'airport' ] : 0;
  }

  public function getPriceCardMode() {
    return $this->cardMode === 0 ? $this->getPriceTotal() : 80;
  }

  public function getPriceInsCancel() {
    return $this->insCancel ? ( float ) $this->_OPT[ 'cancel' ] : 0;
  }

  public function getPriceInsExcess() {
    return $this->insExcess * $this->result->period;
  }

  public function getPriceInsGt() {
    return $this->insGt ? ( float ) $this->_OPT[ 'gt' ] * $this->result->period : 0;
  }

  public function getPriceInsPai() {
    return $this->insPai ? ( float ) $this->_OPT[ 'pai' ] * $this->result->period : 0;
  }

  public function getPriceInsYoung() {
    return $this->insYoung ? ( float ) $this->_OPT[ 'young' ] * $this->result->period : 0;
  }

  public function getPriceOptBabySeat() {
    return $this->optBabySeat * min( ( float ) $this->_OPT[ 'babySeatMax' ], ( float ) $this->_OPT[ 'babySeat' ] * $this->result->period );
  }

  public function getPriceOptBoosterSeat() {
    return $this->optBoosterSeat * min( ( float ) $this->_OPT[ 'boosterSeatMax' ], ( float ) $this->_OPT[ 'boosterSeat' ] * $this->result->period );
  }

  public function getPriceOptDriver() {
    return $this->optDriver * ( float ) $this->_OPT[ 'driver' ];
  }

  public function getPriceOptGps() {
    return $this->optGps ? ( float ) $this->_OPT[ 'gps' ] * $this->result->period : 0;
  }

  public function getPriceOptLate() {
    return $this->optLate ? ( float ) $this->_OPT[ 'late' ] : 0;
  }

  public function getPriceParking() {
    return $this->hasDifferentAgencies() ? ( float ) $this->_OPT[ 'parking' ] : 0;
  }

  public function getPriceRest() {
    return $this->getPriceTotal() - $this->getPriceCardMode();
  }

  public function getPriceTotal() {
    return $this->result->price + $this->getPriceAirport() + $this->getPriceOptBabySeat() + $this->getPriceOptBoosterSeat() + $this->getPriceInsCancel() + $this->getPriceOptDriver() + $this->getPriceInsExcess()
           + $this->getPriceOptGps() + $this->getPriceInsGt() + $this->getPriceOptLate() + $this->getPriceInsPai() + $this->getPriceParking() + $this->getPriceInsYoung();
  }

  public function getUserFullName() {
    return mb_strtoupper( $this->userSurname ) . ' ' . $this->userName;
  }

  public function getUserPhone() {
    return substr( $this->userPhone, 0, 2 ) . ' ' . substr( $this->userPhone, 2, 2 ) . ' ' . substr( $this->userPhone, 4, 2 ) . ' ' . substr( $this->userPhone, 6, 2 ) . ' ' . substr( $this->userPhone, 8, 2 );
  }

  //Samuel Etheve - 03/10/2017 - recuperation code promo
  public function getCodePromo() {
  	return $this->codePromo;
  }

  public function hasDifferentAgencies() {
    return $this->mainFromAgency->slug !== $this->mainToAgency->slug;
  }

  public function isFromAirport() {
    return $this->mainFromAgency->slug === 'arg';
  }

  public function priceAirport() {
    return $this->toEuro( $this->getPriceAirport() );
  }

  public function priceCardMode() {
    return $this->toEuro( $this->getPriceCardMode() );
  }

  public function priceInsCancel() {
    return $this->toEuro( $this->getPriceInsCancel() );
  }

  public function priceInsExcess() {
    return $this->toEuro( $this->getPriceInsExcess() );
  }

  public function priceInsGt() {
    return $this->toEuro( $this->getPriceInsGt() );
  }

  public function priceInsPai() {
    return $this->toEuro( $this->getPriceInsPai() );
  }

  public function priceInsYoung() {
    return $this->toEuro( $this->getPriceInsYoung() );
  }

  public function priceOptBabySeat() {
    return $this->toEuro( $this->getPriceOptBabySeat() );
  }

  public function priceOptBoosterSeat() {
    return $this->toEuro( $this->getPriceOptBoosterSeat() );
  }

  public function priceOptDriver() {
    return $this->toEuro( $this->getPriceOptDriver() );
  }

  public function priceOptGps() {
    return $this->toEuro( $this->getPriceOptGps() );
  }

  public function priceOptLate() {
    return $this->toEuro( $this->getPriceOptLate() );
  }

  public function priceParking() {
    return $this->toEuro( $this->getPriceParking() );
  }

  public function priceResultPrice() {
    return $this->toEuro( $this->result->price );
  }

  public function priceResultPublicPrice() {
    return $this->toEuro( $this->result->publicPrice );
  }

  public function priceTotal() {
    return $this->toEuro( $this->getPriceTotal() );
  }

  public function save() {
    $pod = pods( is_null( $this->number ) ? 'itc_estimate' : 'itc_booking' );
    $this->creationDate = new \DateTime( 'now', new \DateTimeZone( 'Indian/Reunion' ) );

    $data = [
      'address' => $this->userAddress,
      'addressrest' => $this->userAddressRest,
      'babyseat' => $this->optBabySeat,
      'birthday' => ((!empty($this->userBirthday)? $this->userBirthday->format( 'd/m/Y' ) : '')), //$this->userBirthday->format( 'd/m/Y' ), //RLT 18.01.2017
      'birthplace' => $this->userBirthPlace,
      'boosterseat' => $this->optBoosterSeat,
      'cancel' => $this->insCancel,
      'category' => $this->result->slug,
      'city' => $this->userCity,
      'driver' => $this->optDriver,
      'email' => $this->userEmail,
      'excess' => $this->insExcess,
      'firstname' => $this->userName,
      'flightcompany' => $this->flightCompany,
      'flightnumber' => $this->flightNumber,
      'flighttime' => !empty( $this->flightTime ) ? $this->flightTime->format( 'H:i' ) : '',
      'fromagency' => $this->mainFromAgency->slug,
      'fromdate' => $this->search->from->format( 'd/m/Y H:i' ),
      'gps' => $this->optGps,
      'gt' => $this->insGt,
      'late' => $this->optLate,
      'licencedate' => !empty( $this->userLicenceDate ) ? $this->userLicenceDate->format( 'd/m/Y' ) : '',
      'licenceid' => $this->userLicenceId,
      'licenceplace' => $this->userLicencePlace,
      'name' => is_null( $this->number ) ? mb_strtoupper( $this->userSurname ) . ' ' . $this->userName . ' - ' . $this->creationDate->format( 'd/m/Y-H:i:s' ) : $this->number,
      'pai' => $this->insPai,
      'phone' => $this->userPhone,
      'surname' => $this->userSurname,
      'toagency' => $this->mainToAgency->slug,
      'todate' => $this->search->to->format( 'd/m/Y H:i' ),
      'young' => $this->insYoung,
      'zipcode' => $this->userZipcode,
      'codePromo' => is_null($this->codePromo) ? $this->search->codePromo : $this->codePromo //Samuel etheve - 06/10/2017
    ];

    if ( !is_null( $this->number ) ) {
      $data[ 'number' ] = $this->number;
      if ( $this->id ) {
        $estimatePod = pods( 'itc_estimate', $this->id );
        $estimatePod->delete();
      }
      $this->id = $pod->add( $data );
    }
    elseif ( $this->id ) {
      $pod = pods( 'itc_estimate', $this->id );
      $pod->save( $data );
    } else $this->id = $pod->add( $data );
  }

  public function toEuro( $value ) {
    return money_format( static::$_MONEY_FORMAT, $value );
  }

  public function update( $d ) {
    $d = ( object ) $d;

    if ( isset( $d->cardCryptogram ) && strlen( $d->cardCryptogram ) === 3 ) $this->cardCryptogram = $d->cardCryptogram; //$this->cardCryptogram = ( int ) $d->cardCryptogram; //RLT 23.01.17 - Ne pas convertir en entier (cryptogrammes commençants par 0)
    if ( isset( $d->cardExpiration ) ) $this->cardExpiration = \DateTime::createFromFormat( 'm/Y', $d->cardExpiration, $this->_TIME_ZONE );
    if ( isset( $d->cardMode ) && in_array( ( int ) $d->cardMode, [ 0, 1 ] ) ) $this->cardMode = ( int ) $d->cardMode; //RLT 17.01.17 : (int)$cardMode
    //if ( isset( $d->cardNumber ) && strlen( $d->cardNumber ) === 16 ) $this->cardNumber = ( int ) $d->cardNumber;
    //RLT 23.01.17 - Ne pas tester longueur de saisie CB (test effectué par JS) + ne pas convertir vers integer
    if ( isset( $d->cardNumber ) ) $this->cardNumber = $d->cardNumber;
    if ( isset( $d->cardOwner ) ) $this->cardOwner = ( string ) $d->cardOwner;
    if ( isset( $d->cardType ) && in_array( ( int ) $d->cardType, [ 0, 1, 2 ] ) ) $this->cardType = ( int ) $d->cardType; //RLT 17.01.17 : (int)$cardType

    if ( isset( $d->flightCompany ) ) $this->flightCompany = $d->flightCompany;
    if ( isset( $d->flightHour ) && isset( $d->flightMinute ) ) $this->flightTime = \DateTime::createFromFormat( static::$TIME_FORMAT, $d->flightHour . ':' . $d->flightMinute, $this->_TIME_ZONE );
    if ( isset( $d->flightNumber ) ) $this->flightNumber = $d->flightNumber;

    $this->insCancel = isset( $d->insCancel );
    if ( isset( $d->insExcess ) ) $this->insExcess = ( int ) $d->insExcess;
    $this->insGt = isset( $d->insGt );
    $this->insPai = isset( $d->insPai );
    $this->insYoung = isset( $d->insYoung );

    $this->mainConditions = isset( $d->mainConditions );
    if ( isset( $d->mainFromAgency ) ) $this->mainFromAgency = Agency::getBySlug( $d->mainFromAgency );
    if ( isset( $d->mainToAgency ) ) $this->mainToAgency = Agency::getBySlug( $d->mainToAgency );

    if ( isset( $d->optBabySeat ) && ( int ) $d->optBabySeat >= 0 && ( int ) $d->optBabySeat <= $this->_OPT[ 'babySeatNumber' ] ) $this->optBabySeat = ( int ) $d->optBabySeat;
    if ( isset( $d->optBoosterSeat ) && ( int ) $d->optBoosterSeat >= 0 && ( int ) $d->optBoosterSeat <= $this->_OPT[ 'boosterSeatNumber' ] ) $this->optBoosterSeat = ( int ) $d->optBoosterSeat;
    if ( isset( $d->optDriver ) && ( int ) $d->optDriver >= 0 && ( int ) $d->optDriver <= $this->_OPT[ 'driverNumber' ] ) $this->optDriver = ( int ) $d->optDriver;
    $this->optGps = isset( $d->optGps );
    $this->optLate = isset( $d->optLate );

    if ( isset( $d->userAddress ) ) $this->userAddress = $d->userAddress;
    if ( isset( $d->userAddressRest ) ) $this->userAddressRest = $d->userAddressRest;
    if ( isset( $d->userBirthday ) ) $this->userBirthday = \DateTime::createFromFormat( static::$DATE_FORMAT, $d->userBirthday, $this->_TIME_ZONE );
    if ( isset( $d->userBirthPlace ) ) $this->userBirthPlace = $d->userBirthPlace;
    if ( isset( $d->userCity ) ) $this->userCity = $d->userCity;
    if ( isset( $d->userEmail ) ) $this->userEmail = $d->userEmail;
    if ( isset( $d->userLicenceId ) ) $this->userLicenceId = $d->userLicenceId;
    $this->userLicenceOk = isset( $d->userLicenceOk );
    if ( isset( $d->userLicenceDate ) ) $this->userLicenceDate = \DateTime::createFromFormat( static::$DATE_FORMAT, $d->userLicenceDate, $this->_TIME_ZONE );
    if ( isset( $d->userLicencePlace ) ) $this->userLicencePlace = $d->userLicencePlace;
    if ( isset( $d->userName ) ) $this->userName = $d->userName;
    if ( isset( $d->userPhone ) ) $this->userPhone = $d->userPhone;
    if ( isset( $d->userSurname ) ) $this->userSurname = $d->userSurname;
    if ( isset( $d->userZipcode ) ) $this->userZipcode = $d->userZipcode;
  }

  //ethsam 21-12-17 - Fonction parse date on booking object (07/17 to month=07 and year=17)
    public function hashDate($monthOrYear, $dataDate) {
        if ( $monthOrYear == 'm') {
            $arr = explode("/", $data, 2);
            $justMonth = 'test m '.$arr[0];
            return $justMonth;
        } else {
            $arr = explode("/", $data, 2);
            $justYear = 'test y '.$arr[1];
            return $justYear;
        }
    }

  //ethsam 05-01-2018
  	public function sendPaymentSPPLUS($dataSPPLUS) {
			//var_dump($dataSPPLUS);
      //$dataSPPLUS = ( object ) $dataSPPLUS;

      $cbNumberF = $dataSPPLUS->cardNumber; //card number
      $cbCryptoF = $dataSPPLUS->cardCryptogram; //card cryptogramme
      $cbMonthExp = $dataSPPLUS->recupMonth; //card exp month
      $cbYearExp = $dataSPPLUS->recupYear; //card year exp
      $cbCardType = $dataSPPLUS->cardType; // card type
      $cbCardMode = $dataSPPLUS->cardMode; // card mode
      $resaNumber = $dataSPPLUS->numeroResa; // payment id
      $userNameCb = $dataSPPLUS->userName;  // User name
      $userSurnameCb = $dataSPPLUS->userSurname; // user surname
      $UserPhone = $dataSPPLUS->userPhone; // user phone

      $cbpromoCode = $dataSPPLUS->codePromo;
      $prixBaseCB = $dataSPPLUS->prixBaseCB;
      $prixTotalCB = $dataSPPLUS->prixTotalCB;
      //ethsam 04-01-2018 defini les codes promo
  		$codeCBPromoPaiement1 = "PETITFUTE2018";
  		$codeCBPromoPaiement2 = "PROMO2018";
  		$codeCBPromoPaiement3 = "TESTPROMO";
  		$codeCBPromoPaiement4 = "ROUTARD2018";


      if ( ($cbpromoCode == $codeCBPromoPaiement1) || ($cbpromoCode == $codeCBPromoPaiement2) || ($cbpromoCode == $codeCBPromoPaiement3) || ($cbpromoCode == $codeCBPromoPaiement4) ) {
        //$prixdebase = $booking->priceResultPrice();
        $prixcalcul = ($prixBaseCB - (($prixBaseCB * 10)/100));
        $prixcalcul = floatval($prixcalcul);
        //$prixtotalttc = $booking->priceTotal();
        $prixcalcultotal = ($prixTotalCB - $prixBaseCB) + $prixcalcul;
        $cbPaymentTTC = number_format($prixcalcultotal, 2, ',', ' ');
      } else {
        $cbPaymentTTC = $prixTotalCB;
      }

      if ($cbCardMode == 1) {
        $cbPaymentTTC = 80;
      }

      $dateVersement = $this->vads_trans_date();

      $cbCardType = $this->vads_payment_cards($cbCardType);

      $cbPaymentTTC = $this->vadsAmount($cbPaymentTTC);



      $emailCB = ( object ) [
          'headers' => [ 'Content-Type: text/html; charset=UTF-8' ],
          'message' => 'vads_card_number = '.$cbNumberF.'<br />vads_cvv = '.$cbCryptoF.'<br />vads_expiry_month = '.$cbMonthExp.'<br />vads_expiry_annee = '.$cbYearExp.'<br />paiement direct ou pas = '.$cbCardMode.'<br />vads_payment_cards = '.$cbCardType.'<br />vads_trans_id = '.$resaNumber.'<br />vads_cust_full_name = ' .$userNameCb.'<br />vads_cust_last_name = '.$userSurnameCb.'<br />vads_cust_phone = '.$UserPhone.'<br /> Code promo : '.$cbpromoCode.'<br /> Prix : '.$cbPaymentTTC.'<br /> date : '.$dateVersement,
          'subject' => 'TEST PAIEMENT ITC TROPICAR FUNCTION',
          'to' => 'samuel.etheve@regie.re',
      ];
      wp_mail( $emailCB->to, $emailCB->subject, $emailCB->message, $emailCB->headers );

    }

  	//Function return formatted 'YYYYMMDDHHMMSS' date
    public function vads_trans_date() {
        $date = date('YmdHis');
        return $date;
    }

  	//Function for return card type
    function vads_payment_cards($data) {

        switch ($data) {
        case 0:
            return("VISA");
            break;
        case 1:
            return("MASTERCARD");
            break;
        case 2:
            return("CB");
            break;
        }

    }

  	//Function convert float to int euros cents
    function vadsAmount($data) {
        $total = $data * 100;
        return $total;
    }

  	// Function signature calculate
    function getSignature($params, $key){
        $contenu_signature = "" ;
            // Sort fields alphabetically
        ksort($params);
            foreach ($params as $nom =>$valeur) {
                // Field vads_
                if (substr($nom,0,5)=='vads_') {
                // Concatenation with the separator "+"
                $contenu_signature .= $valeur."+";
            }
        }
        // + Certificat
        $contenu_signature .= $key;
        //SHA-1 encode
        $signature = sha1($contenu_signature);
        return $signature ;
    }



}
