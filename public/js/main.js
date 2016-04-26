/**
 * Some basic scripts for the Q client project view web app
 * @rdar
 *
 * */


$(document).ready(function(){
    $('.arc-content-trigger').click(function(event){
        event.preventDefault();
        $('.arc-content-wrap').slideToggle(); 
    });
});
