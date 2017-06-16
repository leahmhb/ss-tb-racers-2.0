<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">

<script>
  $(document).ready(function () {

   $("#user input[name='isOwner']").click(function(){
    var is_owner = $("#user input[name='isOwner']:checked").val();
    if(is_owner == 1){
      $("#person_id").show();
    }
    if(is_owner == 0){ 
      $("#person_id").hide();
    }
  });

   $("#user input[name='isOwner']:checked").click();



   /*******DATE PICKER******/
   $.fn.datepicker.defaults.format = "yyyy-mm-dd";
   $.fn.datepicker.defaults.todayHighlight = true;
   $.fn.datepicker.defaults.todayBtn = true;
   $.fn.datepicker.defaults.clearBtn = true;

   $('#datepicker').datepicker();


   /*******RSV******/
   function myOnComplete() {
    $('#success').show();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return true;
  };

  var LineageRules = [
  "required,horse_id,Please select horse's call name.",
  "required,sire_id,Please select sire's call name.",
  "required,dam_id,Please select dam's call name."
  ];

  $("#lineage").RSV({
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: LineageRules
  });

  var RaceRules = [
  "required,name,Please enter race name.",
  "required,surface,Please choose surface.",
  "required,distance,Please enter distance.",
  "required,grade,Please enter grade."
  ];

  $("#race").RSV({ 
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: RaceRules
  });

  var RaceEntrantRules = [
  "required,horse_id,Please select horse's call name.",
  "required,race_id,Please select race.",
  "required,placing,Please enter placing."
  ];

  $("#entry").RSV({ 
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: RaceEntrantRules
  });

  var PersonRules = [
  "required,username,Please enter username."
  ];

  $("#person").RSV({ 
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: PersonRules
  });

  var UserRules = [
  "required,name,Please enter name.",
  "required,isAdmin,Please select if Admin.",
  "required,isOwner,Please select if Owner.",
  "required,isJockeyClub,Please select if Jockey Club.",
  "if:isOwner=YES,required,person_is,Please select Person.",
  ];

  $("#user").RSV({ 
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: UserRules
  });

  var HorseRules = [
  "required,call_name,Please enter call name.",
  "required,sex,Please select sex.",
  "required,owner,Please select owner.",
  "required,grade,Please select a grade.",
  ];

  $("#horse").RSV({ 
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: HorseRules
  });

  var demoRules = [
  "required,call_name,Call name is required.",
  "required,color,Color is required.",
  "required,sex,Sex is required.",
  "required,racing_img,Racing image is required.",

  "required,owner,Owner is required.",
  "required,stable_name,Stable name is required.",
  "required,racing_colors,Racing colors are required.",

  "required,pos_ability_1,First positive ability is required.",
  "required,pos_ability_2,Decond positive ability is required.",
  "required,neg_ability_1,First negative ability is required.",

  "required,distance_max,Max distance field is required.",
  "required,distance_min,Min distance field is required.",

  "digits_only,speed,Speed field may only contain digits.",
  "digits_only,staying,Staying field may only contain digits.",
  "digits_only,stamina,Stamina field may only contain digits.",
  "digits_only,breaking,Breaking field may only contain digits.",
  "digits_only,power,Power field may only contain digits.",
  "digits_only,feel,Feel field may only contain digits.",
  "digits_only,fierce,Fierce field may only contain digits.",
  "digits_only,tenacity,Tenacity field may only contain digits.",
  "digits_only,courage,Courage field may only contain digits.",
  "digits_only,response,Response field may only contain digits.",

  "range>=50,speed,Please enter a number >= 50 for speed.",
  "range>=50,staying,Please enter a number >= 50 for staying.",
  "range>=50,stamina,Please enter a number >= 50 for stamina.",
  "range>=50,breaking,Please enter a number >= 50 for breaking.",
  "range>=50,power,Please enter a number >= 50 for power.",
  "range>=50,feel,Please enter a number >= 50 for feel.",
  "range>=50,fierce,Please enter a number >= 50 for fierce.",
  "range>=50,tenacity,Please enter a number >= 50 for tenacity.",
  "range>=50,courage,Please enter a number >= 50 for courage.",
  "range>=50,response,Please enter a number >= 50 for response.",

  "required,surface_dirt,Dirt preference is required.",
  "required,surface_turf,Turf preference is required.",

  "required,leg_type,Leg type is required.",
  "required,neck_height,Neck heght is required.",
  "required,run_style,Run style is required.",

  "required,bandages,Bandages option is required.",
  "required,hood,Hood option is required.",
  "required,shadow_roll,Shadow roll option is required."
  ];


  $("#demo").RSV({ 
    onCompleteHandler: myOnComplete,
    errorFieldClass: "errorFieldDemo5",
    displayType: "display-html",
    errorHTMLItemBullet: "<i class='fa-color fa fa-exclamation'></i>&nbsp;",
    rules: demoRules
  });

});//end ready

</script>