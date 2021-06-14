$(function () {
  $(window).load(function(){
    $(".playing").children("img").attr("src", "icons/pause.PNG");
  })

  var player = $(".main-player");
  $(".audio-control").on("click", function () {
    var playBtn = $(this);
    var currentSura = playBtn.data("src");
    var audio_control = $(".audio-control");
    // Start icon change
    if (playBtn.children("img").attr("src") == "icons/play.PNG") {
      $(".audio-control").children("img").attr("src", "icons/play.PNG");
      playBtn.children("img").attr("src", "icons/pause.PNG");
    } else {
      $(".audio-control").children("img").attr("src", "icons/play.PNG");
    }
    // End icon change
    // Start play or pause
    if (playBtn.hasClass("playing")) {
      player[0].pause();
      audio_control.removeClass("playing");
    } else {
      if (player.attr("src") !== currentSura) {
        player.attr("src", currentSura);
        player[0].play();
        audio_control.removeClass("playing");
        playBtn.addClass("playing");
      } else {
        player[0].play();
        audio_control.removeClass("playing");
        playBtn.addClass("playing");
      }
    }
    // End play or pause
  });

  player.on("ended", function () {
    var currentSura = $(".playing");
    currentSura.removeClass("playing");
    var nextSura = currentSura.parents(".sura").next().find(".audio-control");

    nextSura.trigger("click").addClass("playing");
    currentSura.children("img").attr("src", "icons/play.PNG");

    if ($(".audio-control").hasClass("playing")) {
      nextSura.children("img").attr("src", "icons/pause.PNG");
    }
  });
});