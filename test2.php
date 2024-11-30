<?php
// ini_set('memory_limit', '512M');
// composer require mpdf/mpdf
require_once __DIR__ . '/mpdf/vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
// require_once 'modules/AOS_PDF_Templates/PDF_Lib/mpdf.php';
// require_once 'modules/AOS_PDF_Templates/templateParser.php';
// require_once 'modules/AOS_PDF_Templates/AOS_PDF_Templates.php';
// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Initialize cURL
    $curl = curl_init();
    
    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ists.equifax.co.in/creditreportws/CreditReportWSInquiry/v1.0?wsdl',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://services.equifax.com/eport/ws/schemas/1.0">
    <soapenv:Header/>
    <soapenv:Body>
        <InquiryRequest xmlns="http://services.equifax.com/eport/ws/schemas/1.0">
                <ns:RequestHeader>
                <ns:CustomerId>7075</ns:CustomerId>
                <ns:UserId>STS_SRICCR</ns:UserId>
                <ns:Password>W3#QeicsB</ns:Password>
                <ns:MemberNumber>022FZ00169</ns:MemberNumber>
                <ns:SecurityCode>5OS</ns:SecurityCode>
                <ns:ProductCode>CCR</ns:ProductCode>
                <ns:ProductVersion>4.6</ns:ProductVersion>
                <ns:ReportFormat>XML</ns:ReportFormat>
                <ns:CustRefField/>
            </ns:RequestHeader>
            <ns:RequestAccountDetails seq="1">
                <ns:BranchIDMFI>J7:03</ns:BranchIDMFI>
            </ns:RequestAccountDetails>
            <ns:RequestBody>
            <ns:InquiryPurpose>00</ns:InquiryPurpose>
            <ns:FullName>AKASH PATEL</ns:FullName>
            <ns:FirstName>AKASH</ns:FirstName>
            <ns:MiddleName></ns:MiddleName>
            <ns:LastName>PATEL</ns:LastName>
            // <ns:FamilyDetails>
            //     <ns:AdditionalNameInfo>
            //         <ns:AdditionalName>JOHN SMITH</ns:AdditionalName>
            //         <ns:AdditionalNameType>K01</ns:AdditionalNameType>
            //     </ns:AdditionalNameInfo>
            // </ns:FamilyDetails>
            <ns:AddrLine1>HOUSE NO 22, Village Pikripali, POST TAUSIR</ns:AddrLine1>
            <ns:State>CG</ns:State>
            <ns:Postal>496551</ns:Postal>
            <ns:DOB>1999-09-20</ns:DOB>
            <ns:Gender>M</ns:Gender>
            <ns:NationalIdCard></ns:NationalIdCard>
            <ns:PassportID></ns:PassportID>
            <ns:DriverLicence></ns:DriverLicence>
            <ns:VoterID></ns:VoterID>
            <ns:PANId>HGGPP2963C</ns:PANId>
            <ns:RationCard></ns:RationCard>
            <ns:MobilePhone>7828676830</ns:MobilePhone>
            <ns:RequestAccountDetails/>
            <ns:InquiryCommonAccountDetails>
                <ns:InquiryAccount/>
            </ns:InquiryCommonAccountDetails>
            </ns:RequestBody>
        </InquiryRequest>
    </soapenv:Body>
</soapenv:Envelope>',
        CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    ));

    // Execute the cURL request
    $response = curl_exec($curl);
    
    // Check for cURL errors
    if (curl_errno($curl)) {
        echo 'Curl error: ' . curl_error($curl);
    } else {
        curl_close($curl);
        $startPos = strpos($response, '<html>');
        $endPos = strpos($response, '</html>');
        $htmlContent = substr($response, $startPos, $endPos - $startPos + strlen('</html>'));
        //  echo $newString;

        $tmpfname = __DIR__ . "/" . "STEVE_SMITH" . ".html";
        $handle = fopen($tmpfname, 'w+');
        fwrite($handle, $htmlContent);
        fclose($handle);
            

    }
}
?>
