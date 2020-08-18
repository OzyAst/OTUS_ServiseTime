"use strict";

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        slotDuration: '00:05:00',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth timeGridWeek,timeGridDay'
        },
        droppable: true,
        locale: 'ru',
        navLinks: true,
        editable: true,
        eventLimit: true,
        slotEventOverlap: false,
        allDaySlot: false,
        height: 'auto',
    });

    calendar.render();
});
