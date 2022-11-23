<!DOCTYPE html>
<html>
<head>
  <title>s p o v</title>
  <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="/style/form.css"> 
   <link rel="stylesheet" type="text/css" href="/style/table_edit.css">

</head>

<script type="text/javascript" src="/js/my_script.js"></script>
<script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>



<?php
  include('../includes/header.php');
  include('../includes/role_etk.php');
?>


<link rel="stylesheet" href="/style/bootstrap-multiselect.css" type="text/css"/>

<?php


  if ($_POST['year'])
  {
    $year=$_POST['year'];
  }
  else{
  $year=date("Y");
  }

  if ($year==2000) {$year_fin=3000;} else {$year_fin=$year+1;}


?>

<div class="body_new">

<div>
   <form method ="POST" action ="/includes/form_etk_monitoring.php">

    <table id="table" style="margin-top: 10px;">
      <tr>
        <td>
          <select name="year">
            <?php
          if ($year==2000)
         {  echo "<option value=2000 selected>Весь період</option>"; }
        else {  echo "<option value=2000>Весь період</option>"; }



        $result_year = mysqli_query($connection,"SELECT DISTINCT YEAR(etk_datecreated) AS year FROM `etk` ORDER BY `etk_datecreated`");
        while ($cat_year = mysqli_fetch_assoc($result_year))
        {
          
          if ($year==$cat_year['year'])
         { echo "<option value=".$cat_year['year']." selected>".$cat_year['year']."</option>"; }
        else 
          { echo "<option value=".$cat_year['year'].">".$cat_year['year']."</option>"; }     


            }
           
           


        ?>



          </select>


        </td>
         <td><button type="submit" name="submit" class="btn btn-sm btn-info ">Фільтрувати</button></td>
     </tr>
  </form>
</div>

