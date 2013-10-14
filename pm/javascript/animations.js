//Resizing textarea
function scaleTextareas() {
  $('#contentText').each(function(i, t){
    var m = 0;
    $($(t).val().split("\n")).each(function(i, s){
      m += (s.length/(t.offsetWidth/10)) + 1;
    });
    t.style.height = Math.floor(m + 8) + 'em';
  });
  setTimeout(scaleTextareas, 1000);
};
$(document).ready(function(){
  scaleTextareas();
});
        
//Sliding tasks
$(document).click(function(e){
    $('.project').children(".projectOptions").each(
        function(){
            if (e.target == this){
                if ($(this).hasClass("selected")) {
                    $(this).slideFadeToggle();
                    $(this).removeClass("selected");
                }
            }
        }
    );
});
        
$(function() {
    $(".projectOptionsIcon").on('click', function() {
        var dialog = $(this).parent().children(".projectOptions");
        if (dialog.hasClass("selected")) {
            dialog.slideFadeToggle();
            dialog.removeClass("selected");
        } else {
            $('.project').children(".projectOptions").each(
                function (){
                    if ($(this).hasClass("selected")) {
                        $(this).slideFadeToggle();
                        $(this).removeClass("selected");
                    }
                }
            );
            dialog.slideFadeToggle();
            dialog.addClass("selected");
        }
        return false;
    });
});

$.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({ opacity: 'toggle', width: 'toggle' }, "fast", easing, callback);
};

//Sliding project options
$(function(){
    $(".project").on('click', function(e) {
        if (e.target == this){
            $(".project ul li").not($(this)).find("li").slideUp("fast");
            $(this).find("li").slideToggle("fast");
            $(this).find(".date").slideToggle("fast");
            $(this).find(".calendar").slideToggle("fast");
            if ($(this).find(".arrow").css("-webkit-transform") == "matrix(1, 0, 0, 1, 0, 0)") {
               $(this).find(".arrow").css("-webkit-transform", "rotate(-90deg)");
            } else {
                $(this).find(".arrow").css("-webkit-transform", "rotate(0deg)");
            }
        }
    });
}); 