$(function(){
    // Скрыть\показать тикеты.

    var tickets = $('.tickets-block .list-group-item');
    var visibleTickets = 2; // кол-во видимых тикетов

    // Скрываем все тикеты, кроме первых visibleTickets
    tickets.slice(visibleTickets).parent().hide();

    // Если Тикетов изначально меньше ли равно количеству отображаемых тикетов(visibleTickets),
    // то удаляем стрелку, которая показывает остальные тикеты, за ненадобностью.
    if(tickets.length <= visibleTickets){
        $('.tickets-block .moreTickets').addClass('disable');

    // Иначе, стрелка есть.
    } else {
        $(document).on('click', '.tickets-block .moreTickets', function(){
                tickets.slice(visibleTickets).parent().slideToggle(100);
                $(this).toggleClass('ion-ios7-arrow-down');
                $(this).toggleClass('ion-ios7-arrow-up');
        });
    }
});