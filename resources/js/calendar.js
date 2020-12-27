$(document).ready(function () {
	var fcTheme = FullCalendar.Theme;
	var LooperCalendarTheme = function (fcTheme) {
			function LooperCalendarTheme() {
					fcTheme.apply(this, arguments);
			}

			if (fcTheme) LooperCalendarTheme.__proto__ = fcTheme;
			LooperCalendarTheme.prototype = Object.create(fcTheme && fcTheme.prototype);
			LooperCalendarTheme.prototype.constructor = LooperCalendarTheme;
			return LooperCalendarTheme;
	}(fcTheme);

	LooperCalendarTheme.prototype.classes = {
			widget: 'fc-bootstrap4',
			tableGrid: 'table-bordered',
			tableList: 'table',
			tableListHeading: 'bg-light',
			buttonGroup: 'btn-group',
			button: 'btn btn-secondary',
			stateActive: 'active',
			stateDisabled: 'disabled',
			today: 'highlight',
			popover: 'popover',
			popoverHeader: 'popover-header',
			popoverContent: 'popover-body',
			headerRow: 'table-bordered',
			dayRow: 'table-bordered',
			listView: 'card card-reflow'
	};
	LooperCalendarTheme.prototype.iconClasses = {
			close: 'fa-times',
			prev: 'fa-chevron-left',
			next: 'fa-chevron-right',
			prevYear: 'fa-angle-double-left',
			nextYear: 'fa-angle-double-right'
	};
	LooperCalendarTheme.prototype.baseIconClass = 'fa';
	LooperCalendarTheme.prototype.iconOverrideOption = 'fontAwesome';
	LooperCalendarTheme.prototype.iconOverrideCustomButtonOption = 'fontAwesome';
	LooperCalendarTheme.prototype.iconOverridePrefix = 'fa-';
	FullCalendar.defineThemeSystem('looper', LooperCalendarTheme);

	$('#calendar').fullCalendar({
			themeSystem: 'looper',
			header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
			},
			defaultView: 'month',
			height: 'auto',
			nowIndicator:true,
			weekNumbers: false,
			navLinks: true,
			editable: false,
			eventLimit: true,
			eventTextColor: 'rgb(52, 108, 176)',
			eventBackgroundColor: 'rgba(52, 108, 176, .12)',
			eventBorderColor: 'rgb(52, 108, 176)',
			events: 'js/json/events.json',
			eventRender: function(eventObj, $el) {
				$el.popover({
					title: eventObj.title,
					content: eventObj.description,
					trigger: 'hover',
					placement: 'top',
					container: 'body'
				});
			}
	});
});