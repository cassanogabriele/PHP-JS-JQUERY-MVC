<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
} 
</script>

<div class="topnav" id="myTopnav">
  <a href="index.php?uc=tous" class="active"><i class="fa fa-headphones" aria-hidden="true"></i>&nbsp; TOUS</a></a>
  <a href="index.php?uc=rock"><i class="fa fa-music" aria-hidden="true"></i>&nbsp; ROCK</a>
  <a href="index.php?uc=pop"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp;  POP</a>
  <a href="index.php?uc=metal"><i class="fa fa-play" aria-hidden="true"></i>&nbsp; METAL</a>
  <a href="index.php?uc=vf"><i class="fa fa-volume-off" aria-hidden="true"></i>&nbsp; VARIETE FRANCAISE</a>
  <a href="index.php?uc=vi"><i class="fa fa-fast-forward" aria-hidden="true"></i>&nbsp; VARIETE ITALIENNE</a>
  <a href="index.php?uc=rap"><i class="fa fa-pause" aria-hidden="true"></i>&nbsp; HIP HOP</a>
  <a href="index.php?uc=punk"><i class="fa fa-stop" aria-hidden="true"></i>&nbsp; PUNK</a>
  <a href="index.php?uc=electro"><i class="fa fa-youtube-play" aria-hidden="true"></i>&nbsp; ELECTRO</a>
  <a href="index.php?uc=reggae"><i class="fa fa-eject" aria-hidden="true"></i>&nbsp; REGGAE</a>
  <a href="index.php?uc=films"><i class="fa fa-step-forward" aria-hidden="true"></i>&nbsp; FILMS</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>