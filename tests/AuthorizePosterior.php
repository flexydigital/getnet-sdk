<?php
namespace Getnet\API;
/**
 * Created by PhpStorm.
 * User: brunopaz
 * Date: 09/07/2018
 * Time: 02:41
 */
include "../vendor/autoload.php";

$clientId = "4640b620-0aa0-4c1e-8178-65c2402b3e28";
$clientSecret = "41b7d35f-3f99-44b3-88b5-fc83bddf5765";
$customerId = "customer_" . mt_rand(100000000, 900000000);

$getnet = new Getnet($clientId, $clientSecret);
$transaction = (new Transaction()) 
    ->setSellerId("e7d3cb58-3688-40cb-8cd0-0b8903e8c91f")
    ->setAmount("1000");

$card = new Token("5155901222280001", $customerId, $getnet);
$transaction->Credit("")
    ->setAuthenticated(false)
    ->setDynamicMcc("1799")
    ->setSoftDescriptor("LOJA*TESTE*COMPRA-123")
    ->setDelayed(true)
    ->setPreAuthorization(false)
    ->setNumberInstallments(2)
    ->setSaveCardData(false)
    ->setTransactionType(Transaction::TRANSACTION_TYPE_INSTALL_NO_INTEREST);

$transaction->getCredit()
    ->Card($card)
    ->setBrand("MasterCard")
    ->setExpirationMonth("12")
    ->setExpirationYear("20")
    ->setCardholderName("Bruno Paz")
    ->setSecurityCode(123);

$transaction->Customer($customerId)
    ->setDocumentType("CPF")
    ->setEmail("customer@email.com.br")
    ->setFirstName("Bruno")
    ->setLastName("Paz")
    ->setName("Bruno Paz")
    ->setPhoneNumber("5551999887766")
    ->setDocumentNumber("12345678912")
    ->BillingAddress("90230060")
    ->setCity("São Paulo")
    ->setComplement("Sala 1")
    ->setCountry("Brasil")
    ->setDistrict("Centro")
    ->setNumber("1000")
    ->setPostalCode("90230060")
    ->setState("SP")
    ->setStreet("Av. Brasil");

$orderItem = (new OrderItem())
    ->setAmount(1000)
    ->setId(mt_rand())
    ->setDescription("Product")
    ->setTaxPercent(10);

$transaction->MarketplaceSubsellerPayments()
    ->setSubsellerId(mt_rand())
    ->addOrderItem($orderItem)
    ->setSubsellerSalesAmount(1000);

$transaction->Shippings("")
    ->setEmail("customer@email.com.br")
    ->setFirstName("João")
    ->setName("João da Silva")
    ->setPhoneNumber("5551999887766")
    ->ShippingAddress("90230060")
    ->setCity("Porto Alegre")
    ->setComplement("Sala 1")
    ->setCountry("Brasil")
    ->setDistrict("São Geraldo")
    ->setNumber("1000")
    ->setPostalCode("90230060")
    ->setState("RS")
    ->setStreet("Av. Brasil");

$transaction->Order(mt_rand(100000000, 900000000))
    ->setProductType("service")
    ->setSalesTax("0");

$transaction->Device(md5(uniqid(mt_rand(), true)))
    ->setIpAddress("127.0.0.1");

echo "<pre>";
echo "Transaction" . "<br>";
echo json_encode($transaction, JSON_PRETTY_PRINT);
echo "<hr>";

$response = $getnet->Authorize($transaction);
echo "Response" . "<br>";
var_dump($response);
echo "<hr>";

echo "Response status" . "<br>";
var_dump($response->getStatus());
echo "<hr>";

echo "Capture" . "<br>";
$capture = $getnet->AuthorizeConfirm($response->getPaymentId());
print_r($capture->getStatus() . "\n");
echo "<hr>";

echo "Cancel status" . "<br>";
$capture = $getnet->AuthorizeCancel($response->getPaymentId(), $response->getAmount());
print_r($capture->getStatus() . "\n");
echo "<hr>";

echo "</pre>";