<table id="table" class="">
      
      <tr>
        <th rowspan="5" >Регіон</th>
        <th rowspan="1" colspan="8">Інформація про отримані дані з підистеми "Звернення" за вибраний період</th>
        <th rowspan="1" colspan="14"></th>
      </tr>
      <tr>
        <th style="max-width: 100px" rowspan="4">Надійшло звернень ЕТК Всього</th>
        <th rowspan="4">Із них унікальних</th>
        <th colspan="5">в т.ч. зі статусами</th>
        <th style="max-width: 100px" rowspan="4">% Виконання гр.7/(гр.2-гр.5-гр.8)</th>
        <th colspan="14">Претенденти на призначення в автоматичному режимі</th>
        
      </tr>
      <tr>
        <th rowspan="3">для виконання</th>
        <th rowspan="3">відхилено</th>
        <th rowspan="3">в роботі</th>
        <th rowspan="3">виконано</th>
        <th rowspan="3">скасовано</th>
        <th rowspan="3">Кількість РД</th>
        <th rowspan="3">К-сть КУП</th>
        <th rowspan="2" colspan="12">в т. ч. кількість претендентів</th>
        
      </tr>
      <tr>
        
      </tr>

      <tr style="color:#8c8c8c">
       <?php
       $k=1;
       while ($k<=12)
        { echo "<td>міс.".$k."</td>" ;
        $k++;}
       ?>      
      
       </tr>
        

     <tr style="color:#8c8c8c">
       <?php
       $k=1;
       while ($k<=23)
        {echo "<td>".$k."</td>" ;
        $k++;}
       ?>      
      
       </tr>
        
       <?php

       $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."' ");  
          $r2 = mysqli_fetch_assoc($result);

         $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `etk_rnokpp`,`etk_passport`) AS `total_count` FROM `etk` WHERE YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
          $r3 = mysqli_fetch_assoc($result);
        
         $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE `etk_status` = 'для виконання' AND  YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
          $r4 = mysqli_fetch_assoc($result);

        $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE `etk_status` = 'відхилено' AND  YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
          $r5 = mysqli_fetch_assoc($result);
        
         $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE `etk_status` = 'в роботі' AND  YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
          $r6 = mysqli_fetch_assoc($result);

        $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE `etk_status` = 'виконано' AND  YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
          $r7 = mysqli_fetch_assoc($result);
         
         $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE `etk_status` = 'скасовано виконання' AND  YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
          $r8 = mysqli_fetch_assoc($result);

          $r9=round($r7['total_count']/($r2['total_count']-$r5['total_count']-$r8['total_count'])*100,1);

          
          



          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`,`kup_priority`) AS `total_count` FROM `etk_kup` WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."' ");  
          $r1_0 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=1 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."' ");  
          $r1_06 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=2 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'");  
          $r1_07 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=3 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'");  
          $r1_08 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=4 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_09 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=5 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_10 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=6 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_11 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=7 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_12 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=8 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_13 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=9 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_14 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=10 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_15 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=11 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_16 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(DISTINCT `kup_rnokpp`) AS `total_count` FROM `etk_kup` WHERE `kup_priority`=12 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r1_17 = mysqli_fetch_assoc($result);
        
         

          



          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."' ");  
          $r_1 = mysqli_fetch_assoc($result);

          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=1 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202001_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=2 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202002_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=3 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202003_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=4 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202004_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=5 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202005_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=6 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202006_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=7 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202007_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=8 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202008_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=9 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202009_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=10 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202010_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=11 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202011_1 = mysqli_fetch_assoc($result);
          $result =  mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=12 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202012_1 = mysqli_fetch_assoc($result);
           
       

          


          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."' ");  
          $r_2 = mysqli_fetch_assoc($result);


          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=1 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202001_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=2 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202002_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=3 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202003_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=4 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202004_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=5 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202005_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=6 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202006_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=7 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202007_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=8 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202008_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=9 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202009_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=10 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202010_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=11 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202011_2= mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE (etk.etk_status='виконано' OR etk.etk_status='в роботі' OR etk.etk_status='на контроль ЕТК' OR etk.etk_status='Контроль ЕТК пройдено' OR etk.etk_status='ЕТК на доопрацювання')) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=12 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202012_2= mysqli_fetch_assoc($result);



        

          
          


          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."' ");  
          $r_3 = mysqli_fetch_assoc($result);

          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=1 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202001_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=2 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202002_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=3 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202003_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=4 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202004_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=5 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202005_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=6 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202006_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=7 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202007_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=8 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202008_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=9 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202009_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=10 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202010_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=11 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202011_3 = mysqli_fetch_assoc($result);
          $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_priority`=12 AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
          $r202012_3 = mysqli_fetch_assoc($result);

        

        ?>


      <tr>
       <td>Волинська обл.</td>
       <td><?php echo $r2['total_count']; ?></td>
       <td><?php echo $r3['total_count']; ?></td>
       <td><?php echo $r4['total_count']; ?></td>
       <td><?php echo $r5['total_count']; ?></td>
       <td><?php echo $r6['total_count']; ?></td>
       <td><?php echo $r7['total_count']; ?></td>
       <td><?php echo $r8['total_count']; ?></td>
       <td><?php echo $r9; ?>%</td>
       <td></td>
       <td><?php echo $r1_0['total_count']; ?></td>
       <td><?php echo $r1_06['total_count']; ?></td>
       <td><?php echo $r1_07['total_count']; ?></td>
       <td><?php echo $r1_08['total_count']; ?></td>
       <td><?php echo $r1_09['total_count']; ?></td>
       <td><?php echo $r1_10['total_count']; ?></td>
       <td><?php echo $r1_11['total_count']; ?></td>
       <td><?php echo $r1_12['total_count']; ?></td>
       <td><?php echo $r1_13['total_count']; ?></td>
       <td><?php echo $r1_14['total_count']; ?></td>
       <td><?php echo $r1_15['total_count']; ?></td>
       <td><?php echo $r1_16['total_count']; ?></td>
       <td><?php echo $r1_17['total_count']; ?></td>
      
     
       
       

      
      </tr>
   </table>


