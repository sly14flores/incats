<?php

require('../fpdf181/fpdf.php');
require('../db.php');

$con = new pdo_db();

$title = "";
$scholarship_type = "";
if ($_GET['description'] == "Scholarship") {
	
	switch($_GET['module_select']) {
		
		case "New Applicants":
			$title = "List of New Scholarship Applicants for SY: $_GET[school_year]";
			$scholarship_type = "'New'";
		break;
		
		case "Renewal":
			$title = "List of Scholarship Renewal for SY: $_GET[school_year]";
			$scholarship_type = "'Renewal'";
		break;
		
		case "Grantees":
			$title = "List of Scholars for SY: $_GET[school_year]";
			$scholarship_type = "'New','Renewal'";			
		break;
		
	}
	
} else {
	switch($_GET['module_select']) {
		
		case "PT":
			$title = "Results of Personality Test for SY: $_GET[school_year]";
		break;
		
		case "CAT":
			$title = "Results of College Aptitude Test for SY: $_GET[school_year]";
		break;
		
	}
}
// $_GET['module_select'];
// $_GET['school_year'];

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../images/logo.png',95,6,19);
  

    // Arial bold 15
    $this->SetFont('Arial','',9);
    $this->Ln(15);
    $this->Cell(0,4,'Don Mariano Marcos Memorial State University',0,1,'C');
    $this->Cell(0,4,'North La Union Campus',0,1,'C');
    $this->Cell(0,4,'Sapilang, Bacnotan',0,1,'C');
    $this->Cell(0,4,'La Union 2500',0,1,'C');
    $this->Ln(5);
    $this->SetFont('Arial','B',9);	
    $this->Cell(0,4,'Integrated Campus Testing & Scholarship System',0,1,'C');
    $this->Ln(5);	
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function Scholarship($header, $data)
{
	$semester = array(1=>"First",2=>"Second");
    $this->Ln(2);	
    // Colors, line width and bold font
    $this->SetFillColor(106,168,65);
    $this->SetTextColor(34,73,8);
    $this->SetDrawColor(68,114,37);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(22, 40, 40, 43, 43);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(65,68,64);
	$this->SetFont('Arial','',8);
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row['student_id'],'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row['full_name'],'LR',0,'C',$fill);
        $this->Cell($w[2],6,$row['course'],'LR',0,'C',$fill);
        $this->Cell($w[3],6,$row['college'],'LR',0,'C',$fill);
        $this->Cell($w[4],6,$semester[$row['semester']],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');


 $this->SetFont('Arial','',9);
    $this->Ln(15);
    $this->Cell(0,4,'',0,1,'R');
    $this->Cell(0,4,'',0,1,'R');

    $this->Ln(5);   

     // Signature Part
    $this->SetFont('Arial','',9);
    $this->Ln(15);
    $this->Cell(0,4,'DR. VALOREE B. SALAMANCA',0,1,'R');
    $this->Cell(0,4,'_________________________',0,1,'R');
    $this->Cell(0,4,'Guidance Coordinator II',0,1,'R');
    $this->Ln(5);   
}

function Testing($header, $data)
{
	$tests = array("PT"=>"Personality Test","CAT"=>"College Aptitude Test");
    $this->Ln(2);	
    // Colors, line width and bold font
    $this->SetFillColor(106,168,65);
    $this->SetTextColor(34,73,8);
    $this->SetDrawColor(68,114,37);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(30, 50, 60, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(65,68,64);
	$this->SetFont('Arial','',8);
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row['student_id'],'LR',0,'C',$fill);
        $this->Cell($w[1],6,$row['full_name'],'LR',0,'C',$fill);
        $this->Cell($w[2],6,$tests[$row['testing_type']],'LR',0,'C',$fill);
        $this->Cell($w[3],6,$row['rating'],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');

 // Signature Part
    $this->SetFont('Arial','',9);
    $this->Ln(15);
     $this->Cell(0,4,'DR. Valoree B. Salamanca',0,1,'C');
    $this->Cell(0,4,'',0,1,'C');
    $this->Cell(0,4,'Guidance Coordinator II',0,1,'C');
    $this->Ln(5);   


}


}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,"$title",0,1,'C');

if ($_GET['description'] == "Scholarship") {
	$header = array("Student ID","Fullname","Course","College","Semester");
	$sql = "SELECT accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.course, scholarships.college, scholarships.semester FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type IN ($scholarship_type) AND account_type != 'Administrator' AND scholarships.status IN ('Approved') AND scholarships.school_year = '$_GET[school_year]'";
	$data = $con->getData($sql);
	$pdf->Scholarship($header,$data);
} else {
	$header = array("Student ID","Fullname","Description","Overall Rating");
	$sql = "SELECT accounts.student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, testing_results.testing_type, testing_results.rating FROM testing_results LEFT JOIN accounts ON testing_results.scholar_id = accounts.id WHERE testing_results.testing_type = '$_GET[module_select]'";
	$data = $con->getData($sql);	
	$pdf->Testing($header,$data);
}

$pdf->Output();

?>