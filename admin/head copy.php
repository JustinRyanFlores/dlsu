<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>De La Salle University DASMARINAS</title>
<link rel="icon" href="../images/logo.png" type="image/png">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style type="text/css">
      body > div > header > nav,
      body > div > header > a{
          background-color: #9bda66 !important;
      }
      .radios{
        transform: scale(1.4);
      }
      /* Blink for Webkit and others
(Chrome, Safari, Firefox, IE, ...)
*/

@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
  text-decoration: blink;
  -webkit-animation-name: blinker;
  -webkit-animation-duration: 0.6s;
  -webkit-animation-iteration-count:infinite;
  -webkit-animation-timing-function:ease-in-out;
  -webkit-animation-direction: alternate;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: red;
  box-shadow: 0px 0px 10px red;
  position: absolute;
  top: 10px;
  left: 30px;
}
.mobile_name{
  margin-top: 10px;
  margin-left: 5px;
  font-weight: bold;
  position: absolute;
  top: -5px;
  left: 60px;
  width: 200px;
  background-color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  display: none;
  z-index: 1;
}
.left_messages{
  width: 30rem !important;
}

@media screen and (max-width: 768px){
  .left_messages{
  width: 10rem !important;
}
.holdleft:hover .mobile_name{
  display: block;
}
.desktop_name{
  display: none;
}
}

.chat{
  background-color: #edf0f5;
  width: 100%;
  height: 100%;
  border-radius: 10px;
  padding: 20px;
}
.box_data_wrapper,.box_data_wrapper2{
 height: 400px;
  overflow-y: auto;
}
.box_data,.box_data2{
 
  padding: 10px;
}
.conversation__view__bubbles {
    margin-bottom: 50px;
}
.conversation__view__bubbles::before{
  content: '';
    display: table;
    clear: both;
}
.chat__right__bubble {
    float: right;
    position: relative;
    border-bottom-right-radius: 0;
    color: hsl(342, 100%, 95%);font-size: 0.9em;
    padding: 8px;
    border-radius: 6px;
    word-break: break-all;
}
.chat__right__bubble:after{
  content: '';
  display: block;
}


.conversation__view__bubbles2 {
    margin-bottom: 50px;
}
.conversation__view__bubbles2::before{
  content: '';
    display: table;
    clear: both;
}
.chat__right__bubble2 {
    float: left;
    position: relative;
    border-bottom-right-radius: 0;
    padding: 8px;
    border-radius: 6px;
    word-break: break-all;
}
.chat__right__bubble2:after{
  content: '';
  display: block;
}
.messages_count,.customers_info_count{
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: #fff;
  text-align: center;
  width: 20px;
  height: 20px;
  font-weight: bold;
  background-color: red;
  border-radius: 50%;
}

.downpayment,.date_harvest,.downpayment2,.date_harvest2,.MonthlyChart,.WeeklyChart,.DailyChart{
  display: none;
}
.date_harvest_show,.date_harvest2_show,.DailyChart_show,.MonthlyChart_show,.WeeklyChart_show{
  display: block;
}



.notif{
  position: absolute;
  top: 18px;
  left: 23px;
  width: 5px;
  height: 5px;
  border-radius: 50%;
  background-color: red;
}

.cardnotif{
  position: absolute;
  right: 0px;
  top: 50px;
  z-index: 1000;
  width: 300px;
  height: 350px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
  background-color: #fff;
  display: none;
}
.cardnotif_show{
  display: block;
}

i {
  font-style: normal;
}
th {
  text-align: center;
}

/* WebKit-based Browsers */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: white;
}
::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom,rgb(112, 241, 129),rgb(24, 103, 249));
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
    background-color: green;
}
.small-box {
    height: 200px;
    border-radius: 10px;
    text-align: center;
    padding: 20px;
    font-size: 2.5rem;
    font-weight: bold;
    place-content: center;
}
.small-box-req {
    height: 200px;
    border-radius: 10px;
    text-align: center;
    padding: 20px;
    font-size: 2.5rem;
    font-weight: bold;
    place-content: center;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); 
    background-color:white;
    color:#fff;
    border-radius: 30px;
}
.small-box:hover {
    transform: scale(1.02);
}
.cs {
  background-color: #5ce1e6;
  place-items: center;
  display: grid;
}

.it {
  background-color: #54a2e8; 
  place-items: center;
  display: grid;
}

.class-list {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    padding: 10px;
}

.btn-table {
  width: 90%;
  margin: 3px;
}

details {
    position: relative;
    padding-right: 20px;
    cursor: pointer;
}
summary {
    margin-right: 20px;
    list-style: none;
}

details summary::after {
    content: '\25B2';
    font-size: 12px;
    transition: transform 0.3s;
    display: inline-block;
    margin-left: 10px;
    margin-bottom: 0;
    color: #4F4E4E;
}
details[open] summary::after {
    transform: rotate(180deg);  
}

.vst-head {
  display:flex; 
  align-items:center; 
  justify-content:center;  
}

.dt-buttons {
    margin-left: 20px;
}
.dt-button {
    background-color: #3ea1db !important;
    color: white !important;
}
    </style>