<!------------------------------------------------>

    <table id="table" class="" style="margin-top: 20px">
      <tr>
        <th colspan="39">Стан опрацювання списків (унікальні) за вибраний період</th>
      </tr>
      <tr>
        <th colspan="15">Кількість отриманих скан-копій ТК</th>
        <th colspan="15">З них оцифрованих</th>
        <th colspan="15">ВИКОНАНО</th>
      </tr>
     <tr>
        <th rowspan="2">Всього</th>
        <th colspan="12">в т.ч.</th>
        <th rowspan="2">Всього</th>
        <th colspan="12">в т.ч.</th>
        <th rowspan="2">Всього</th>
        <th colspan="12">в т.ч.</th>
      </tr>
       <tr>
       <?php 
        $kk=1;

        while ($kk<=3)
        {

        $k=1;
       while ($k<=12)
        { echo "<td>міс.".$k."</td>" ;
        $k++;}
         $kk++;
       }
        ?>

      </tr>

      <tr>
       <td><?php echo $r_1['total_count']; ?></td>
       <td><?php echo $r202001_1['total_count']; ?></td>
       <td><?php echo $r202002_1['total_count']; ?></td>
       <td><?php echo $r202003_1['total_count']; ?></td>
       <td><?php echo $r202004_1['total_count']; ?></td>
       <td><?php echo $r202005_1['total_count']; ?></td>
       <td><?php echo $r202006_1['total_count']; ?></td>
       <td><?php echo $r202007_1['total_count']; ?></td>
       <td><?php echo $r202008_1['total_count']; ?></td>
       <td><?php echo $r202009_1['total_count']; ?></td>
       <td><?php echo $r202010_1['total_count']; ?></td>
       <td><?php echo $r202011_1['total_count']; ?></td>
       <td><?php echo $r202012_1['total_count']; ?></td>

     
       <td><?php echo $r_2['total_count']; ?></td>
       <td><?php echo $r202001_2['total_count']; ?></td>
       <td><?php echo $r202002_2['total_count']; ?></td>
       <td><?php echo $r202003_2['total_count']; ?></td>
       <td><?php echo $r202004_2['total_count']; ?></td>
       <td><?php echo $r202005_2['total_count']; ?></td>
       <td><?php echo $r202006_2['total_count']; ?></td>
       <td><?php echo $r202007_2['total_count']; ?></td>
       <td><?php echo $r202008_2['total_count']; ?></td>
       <td><?php echo $r202009_2['total_count']; ?></td>
       <td><?php echo $r202010_2['total_count']; ?></td>
       <td><?php echo $r202011_2['total_count']; ?></td>
       <td><?php echo $r202012_2['total_count']; ?></td>
       
       <td><?php echo $r_3['total_count']; ?></td>
       <td><?php echo $r202001_3['total_count']; ?></td>
       <td><?php echo $r202002_3['total_count']; ?></td>
       <td><?php echo $r202003_3['total_count']; ?></td>
       <td><?php echo $r202004_3['total_count']; ?></td>
       <td><?php echo $r202005_3['total_count']; ?></td>
       <td><?php echo $r202006_3['total_count']; ?></td>
       <td><?php echo $r202007_3['total_count']; ?></td>
       <td><?php echo $r202008_3['total_count']; ?></td>
       <td><?php echo $r202009_3['total_count']; ?></td>
       <td><?php echo $r202010_3['total_count']; ?></td>
       <td><?php echo $r202011_3['total_count']; ?></td>
       <td><?php echo $r202012_3['total_count']; ?></td>
       
      </tr>


  </table> 

