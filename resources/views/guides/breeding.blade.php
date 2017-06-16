@extends('layouts.master', ['title' => 'Guide: Breeding'])

@section('content') 
<div class="container-fluid">


<div class="row">
  <div class="col-md-8 col-md-offset-2">     
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          Breeding <small>by Neco</small>
        </h3>
      </div>
      <div class="panel-body">
        <blockquote>
         <p>So, you have this awesome pair of racehorses and want to breed them to create more awesome racehorses. But what do you do? Unlike Halter or Jumping champions, racehorses not only earn points but those points are put toward their racing stats, those points can be inherited by their foals.</p>

         <p>Here's how you'd go about breeding your 2nd/3rd/etc generation of racehorses to expand your stable!</p>

       </blockquote>
       <h1>Calculating Racehorse Foal Stats</h1>

       <p>When breeding two racehorses together, you'll have to go about combining their stats for their foal(s) - any 2nd generation Thoroughbred will inherit certain stats from its parents as both a reward and a bonus. What stats are completely up to you!</p>

       <p>To figure out the stats of your new foal, pick the 3 highest stats from EACH parent - three from the sire and three from the dam. Subtract 50 from each stat - so say if the stat was 65, it would be 65 - 50 = 15. Then take the difference and divide it by two - so if we continue to use our 15 example, it would be 15 / 2 = 7.5 or round up to 8. If any stat comes up with a decimal, simply round up to the nearest whole number. Your final number will be the integer you received after dividing by two. Add that many points to that stat to your foal.</p>

       <p>Here's an example of how it should look like:</p>
       <ul class="list-unstyled">
         <li>
           <b><u>Sire</u></b>
           <ul class="list-unstyled">
             <li><b>Speed</b> -- 65 - 50 = 15 / 2 = 7.5 = 8</li>
             <li><b>Staying</b> -- 60 - 50 = 10 / 2 = 5</li>
             <li><b>Breaking</b> -- 55 - 50 = 5 / 2 = 2.5 = 3</li>
           </ul>
         </li>
         <li>
           <b><u>Dam</u></b>
           <ul class="list-unstyled">
             <li><b>Fierce</b> -- 63 - 50 = 13 / 2 = 6.5 = 7</li>
             <li><b>Courage</b> -- 72 - 50 = 12 / 2 = 6</li>
             <li><b>Response</b> -- 58 - 50 = 8 / 2 = 4</li>
           </ul>
         </li>
       </ul>
       <p>So then your foal would look like...</p>
       <ul class="list-unstyled">
         <li><b>Speed:</b> 58</li>
         <li><b>Staying:</b> 55</li>
         <li><b>Stamina:</b> 50</li>
         <li><b>Breaking:</b> 53</li>
         <li><b>Power:</b> 50</li>
         <li><b>Feel:</b> 50</li>
         <li><b>Fierce:</b> 57</li>
         <li><b>Tenacity:</b> 50</li>
         <li><b>Courage:</b> 56</li>
         <li><b>Response:</b> 54</li>
       </ul>

       <p>What happens if two of the highest stats of your parents are the same? You can either choose a different stat if you want a more well rounded or you can add the final numbers together after dividing the difference by two. So say your horses both have high Power stats, so you'd do...</p>
       <ul class="list-unstyled">
         <li>
         <b><u>Sire</u></b>
           <ul class="list-unstyled">
             <li>65 - 50 = 15 / 2 = 7.5 = 8</li>
           </ul>
         </li>
         <li>
           <b><u>Dam</u></b>
           <ul class="list-unstyled">
             <li>62 - 50 = 12 / 2 = 6</li>
           </ul>
           </li>
           <li>
             <b><u>Foal</u></b>
             <ul class="list-unstyled">
               <li>50 (base) + 8 + 6 = 64 (final stat)</li>
             </ul>
           </li>
         </ul>
         <p>You may only do this ONCE per foal, and that's only if two of the highest stats on the parents coincide. Our goal is to have well rounded foals that aren't too heavily skewed one way or the other and that can compete against the top older horses we have in competition at the moment.</p>

         <h2>Breeding Bonus!</h2>

         <p>So now you have your foal with some nice stats... but look at all the those ugly 50s! 50 is the base stat on any racehorse, the lowest you can get, and since foals start out basically from scratch, they begin at 50 until you give them their points from their parents' stats. Most of the time, it may not be a be a problem, since you can train your foal up and get those 50s into some more well-rounded numbers. But what if your foal already has 60+ in four stats, and is therefore unable to train? He's at a decided disadvantage against other horses that have had the benefit of training, despite the fact he got a bonus from his parents.</p>

         <p>After figuring out the foal's stats from its parents, to make your foal on par with the other trained runners, any stat leftover that has "50" will get an extra 5 points. So if your foal up there previously looked like this after your calculations...</p>

         <ul class="list-unstyled">
           <li><b>Speed:</b> 65</li>
           <li><b>Staying:</b> 64</li>
           <li><b>Stamina:</b> 62</li>
           <li><b>Breaking:</b> 50</li>
           <li><b>Power:</b> 60</li>
           <li><b>Feel:</b> 57</li>
           <li><b>Fierce:</b> 50</li>
           <li><b>Tenacity:</b> 50</li>
           <li><b>Courage:</b> 57</li>
           <li><b>Response:</b> 50</li>
         </ul>

         <p>He has 60 in four stats, so he can't be trained up. However, with the foal bonus he gets, adding "5" to each 50 stat will transform him into:</p>
         <ul class="list-unstyled">
          <li><b>Speed:</b> 65</li>
          <li><b>Staying:</b> 64</li>
          <li><b>Stamina:</b> 62</li>
          <li><b>Breaking:</b> 55</li>
          <li><b>Power:</b> 60</li>
          <li><b>Feel:</b> 57</li>
          <li><b>Fierce:</b> 55</li>
          <li><b>Tenacity:</b> 55</li>
          <li><b>Courage:</b> 57</li>
          <li><b>Response:</b> 55</li>
        </ul>

        <p>And now he's on par with the rest of the trained racers on there! You now have yourself a competitive 2nd generation horse to continue your Thoroughbred line on the flats.</p>

        <h2>Important Info!!</h2>

        <p>We are implementing a stat limit - the highest stat your foal can have is a <b>70</b>. Anything higher and we feel that the foal has an unfair advantage against other Open Level horses. Competition on all levels is important, and I'd personally rather horses work their way from the lower ranks to the highest rather than have a foal born with GI stats. After all, that doesn't happen on the track - just because your daddy is a GI winner doesn't mean you will be too!</p>

        <p>For any other questions, or just general help calculating stats, please PM me! I'm always up to help anyone with a problem :]</p>
      </div>    
    </div>   
  </div>
</div>


</div>

@endsection
