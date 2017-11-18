<?php
include_once("../database/db.php");
include_once("../fpdf/fpdf.php");

if (isset($_GET["o_date"]) && $_SESSION["user_id"]) {

	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->SetFont("Arial","B",16);
	$pdf->Cell(190,10,"Inventory System",0,1,"C");

	$pdf->Cell(190,10,"",0,1);

	$pdf->SetFont("Arial",null,12);
	$pdf->Cell(50,5,"Billing Date ",0,0);
	$pdf->Cell(140,5,": ".$_GET["o_date"],0,1);
	$pdf->Cell(50,5,"Customer Name",0,0);
	$pdf->Cell(140,5,": ".$_GET["customer_name"],0,1);

	$pdf->Cell(190,10,"",0,1);



	$pdf->SetFont("Arial","B",14);
	$pdf->Cell(20,10,"#",1,0,"C");
	$pdf->Cell(75,10,"Item Name",1,0,"C");
	$pdf->Cell(25,10,"Quantity",1,0,"C");
	$pdf->Cell(30,10,"Price",1,0,"C");
	$pdf->Cell(40,10,"Total",1,1,"C");


	$pdf->SetFont("Arial",null,12);


	//Product Array Processing
	$pro_name = $_GET["pro_name"]; 
	$price = $_GET["price"];
	$qty = $_GET["qty"];
	for ($i=0; $i < count($pro_name) ; $i++) { 
		$pdf->Cell(20,10,$i,1,0,"C");
		$pdf->Cell(75,10,$pro_name[$i],1,0,"C");
		$pdf->Cell(25,10,$qty[$i],1,0,"C");
		$pdf->Cell(30,10,"Rs. ".$price[$i],1,0,"C");
		$pdf->Cell(40,10,"Rs. ".($qty[$i]*$price[$i]),1,1,"C");
	}

	

	$pdf->Cell(190,10,"",0,1);

	$pdf->SetFont("Arial",null,12);
	$pdf->Cell(50,5,"Sub Total",0,0);
	$pdf->Cell(140,5,": Rs. ".$_GET["sub_total"],0,1);
	$pdf->Cell(50,5,"GST tax",0,0);
	$pdf->Cell(140,5,": Rs.".$_GET["gst"],0,1);
	$pdf->Cell(50,5,"Discount",0,0);
	$pdf->Cell(140,5,": Rs. ".$_GET["discount"],0,1);
	$pdf->Cell(50,5,"Net Total",0,0);
	$pdf->Cell(140,5,": Rs. ".$_GET["net_total"],0,1);
	$pdf->Cell(50,5,"Paid",0,0);
	$pdf->Cell(140,5,": Rs. ".$_GET["paid"],0,1);
	$pdf->Cell(50,5,"Due",0,0);
	$pdf->Cell(140,5,": Rs. ".$_GET["due"],0,1);
	$pdf->Cell(50,5,"Payment Method",0,0);
	$pdf->Cell(140,5,": ".$_GET["payment_type"],0,1);

	$pdf->Cell(190,20,"",0,1);

	$pdf->Cell(150,10,"",0,0);
	$pdf->Cell(40,10,"Signature",0,1);




	$pdf->Output("../pdf_invoice/PDF_INVOICE_".$_SESSION["invoice_no"].".pdf","F");

	$pdf->Output();

}


?>

