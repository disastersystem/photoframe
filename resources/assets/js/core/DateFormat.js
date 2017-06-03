import moment from 'moment';

class DateFormat {
	constructor() {
		moment.locale('nb'); // norwegian bokmål
	}

	goneBetween(trip) {
		return moment(trip.leaving).format("Do MMMM") + ' - ' +
			moment(trip.returning).format("Do MMMM");
	}
}

export default DateFormat;