<!------------------------------------------------>


  <table id="table" class="" style="margin-top: 20px">
      <tr>
        <th>Всього за <br> <?php echo  $year; ?> рік</th>
       <?php
        $result_statuses = mysqli_query($connection,"SELECT DISTINCT `etk_status` FROM `etk` WHERE YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."' ORDER BY  `etk_status`");
        while ($cat_statuses = mysqli_fetch_assoc($result_statuses))
        {
          echo '<th style="max-width:120px;">'.$cat_statuses['etk_status']."</th>";
        }
       ?>  
      </tr>

       
        <?php

         $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'");  
         $r = mysqli_fetch_assoc($result);
         echo '<td>'.$r['total_count']."</td>";

        $result_statuses = mysqli_query($connection,"SELECT DISTINCT `etk_status` FROM `etk` WHERE YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."'  ORDER BY  `etk_status` ");
        while ($cat_statuses = mysqli_fetch_assoc($result_statuses))
        {
           $result = mysqli_query($connection,"SELECT COUNT(`etk_id`) AS `total_count` FROM `etk` WHERE `etk_status` = '".$cat_statuses['etk_status']."' AND YEAR(etk_datecreated)>='".$year."' AND YEAR(etk_datecreated)<'".$year_fin."' ");  
              $r = mysqli_fetch_assoc($result);
          
              
          echo '<td>'.$r['total_count']."</td>";
          
        }

        ?>



  </table>




  <table id="table" class="" style="margin-top: 20px">
      <tr>
        <th style="max-width: 90px">район ПФУ</th>
        <th style="max-width: 90px">кількість звернень ЕТК по КУП</th>
        <th style="max-width: 90px">для виконання</th>
        <th style="max-width: 90px">в роботі</th>
        <th style="max-width: 90px">виконано</th>
        <th style="max-width: 90px">відхилено, скасовано виконання</th>
        <th style="max-width: 90px">кількість КУП з ЕЦП</th>
      </tr>
      
    
       <?php
        $result_region = mysqli_query($connection,"SELECT DISTINCT `kup_pfu` FROM `etk_kup` ORDER BY  `kup_pfu`");
        while ($cat_region = mysqli_fetch_assoc($result_region))
        {
          ?>
          <tr>
            <th><?php echo $cat_region['kup_pfu']; ?></th>

            <?php
          
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."' AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r1 = mysqli_fetch_assoc($result);

            
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='для виконання') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."' AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r2 = mysqli_fetch_assoc($result);

           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='в роботі') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."' AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r3 = mysqli_fetch_assoc($result);
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."' AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r4 = mysqli_fetch_assoc($result);
           
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='відхилено') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."'  AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $result1 = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='скасовано виконання') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."' AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r51 = mysqli_fetch_assoc($result);
           $r52 = mysqli_fetch_assoc($result1);
           $r5= $r51['total_count']+$r52['total_count'];

           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_ecp='Так') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_pfu`='".$cat_region['kup_pfu']."' AND `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r6 = mysqli_fetch_assoc($result);
           

            ?>

            <td><?php echo $r1['total_count']; ?></td>
            <td><?php echo $r2['total_count']; ?></td>
            <td><?php echo $r3['total_count']; ?></td>
            <td><?php echo $r4['total_count']; ?></td>
            <td><?php echo $r5; ?></td>
            <td><?php echo $r6['total_count']; ?></td>

          </tr>
        <?php
        }
        ?>

        <tr>
            <th>Всього</th>

            <?php
          
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk`) `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp  WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r1 = mysqli_fetch_assoc($result);

            
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='для виконання') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r2 = mysqli_fetch_assoc($result);

           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='в роботі') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r3 = mysqli_fetch_assoc($result);
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='виконано') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r4 = mysqli_fetch_assoc($result);
           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='скасовано виконання') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $result1 = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_status='відхилено') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r51 = mysqli_fetch_assoc($result);
           $r52 = mysqli_fetch_assoc($result1);
           $r5= $r51['total_count']+$r52['total_count'];

           $result = mysqli_query($connection,"SELECT COUNT(`kup_rnokpp`) AS `total_count` FROM `etk_kup` RIGHT JOIN  (SELECT DISTINCT etk.etk_rnokpp from `etk` WHERE etk.etk_ecp='Так') `etk` ON etk_kup.kup_rnokpp=etk.etk_rnokpp WHERE `kup_year`>='".$year."' AND `kup_year`<'".$year_fin."'"); 
           $r6 = mysqli_fetch_assoc($result);
           

            ?>

            <td><?php echo $r1['total_count']; ?></td>
            <td><?php echo $r2['total_count']; ?></td>
            <td><?php echo $r3['total_count']; ?></td>
            <td><?php echo $r4['total_count']; ?></td>
            <td><?php echo $r5; ?></td>
            <td><?php echo $r6['total_count']; ?></td>

          </tr>


  </table>


</div>




</body>
</html>