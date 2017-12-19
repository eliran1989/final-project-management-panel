

<?php
    
require_once("View.php"); 

class ReportsView extends View
{

 public function __construct() {
	

 }
	


public function getNavbar()
{
  include ("views/reports/navbar.phtml");
}

public function getMain()
{
    include_once("views/reports/reports.phtml");
}


public function showReport($reportNumber)
{

       switch ($reportNumber) {
            case 1:  // Subscriptions by date of registration
            $category="מנויים";
            $catPath="shared";
            $reportName="מנויים לפי תאריך רישום";
            $method="subsByDateOfReg";
            $reportType="reportByDate";
            break;

            case 2:  // Subscriptions by date of end sub
            $category="מנויים";
            $catPath="shared";
            $reportName="מנויים לפי תאריך סיום מנוי";
            $method="subsByDateOfEndSub";
            $reportType="reportByDate";
            break;

            case 3:  // Ages Breakdown
            $category="מנויים";
            $catPath="subs";
            $reportName="התפלגות גילאים";
            $reportType="ageBreakdown";
            break;

            case 4:  // sex Breakdown
            $category="מנויים";
            $catPath="subs";
            $reportName="התלפגות מגדרית";
            $reportType="sexBreakdown";
            break;

            case 5:  
            $category="סטודיו";
            $catPath="studios";
            $reportName="דוח כללי";
            $reportType="allStudiosReport";
            break;

            case 6:  
            $category="סטודיו";
            $catPath="studios";
            $reportName="דוח לשיעור ספציפי";
            $reportType="lessonReport";
            break;



        default:


		}


          include ("views/reports/".$catPath."/".$reportType.".phtml");


}



public function allStudiosReport($studio){

            $category="סטודיו";
            $catPath="studios";
            $reportName="דוח כללי";
            $reportType="allStudiosReport";



          include ("views/reports/".$catPath."/".$reportType.".phtml");


}



public function reportsSubsMain()
{
   include("views/reports/subs/reportsSubs.phtml");
}


public function reportsStudioMain()
{

   include("views/reports/studios/reportsStudios.phtml");
}




}




?>