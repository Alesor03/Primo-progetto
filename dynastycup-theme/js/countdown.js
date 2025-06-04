(function($){
    $(document).ready(function(){
        var endDate = new Date('2024-12-31T00:00:00'); // Data fittizia del torneo
        var countdownEl = $('#dynasty-countdown');
        if(!countdownEl.length){ return; }
        function updateCountdown(){
            var now = new Date();
            var diff = endDate - now;
            if(diff <= 0){
                countdownEl.text('Il torneo è iniziato!');
                clearInterval(timer);
                return;
            }
            var days = Math.floor(diff / (1000*60*60*24));
            var hours = Math.floor((diff / (1000*60*60)) % 24);
            var minutes = Math.floor((diff / (1000*60)) % 60);
            countdownEl.text(days + 'g ' + hours + 'h ' + minutes + 'm');
        }
        updateCountdown();
        var timer = setInterval(updateCountdown, 60000);
    });
})(jQuery);
